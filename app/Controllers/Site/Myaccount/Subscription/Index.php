<?php 
namespace App\Controllers\Site\Myaccount\Subscription;
use App\Controllers\BaseController;
use App\Models\Stripe;
use App\Models\Plan;

class Index extends BaseController
{
	public function __construct()
	{	
        $this->stripe 	= new Stripe();
        $this->plan 	= new Plan();
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
		
		$userdetail = getSiteUserDetails();
		$type = $userdetail['type'];
		if($type=='2'){
			$data['plan'] = $this->plan->getPlan('row', ['plan'], ['id' => '1']);
		}elseif($type=='5'){
			$data['plan'] = $this->plan->getPlan('row', ['plan'], ['id' => '2']);
		}
		
    	$data['currencysymbol'] = $this->config->currencysymbol;
    	$data['stripe'] = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
		return view('site/myaccount/subscription/index', $data);
	}
}
