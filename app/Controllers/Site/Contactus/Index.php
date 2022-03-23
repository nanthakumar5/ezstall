<?php 

namespace App\Controllers\Site\Contactus;

use App\Controllers\BaseController;
use App\Models\Contactus;


class Index extends BaseController
{
	public function __construct()
	{
		$this->contactus = new Contactus;
	}
    
    public function index()
    {  
    	if($this->request->getMethod()=='post'){
    		$this->contactus->action($this->request->getPost());
			$this->session->setFlashdata('success', 'You have successfully contacted.');
			return redirect()->to(base_url().'/contactus'); 
    	}
		
		return view('site/contactus/index');
    }
}
