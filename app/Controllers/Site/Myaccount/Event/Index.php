<?php 
namespace App\Controllers\Site\Myaccount\Event;

use App\Controllers\BaseController;
use App\Models\Event;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
	}
    
    public function index()
    { 	
		if ($this->request->getMethod()=='post')
        {
            $result = $this->event->delete($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event deleted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        }
		
		$userid = getSiteUserID();
		
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;
		
		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}
		
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status'=>'1', 'userid' => $userid]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status'=>'1', 'start' => $offset, 'length' => $perpage, 'userid' => $userid]);
        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		$data['userid'] = $userid;
		
		return view('site/myaccount/event/index', $data);
    }

    public function action($id='')
	{    
		$userid = getSiteUserID();
		
		if($id!=''){
			$result = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'userid' => $userid]);
			if($result){
				$data['result'] = $result;
			}else{
				$this->session->setFlashdata('danger', 'No Record Found.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
		}
		
		if ($this->request->getMethod()=='post'){
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event submitted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        } 
		
		$data['userid'] = $userid;
		return view('site/myaccount/event/action', $data);
	}
}
