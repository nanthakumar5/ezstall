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
    
    public function index($id='')
    { 
    	if($id==''){
	    	$data['aboutus'] = $this->cms->getCms('all', ['cms'], ['status' => ['1'], 'type' => ['1']]);
		}else{
			$data['aboutus'] = $this->cms->getCms('row', ['cms'], ['id' => $id,'status' => ['1'], 'type' => ['1']]);
			return view('site/aboutus/detail', $data);
		}
		return view('site/aboutus/index', $data);
    }
}
