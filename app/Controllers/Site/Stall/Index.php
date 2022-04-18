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

        if($this->request->getGet('location'))   $searchdata['llocation']    = $this->request->getGet('location');
       	if($this->request->getGet('start_date')!="" || $this->request->getGet('start_date')!=""){
			$startdate 	= explode('-', $this->request->getGet('start_date'));
    		$enddate 	= explode('-', $this->request->getGet('end_date')); 
			if($startdate) 	$searchdata['startdate']   	= $startdate[2].'-'.$startdate[0].'-'.$startdate[1];
			if($enddate) 	$searchdata['enddate']   	= $enddate[2].'-'.$enddate[0].'-'.$enddate[1];
		}
		$stallcount = $this->stall->getStall('count', ['stall','event'], $searchdata+['status'=> ['1']]);
    	$stalls 	= $this->stall->getStall('all', ['stall','event'], $searchdata+['status'=> ['1'], 'start' => $offset, 'length' => $perpage]);
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
