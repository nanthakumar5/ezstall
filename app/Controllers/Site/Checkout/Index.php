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
        
        $userdetail  	= getSiteUserDetails();
		$cartdetail  	= getCart();		
		$settings		= getSettings();
		
    	if ($this->request->getMethod()=='post')
    	{  
            $requestData 				= $this->request->getPost();
            $userid             		= $userdetail['id'];
            $payment 					= $this->stripe->action(['id' => $requestData['stripepayid']]);
            $requestData['paymentid'] 	= $payment;
			
            $booking = $this->booking->action($requestData);
            $this->cart->delete(['user_id' => $userid, 'type' => $requestData['type']]);
            
            if($booking){
				return redirect()->to(base_url().'/paymentsuccess'); 
            }
        }

        return view('site/checkout/index', [
			'currencysymbol' => $this->config->currencysymbol, 
			'settings' => $settings, 
			'userdetail' => $userdetail, 
			'cartdetail' => $cartdetail
		]);
    }

    public function success(){
        return view('site/checkout/success');
    }
}