<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Users;

class Index extends BaseController
{
	public function __construct()
	{
		$this->event   	= new Event();
		$this->booking 	= new Booking();
		$this->users 	= new Users();

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


		if($this->request->getGet('location'))   $searchdata['llocation']    = $this->request->getGet('location');
		if($this->request->getGet('stalls'))   	 $searchdata['stalls']    = $this->request->getGet('stalls');
		if($this->request->getGet('start_date')!="" || $this->request->getGet('start_date')!=""){
			$searchdata['startdate'] 	= formatdate($this->request->getGet('start_date'));
    		$searchdata['enddate'] 		= formatdate($this->request->getGet('end_date'));
		}
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status'=> ['1']]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status'=> ['1'], 'start' => $offset, 'length' => $perpage], ['orderby' =>'id']);

		$data['userdetail'] = $userdetail;
		$data['usertype'] = $this->config->usertype;
		$data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		
    	return view('site/events/list', $data);
    }
	
	public function detail($id)
    {  	
			
    	$userid = getSiteUserID();

		$event = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id]);
		$booking = $this->booking->getBooking('all', ['booking','barnstall'],['eventid' => $id]);
		
		$occupied = [];
		foreach ($booking as  $bookdata) {
			$barnstall = $bookdata['barnstall'];
			$occupied[] = implode(',', array_column($barnstall, 'stall_id'));
		}

		$data['occupied'] = explode(',', implode(',', $occupied));
		$data['checkevent'] = checkEvent($event);
		$data['detail']  = $event;
		//print_r($data);die;
		return view('site/events/detail',$data);
    }

 	public function searchevents()
	{
		$requestData = $this->request->getPost(); 
		$result = array();
		
		if (isset($requestData['search'])) {
			$result = $this->event->getEvent('all', ['event'], ['status'=> ['1'], 'page' => 'events', 'search' => ['value' => $requestData['search']]]);
		}

		return $this->response->setJSON($result);
	}
}
