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
		$this->event   = new Event();
		$this->booking = new Booking();
		$this->users = new Users();

	}
    
    public function lists()
    {	
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;
		$userdetail = getSiteUserDetails();

		$userid = $userdetail['id'];
		 $subscriptionid = $userdetail['subscription_id'];

		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}

		if($this->request->getGet('location'))   $searchdata['llocation']    = $this->request->getGet('location');
		if($this->request->getGet('start_date')) $searchdata['start_date']   = date("Y-m-d", strtotime($this->request->getGet('start_date')));
		if($this->request->getGet('end_date'))   $searchdata['end_date']     = date("Y-m-d", strtotime($this->request->getGet('end_date')));
    	
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status'=> ['1']]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status'=> ['1'],'userid'=>$userid, 'start' => $offset, 'length' => $perpage]);

		$subscriptionData = $this->users->getUsers('row', ['users','payment'], ['id'=>$userid,'subscriptionid'=>$subscriptionid]); 
		$data['list'] = $event;
		$data['userdetail'] = $userdetail;
		$data['subscriptionData'] = $subscriptionData;

        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
    	return view('site/events/list', $data);
    }
	
	public function detail($id)
    {  
    	$userid                        = getSiteUserID();
		$checksubscription             = checkSubscription();
		$checksubscriptiontype 		   = $checksubscription['type'];
		$checksubscriptionfacility 	   = $checksubscription['facility'];
		$checksubscriptionproducer     = $checksubscription['producer'];
		$checksubscriptionstallmanager = $checksubscription['stallmanager'];

		$eventcount = $this->event->getEvent('count', ['event'], ['status' => ['1'], 'userid' => $userid]);

		if($checksubscriptiontype=='2' && $checksubscriptionfacility!='1'){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}elseif($checksubscriptiontype=='3' && (($id=='' && $checksubscriptionproducer <= $eventcount) || ($id!='' && $checksubscriptionproducer < $eventcount))){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/events'); 
		}elseif($checksubscriptiontype=='4' && $checksubscriptionstallmanager!='4'){ 
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}
		
		$data['detail']  = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id]);
		$booking = $this->booking->getBooking('all', ['booking'],['eventid' => $id]);
		$data['occupied'] = explode(',', implode(',', array_column($booking, 'stall_id')));
		
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
