<?php 
namespace App\Controllers\Site\Myaccount\Subscription;
use App\Controllers\BaseController;
use App\Models\Stripe;
use App\Models\Plan;
use App\Models\Payments;

class Index extends BaseController
{
	public function __construct()
	{	
        $this->stripe 	= new Stripe();
        $this->plan 	= new Plan();
		$this->payments = new Payments();	

	}
    
	public function index()
    {
    	if ($this->request->getMethod() == 'post'){
	        $requestData = $this->request->getPost();

            $payment = $this->stripe->striperecurringpayment($requestData);
			if($payment){
				$this->session->setFlashdata('success', 'Successfully paid.');
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
			}
			return redirect()->to(base_url().'/myaccount/dashboard'); 
        }
		
		$userdetail     = getSiteUserDetails();
		$type           = $userdetail['type'];
		$subscriptionid = $userdetail['subscription_id'];

		$data['plans']          = $this->plan->getPlan('all', ['plan'], ['type' => [$type]]);
		$data['subscriptions']  = $this->payments->getPayments('row', ['payment', 'plan'], ['id' => $subscriptionid]);

		$data['userdetail']     = $userdetail;
    	$data['currencysymbol'] = $this->config->currencysymbol;
    	$data['stripe']         = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
		return view('site/myaccount/subscription/index', $data);
	}
}
