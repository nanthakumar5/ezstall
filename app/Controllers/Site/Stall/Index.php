<?php 

namespace App\Controllers\Site\Stall;

use App\Controllers\BaseController;
use App\Models\Stall;

class Index extends BaseController
{
	public function __construct()
	{
		$this->stall = new Stall();
	}
    
    public function index()
    {
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  9; 
		$offset = $page * $perpage;
		
		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'stalls'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}
		$stallcount = $this->stall->getStall('count', ['stall'], $searchdata+['status'=> ['1']]);
    	$stalls 	= $this->stall->getStall('all', ['stall'], $searchdata+['status'=> ['1'], 'start' => $offset, 'length' => $perpage]);
        $data['stalllist'] = $stalls;
        $data['pager'] = $pager->makeLinks($page, $perpage, $stallcount);
		
    	return view('site/stall/index',$data);
    }
	
    public function detail($id)
    {
    	$data['detail'] = $this->stall->getStall('row', ['stall'],['id' => $id]);
    	return view('site/stall/detail',$data);
    }
}
