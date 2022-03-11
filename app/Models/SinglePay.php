<?php
namespace App\Models;
use App\Models\BaseModel;
use Stripe;

class SinglePay extends BaseModel
{	
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

            return $stripe;
      }

    catch(Exception $e)
        {

        print_r($e->getMessage());
        die;
     }

    }
  }