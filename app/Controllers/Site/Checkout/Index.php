<?php 

namespace App\Controllers\Site\Checkout;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Stripe;
use App\Models\Cart;

class Index extends BaseController
{
	public function __construct()
	{
		$this->booking = new Booking();	
		$this->stripe  = new Stripe();
        $this->cart    = new Cart();   
	}
    
    public function index()
    {
        if(!getCart()){
            return redirect()->to(base_url().'/'); 
        }

    	if ($this->request->getMethod()=='post')
    	{  
            $requestData = $this->request->getPost();
            $userdetail         = getSiteUserDetails();
            $userid             = $userdetail['id'];
            $paymentresult= $this->stripe->stripepayment($requestData);
            $requestData['paymentid']=$paymentresult;
            $booking = $this->booking->action($requestData);
            $this->cart->delete(['userid' => $userid]);
            
            if($booking){
              return redirect()->to(base_url().'/paymentsuccess'); 
            }
        }

        $userdetail  = getSiteUserDetails();
        $cartdetail  = getCart();
 
        return view('site/checkout/index', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail, 'cartdetail' => $cartdetail]);
    }

    public function success(){
        return view('site/checkout/success');
    }
}