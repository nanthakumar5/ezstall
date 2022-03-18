<?php 

namespace App\Controllers\Site\Checkout;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Stripe;

class Index extends BaseController
{
	public function __construct()
	{
		$this->booking = new Booking();	
		$this->stripe = new Stripe();	
	}
    
    public function index()
    {
    	if ($this->request->getMethod()=='post')
    	{  
            $requestData = $this->request->getPost();
            $paymentresult= $this->stripe->stripepayment($requestData);
            $requestData['paymentid']=$paymentresult;
            $booking = $this->booking->action($requestData);
            if($booking){
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