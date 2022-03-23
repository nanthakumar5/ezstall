<?php 

namespace App\Controllers\Site\Aboutus;

use App\Controllers\BaseController;
use App\Models\Cms;

class Index extends BaseController
{
	public function __construct()
	{
		$this->cms = new Cms;
	}
    
    public function index()
    { 
    	$data['result'] = $this->cms->getCms('row', ['cms'], ['id' => '1', 'status' => ['1'], 'type' => ['1']]);
		return view('site/aboutus/index', $data);
    }
}
