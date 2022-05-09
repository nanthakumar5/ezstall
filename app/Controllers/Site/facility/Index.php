<?php 

namespace App\Controllers\Site\Facility;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Users;
use App\Models\Stall;

class Index extends BaseController
{
	public function __construct()
	{
		$this->event   	= new Event();
		$this->users 	= new Users();
		$this->stall    = new Stall();
	}
    
    public function lists()
    {	
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;
		$userdetail = getSiteUserDetails();

		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}

		if($this->request->getGet('location')!="")   		$searchdata['llocation']    		= $this->request->getGet('location');
		if($this->request->getGet('start_date')!="")   	 	$searchdata['btw_start_date']    	= formatdate($this->request->getGet('start_date'));
		if($this->request->getGet('end_date')!="")   	 	$searchdata['btw_end_date']    		= formatdate($this->request->getGet('end_date'));
		if($this->request->getGet('no_of_stalls')!="")   	$searchdata['no_of_stalls']    		= $this->request->getGet('no_of_stalls');
		
		$facilitycount = count($this->event->getEvent('all', ['event', 'stall'], $searchdata+['status'=> ['1'], 'type' => '2']));
		$facility = $this->event->getEvent('all', ['event', 'barn', 'stall'], $searchdata+['status'=> ['1'], 'start' => $offset, 'length' => $perpage, 'type' => '2']);
		
		$data['eventdetail'] = $userdetail;
		$data['userdetail'] = $userdetail;
		$data['usertype'] = $this->config->usertype;
		$data['list'] = $facility;
		$data['searchdata'] = $searchdata;
        $data['pager'] = $pager->makeLinks($page, $perpage, $facilitycount);
		
    	return view('site/facility/list', $data);
    }
	
	public function detail($id)
    {  
		/*$event = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' =>'2']);
		$data['detail']  			= $event;
		$data['settings']  			= getSettings();
		$data['currencysymbol']  	= $this->config->currencysymbol;
		return view('site/facility/detail',$data);*/
		$currentdate = date("Y-m-d");
		$data['detail'] = $event = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' =>'2']);

		$data['detail'] 			= $event;
		$data['settings']  			= getSettings();
		$data['currencysymbol']  	= $this->config->currencysymbol;

    	return view('site/facility/detail',$data);
    }

 	public function searchevents()
	{
		$requestData = $this->request->getPost(); 
		$result = array();
		
		if (isset($requestData['search'])) {
			$result = $this->event->getEvent('all', ['event'], ['status'=> ['1'], 'page' => 'events', 'search' => ['value' => $requestData['search']], 'type' =>'2']);
		}

		return $this->response->setJSON($result);
	}
}
