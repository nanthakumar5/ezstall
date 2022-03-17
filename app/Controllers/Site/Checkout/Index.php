<?php 

namespace App\Controllers\Site\Checkout;

use App\Controllers\BaseController;
use App\Models\Checkout;
use App\Models\Stripe;

class Index extends BaseController
{
	public function __construct()
	{
		$this->checkout = new Checkout();	
		$this->stripe = new Stripe();	
	}
    
    public function index()
    {
    	if ($this->request->getMethod()=='post')
    	{  
            $requestData = $this->request->getPost();
            $paymentresult= $this->stripe->stripepayment($requestData);
            $checkout = $this->checkout->action($requestData,$paymentresult);
            if($checkout){
              return redirect()->to(base_url().'/paymentsuccess'); 
            }
         }

        $userdetail = getSiteUserDetails();
        return view('site/checkout/index', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
    }


    public function success(){
        return view('site/checkout/success');
    }
}