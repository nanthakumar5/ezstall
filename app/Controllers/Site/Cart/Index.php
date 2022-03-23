<?php 

namespace App\Controllers\Site\Cart;

use App\Controllers\BaseController;
use App\Models\Cart;

class Index extends BaseController
{
	public function __construct()
	{
		$this->cart = new Cart();
	}

    public function action(){ 
    	if($this->request->getMethod()=='post'){ 
    		$requestdata       	= $this->request->getPost(); 
			$userid 			= getSiteUserID();

    		if(!isset($requestdata['cart'])){
	    		$requestdata['user_id'] = $userid;
	    		if($requestdata['checked']==1){ 
	               	$result = $this->cart->action($requestdata);  
	            }else{
	            	$result = $this->cart->delete($requestdata);
	            }
        	}

	        if(getCart()) echo json_encode(getCart());
        }
    }
}
