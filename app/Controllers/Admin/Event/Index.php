<?php

namespace App\Controllers\Admin\Event;

use App\Controllers\BaseController;

use App\Models\Event;

class Index extends BaseController
{
	public function __construct()
	{  
		$this->event  = new Event();
    }
	
	public function index()
	{		
		if ($this->request->getMethod()=='post')
        {
            $result = $this->event->delete($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event deleted successfully.');
				return redirect()->to(getAdminUrl().'/event'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later');
				return redirect()->to(getAdminUrl().'/event'); 
			}
        }
		
		return view('admin/event/index');
	}
		
	public function DTevent()
	{
		$post 			= $this->request->getPost();
		$totalcount 	= $this->event->getEvent('count', ['event'], ['status' => ['1', '2']]+$post);
		$results 		= $this->event->getEvent('all', ['event'], ['status' => ['1', '2']]+$post);
		$totalrecord 	= [];
				
		if(count($results) > 0){
			$action = '';
			foreach($results as $key => $result){
				$action = 	'<a href="'.getAdminUrl().'/event/action/'.$result['id'].'">Edit</a> / 
							<a href="javascript:void(0);" data-id="'.$result['id'].'" class="delete">Delete</a> /
							<a href="'.getAdminUrl().'/event/view/'.$result['id'].'" data-id="'.$result['id'].'" class="view">View</a>
							';
				
				$totalrecord[] = 	[
										'name' 				=> 	$result['name'],
										'location'          =>  $result['location'],
										'mobile'            =>  $result['mobile'],
										'action'			=> 	'
																	<div class="table-action">
																		'.$action.'
																	</div>
																'
									];
			}
		}
		
		$json = array(
			"draw"            => intval($post['draw']),   
			"recordsTotal"    => intval($totalcount),  
			"recordsFiltered" => intval($totalcount),
			"data"            => $totalrecord
		);

		echo json_encode($json);
	}
	
	public function action($id='')
	{
		if($id!=''){
			$result = $this->event->getEvent('row', ['event'], ['id' => $id, 'status' => ['1', '2']]);
			if($result){
				$data['result'] = $result;
			}else{
				$this->session->setFlashdata('danger', 'No Record Found.');
				return redirect()->to(getAdminUrl().'/event'); 
			}
		}
		
		if ($this->request->getMethod()=='post')
        {
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event saved successfully.');
				return redirect()->to(getAdminUrl().'/event'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(getAdminUrl().'/event'); 
			}
        }
		
		if($id!=''){
			$barnstallvalue = $this->event->getEvent('all', ['event','barnstall'], ['id' => $id ,'status' => ['1','2']]);
			if(isset($barnstallvalue)){
				$data['barnstallvalue'] = $barnstallvalue;
			}
		}
			
		$data['eventstatus'] = $this->config->status1;
		$data['stallstatus'] = $this->config->status1;
		
		return view('admin/event/action', $data);
	}	
	
	public function view($id=''){
		
		if($id!=''){
			$barnvalue = $this->event->getEvent('all', ['event','barnstall'], ['id' => $id ,'status' => ['1','2']]);
			if(isset($barnvalue) && isset($barnvalue[0]['barnid_stallid'])){
				$data['barnvalue'] = $barnvalue;
			} else {
				$result = $this->event->getBarnStall('all', ['event'], ['id' => $id,'status' => ['1','2']]);
				$data['barnvalue'] = $result;
			}
		}
		$data['stallstatus'] = $this->config->status1;
		
		return view('admin/event/view', $data);
	}
}
