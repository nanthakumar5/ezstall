<?php
namespace App\Models;
use App\Models\BaseModel;

class Stripe extends BaseModel
{	
	function stripepayment($requestData)
	{
		$settings = getSettings();
		$token = $requestData['stripe_token'];
		$payer_id = $requestData['payer_id'];
		$payer_name = $requestData['payer_name'];
		$payer_email = $requestData['payer_email'];
		
		$price = ($requestData['price'] * 100);
        $currency = "inr";
		
		\Stripe\Stripe::setApiKey($settings['stripeprivatekey']);
		
		$customer = $this->addCustomer($payer_name, $payer_email, $token);
	  
		if ($customer)
		{
			$stripe = \Stripe\PaymentIntent::create([
					"customer" => $customer->id,
					"amount" => $price,
					"currency" => $currency,
					"description" => "",
					"payment_method_types" => [ 
						"card" 
					] 
			]);
			
			$stripe = $stripe->jsonSerialize();

			if($stripe){
				$amount = ($price / 100);
				$subscrID = $stripe['id'];
				$custID = $stripe['customer'];
				$status = $stripe['status'];
				$created = date("Y-m-d H:i:s", $stripe['created']);
				
				$paymentData = array(
					'payer_id' => $payer_id,
					'payer_name' => $payer_name,
					'payer_email' => $payer_email,
					'amount' => $amount,
					'currency' => $currency,
					'payment_method' => 'stripe',
					'stripe_subscription_id' => $subscrID,
					'stripe_customer_id' => $custID,
					'type' => '1',
					'status' => $status,
					'created' => $created
				);

				$this->db->table('payment')->insert($paymentData);
				return $this->db->insertID();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function striperefunds($data){
        $settings = getSettings();
        $stripe = new \Stripe\StripeClient($settings['stripeprivatekey']);
		$stripe->refunds->create(
				['payment_intent' => $data]
		);
		$this->db->table('booking')->update(['status' => '2']);
		return $this->db->insertID();
	}
	
	function striperecurringpayment($requestData)
	{
		$token = $requestData['stripe_token'];
		$payer_id = $requestData['payer_id'];
		$payer_name = $requestData['payer_name'];
		$payer_email = $requestData['payer_email'];
		$plan_id = $requestData['plan_id'];
		$planName = $requestData['plan_name'];
		$planPrice = $requestData['price'];
		$planInterval = $requestData['plan_interval'];
		$planIntervalCount = $requestData['plan_interval_count'];
		
		$customer = $this->addCustomer($payer_name, $payer_email, $token);
	  
		if ($customer)
		{
			$plan = $this->createPlan($planName, $planPrice, $planInterval, $planIntervalCount);

			if ($plan)
			{
				$subscription = $this->createSubscription($customer->id, $plan->id, $plan_id, $payer_id, $payer_name, $payer_email);
				if($subscription){
					return true;
				}else{
					return false;
				}
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
		
	}
    function addCustomer($payer_name, $payer_email, $token)
    {
		$settings = getSettings();
        \Stripe\Stripe::setApiKey($settings['stripeprivatekey']);
        
        try
        {
            $customer = \Stripe\Customer::create(array(
                'name' => $payer_name,
                'email' => $payer_email,
                'source' => $token
            ));

            return $customer;
        }
        catch(Exception $e)
        {
            print_r($e->getMessage());
            die;
        }
    }

    function createPlan($planName, $planPrice, $planInterval, $planIntervalCount)
    {
        $priceCents = ($planPrice * 100);
        $currency = "usd";

        try
        {
            $plan = \Stripe\Plan::create(array(
                "product" 			=> ["name" => $planName],
                "amount" 			=> $priceCents,
                "currency" 			=> $currency,
                "interval" 			=> $planInterval,
                "interval_count"	=> $planIntervalCount
            ));

            return $plan;
        }
        catch(Exception $e)
        {
            print_r($e->getMessage());
            die;
        }
    }

    function createSubscription($customerID, $stripePlanID, $localPlanID, $payerID, $payerName, $payerEmail)
    {
        try
        {
            $subscription = \Stripe\Subscription::create(array(
                "customer" => $customerID,
                "items" => array(
                    array(
                        "plan" => $stripePlanID
                    )
                )
            ));

            $subscription = $subscription->jsonSerialize();

            if ($subscription)
	        {
	            if ($subscription['status'] == 'incomplete'|| $subscription['status'] == 'active')
	            {
	                $subscrID = $subscription['id'];
	                $custID = $subscription['customer'];
	                $planID = $subscription['plan']['id'];
	                $planAmount = ($subscription['plan']['amount'] / 100);
	                $planCurrency = $subscription['plan']['currency'];
	                $planInterval = $subscription['plan']['interval'];
	                $planIntervalCount = $subscription['plan']['interval_count'];
	                $created = date("Y-m-d H:i:s", $subscription['created']);
	                $current_period_start = date("Y-m-d H:i:s", $subscription['current_period_start']);
	                $current_period_end = date("Y-m-d H:i:s", $subscription['current_period_end']);
	                $status = $subscription['status'];

	                $paymentData = array(
	                    'payer_id' => $payerID,
	                    'payer_name' => $payerName,
	                    'payer_email' => $payerEmail,
	                    'amount' => $planAmount,
	                    'currency' => $planCurrency,
	                    'payment_method' => 'stripe',
	                    'stripe_subscription_id' => $subscrID,
	                    'stripe_customer_id' => $custID,
	                    'stripe_plan_id' => $planID,
	                    'plan_id'=> $localPlanID,
	                    'plan_interval' => $planInterval,
	                    'plan_interval_count' => $planIntervalCount,
	                    'plan_period_start' => $current_period_start,
	                    'plan_period_end' => $current_period_end,
	                    'type' => '2',
	                    'status' => $status,
	                    'created' => $created
	                );

	                $this->db->table('payment')->insert($paymentData);
        			$subscription_id = $this->db->insertID();
       
	                if ($subscription_id)
	                {
						$this->db->table('users')->where(['id' => $payerID])->update(['subscription_id' => $subscription_id]);
						
	                    return $subscription_id;
	                }
			        else
			        {
			        	return false;
			        }

	            }
				else
				{
					return false;
				}
	        }
	        else
	        {
	        	return false;
	        }
        }
        catch(Exception $e)
        {
            print_r($e->getMessage());
            die;
        }
    } 
}