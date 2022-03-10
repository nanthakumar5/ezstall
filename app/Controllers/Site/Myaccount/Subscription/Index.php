<?php 
namespace App\Controllers\Site\Myaccount\Subscription;
use App\Controllers\BaseController;
use App\Models\Stripe;

class Index extends BaseController
{
	public function __construct()
	{	
        $this->stripe = new Stripe();	
	}
    
    public function index()
    {
    	if ($this->request->getMethod() == 'post'){
	        $userdetail = getSiteUserDetails();
	        $requestData = $this->request->getPost();


	        $userID = $userdetail['id'];
            $token = $requestData['stripeToken'];
            $payer_name = $requestData['payer_name'];
            $payer_email = $userdetail['email'];
            $planName = "Weekly Subscription";
            $planPrice = 50;
            $planInterval = "week";

            $customer = $this->stripe->addCustomer($payer_name, $payer_email, $token);

            if ($customer)
            {
                $plan = $this->stripe->createPlan($planName, $planPrice, $planInterval);

                if ($plan)
                {
                    $subscription = $this->stripe->createSubscription($customer->id, $plan->id, $payer_name, $payer_email, $userID);
                    if($subscription){
                    	$this->session->setFlashdata('success', 'Successfully paid.');
                    }else{
                    	$this->session->setFlashdata('danger', 'Try Later.');
                    }

				  return redirect()->to(base_url().'/myaccount/dashboard'); 

                }
            }
			
			return redirect()->to(base_url().'/myaccount/dashboard'); 
        }

    	$data['stripepublishkey'] = $this->config->stripepublishkey;
		return view('site/myaccount/subscription/index', $data);
	}
}
