<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Barn;
use App\Models\Stall;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
		$this->barn = new Barn();
		$this->stall = new Stall();
		$this->uri = service('uri');
	}
    
    public function index()
    { 	
    	$data['events'] = $this->event->getEvent('all', ['event'],['status'=>'1'], ['orderby' => 'start_date', 'sort'=>'ASC']);
    	
        return view('site/event/index', $data);
    }

    public function DTevents()
	{	
		$post 			= $this->request->getPost();
		$totalcount 	= $this->event->getEvent('count',['event'],['status'=>'1']+$post, ['orderby' => 'id', 'sort'=>'ASC']);

		$results 		= $this->event->getEvent('all',['event'],['status'=>'1']+$post, ['orderby' => 'id', 'sort'=>'ASC']);
		
		$totalrecord 	= [];
		if(count($results) > 0){
			foreach($results as $row){
				$start_on = date('M d, Y', strtotime($row['start_date']));
	            $end_on   = date('M d, Y', strtotime($row['end_date']));
	            if($row['image']!=''){
	            	$image = '<a href="'.base_url().'/assets/uploads/event/'.$row['image'].'" target="_blank"><img src="'.base_url().'/assets/uploads/event/'.$row['image'].'" alt="'.$row['name'].'" width="150px;" height="150px;" ></a>';
	            }else{
	            	$image = '';
	            }
				$totalrecord[] = [
									'name' => $row['name'],
									'image' => $image,
									'event_on'=> $start_on.' - '.$end_on,
									'location' => ucfirst($row['location']), 
									'mobile' => $row['mobile'],	
									'action' => '<div class="add_button ml-10">
                                            <a href="'.base_url().'/editEvent/'.$row['id'].'" class="btn_1"><i class="fa fa-pencil" title="edit" aria-hidden="true"></i></a>
                                        </div>'
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

    public function action()
	{    
		$id = $this->uri->getSegment(2);
		if(isset($id)){
			$id = $this->uri->getSegment(2);
		}else{
			$id = 0;
		}
		$data['result'] = $this->event->getEvent('row', ['event'],['id'=>$id]);
		if($data['result']){
			$data['barnList'] = $this->barn->getBarn('all', ['barn'],['event_id'=>$data['result']['id']]);
			if($data['barnList']){
				$stalls = [];
				foreach($data['barnList'] as $res){
					$stallList = $this->stall->getStall('all', ['stall'],['barn_id'=>$res['id']]);
					$barn_id = $res['id'];
					$stalls[$barn_id] = $stallList;
				}
				
			}else{
				$stalls = [];
			}
			
			$data['stallList'] = $stalls;
		}else{
			$data['result'] = $data['barnList'] = $data['stallList'] = [];
		}
		
		if ($this->request->getMethod()=='post')
        {
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'New Event saved successfully.');
				return redirect()->to(base_url().'/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(getAdminUrl().'/events'); 
			}
        } 
        else{
            
        }
		return view('site/event/action', $data);
	}	
}
