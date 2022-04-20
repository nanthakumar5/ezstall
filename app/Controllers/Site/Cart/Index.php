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
	    		if($userid) $requestdata['user_id'] = $userid;
	    		$requestdata['ip']  = $this->request->getIPAddress();
    			
    			if($requestdata['checked']==1){
	    			$requestdata['startdate'] 		= formatdate($requestdata['startdate']);
    				$requestdata['enddate'] 		= formatdate($requestdata['enddate']);
	               	$result = $this->cart->action($requestdata);  
	            }else{
	            	$result = $this->cart->delete($requestdata);
	            }
        	}

	        if(getCart()) echo json_encode(getCart());
        }
    }
}
