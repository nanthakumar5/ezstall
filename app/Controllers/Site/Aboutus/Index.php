<?php 

namespace App\Controllers\Site\Aboutus;

use App\Controllers\BaseController;

class Index extends BaseController
{
	public function __construct()
	{
		
	}
    
    public function index()
    { 
		return view('site/aboutus/index');
    }
}
