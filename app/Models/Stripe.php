<?php
namespace App\Models;
use App\Models\BaseModel;

class Stripe extends BaseModel
{	
    function addCustomer($payer_name, $payer_email, $token)
    {        
        $secretkey = $this->config->stripesecretkey;
        \Stripe\Stripe::setApiKey($secretkey);
        
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
   public function singlepayment($token){

      $secretkey = $this->config->stripesecretkey;
      
        \Stripe\Stripe::setApiKey($secretkey);
    try
        {
            $stripe = \Stripe\Charge::create ([
            "amount" => 50 * 100,
            "currency" => 'usd',
            "source" => $token,
            "description" => "test single payment" 
        ]);

   $data = array('success' => true, 'data' => $stripe);
        echo json_encode($data);
    }
    catch(Exception $e)
      {
        print_r($e->getMessage());
        die;
      }
    }


    function createPlan($planName, $planPrice, $planInterval)
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
                "interval_count"	=> 1
            ));

            return $plan;
        }
        catch(Exception $e)
        {
            print_r($e->getMessage());
            die;
        }
    }

    function createSubscription($customerID, $planID, $userID,$payer_name, $payer_email)
    {
        try
        {
        	
            $subscription = \Stripe\Subscription::create(array(
                "customer" => $customerID,
                "items" => array(
                    array(
                        "plan" => $planID
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

	                $subscripData = array(
	                    'user_id' => $userID,
	                    'payer_name' => $payer_name,
	                    'payer_email' => $payer_email,
	                    'plan_id'=> 1,
	                    'payment_method' => 'stripe',
	                    'stripe_subscription_id' => $subscrID,
	                    'stripe_customer_id' => $custID,
	                    'stripe_plan_id' => $planID,
	                    'plan_amount' => $planAmount,
	                    'plan_amount_currency' => $planCurrency,
	                    'plan_interval' => $planInterval,
	                    'plan_interval_count' => $planIntervalCount,
	                    'created' => $created,
	                    'plan_period_start' => $current_period_start,
	                    'plan_period_end' => $current_period_end,
	                    'status' => $status
	                );

	                $this->db->table('subscription')->insert($subscripData);
        			$subscription_id = $this->db->insertID();
       
	                if ($subscription_id)
	                {
	                    return $subscription_id;
	                }
			        else
			        {
			        	return false;
			        }

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