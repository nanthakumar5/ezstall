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
    		$result = $this->contactus->action($this->request->getPost());
    	}
		return view('site/contactus/index');
    }
}
