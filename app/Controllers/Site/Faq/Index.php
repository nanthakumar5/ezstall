<?php 

namespace App\Controllers\Site\Faq;

use App\Controllers\BaseController;

class Index extends BaseController
{
	public function __construct()
	{
		
	}
    
    public function index()
    { 
		return view('site/faq/index');
    }
}
