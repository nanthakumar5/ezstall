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
			if($payment){
				$requestData['paymentid'] 	= $payment;			
				$booking = $this->booking->action($requestData);
				
				if($booking){
					$this->cart->delete(['user_id' => $userid, 'type' => $requestData['type']]);
					return redirect()->to(base_url().'/paymentsuccess'); 
				}else{
					$this->session->setFlashdata('danger', 'Try Later.');
					return redirect()->to(base_url().'/checkout'); 
				}
			}else{
				$this->session->setFlashdata('danger', 'Your payment is not processed successfully.');
				return redirect()->to(base_url().'/checkout'); 
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