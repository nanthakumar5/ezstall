<?php 

namespace App\Controllers\Site\Checkout;

use App\Controllers\BaseController;
use App\Models\Booking;
use App\Models\Stripe;
use App\Models\Event;
use App\Models\Cart;

class Index extends BaseController
{
	public function __construct()
	{
		$this->booking = new Booking();	
		$this->stripe  = new Stripe();
        $this->event   = new Event();	
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
            $paymentresult= $this->stripe->stripepayment($requestData);
            $requestData['paymentid']=$paymentresult;
            $booking = $this->booking->action($requestData);
            $this->cart->delete(['ip' => $this->request->getIPAddress()]);
            
            if($booking){
              return redirect()->to(base_url().'/paymentsuccess'); 
            }
        }

        $userdetail  = getSiteUserDetails();
        $cartdetail  = getCart();
        $event_id    = $cartdetail['event_id'];
        $eventdetail = $this->event->getEvent('row', ['event'], ['id' => $event_id]);

        return view('site/checkout/index', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail, 'cartdetail' => $cartdetail, 'eventdetail'=>$eventdetail]);
    }

    public function success(){
        return view('site/checkout/success');
    }
}