<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;
use App\Models\Event;

class Index extends BaseController
{
	public function __construct()
	{
		$this->db = db_connect();

		$this->event = new Event();
	}
    
    public function lists()
    {
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
		
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status'=> ['1']]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status'=> ['1'], 'start' => $offset, 'length' => $perpage]);
        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		
    	return view('site/events/list', $data);
    }
	
	public function detail($id)
    {
		$data['detail'] = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id]);
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
