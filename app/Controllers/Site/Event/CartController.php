<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;
use App\Models\Event;

class CartController extends BaseController
{
	public function __construct()
	{
		$this->event = new Event();
	}
    
    public function index()
    {
        $requestdata= $this->request->getPost(); 
        $this->session->set('cart', ['id' => $requestdata['id']] );
    	$stallid = $this->session->get('cart'));

    }
	
	
}
