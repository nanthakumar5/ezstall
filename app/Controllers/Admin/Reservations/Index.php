<?php

namespace App\Controllers\Admin\Reservations;

use App\Controllers\BaseController;

use App\Models\Booking;

class Index extends BaseController
{
	public function __construct()
	{  
		$this->payments  = new Booking();
    }
	
	public function index()
	{		
		return view('admin/reservations/index');
	}
	
	public function DTreservations()
	{		
		$post 			= $this->request->getPost();
		$totalcount 	= $this->payments->getBooking('count', ['booking'], $post);
		$results 		= $this->payments->getBooking('all', ['booking', 'event','stall'], $post);
	
		$totalrecord 	= [];
				
		if(count($results) > 0){
			$action = '';
			foreach($results as $key => $result){
				$action = 	'<a href="'.getAdminUrl().'/reservations/view/'.$result['id'].'" data-id="'.$result['id'].'" class="view">View</a>';
				
				$totalrecord[] = 	[
										'id' 			=> 	$result['id'],
										'firstname' 	=> 	$result['firstname'],
										'lastname'  	=>  $result['lastname'],
										'mobile'  		=>  $result['mobile'],
										'action'		=> 	'<div class="table-action">
																'.$action.
															'</div>'
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
	
	public function view($id)
	{
		$result = $this->payments->getBooking('row', ['booking', 'event','barnstall','users'], ['id' => $id]);
		if($result){
			$data['result'] = $result;
		}else{
			$this->session->setFlashdata('danger', 'No Record Found.');
			return redirect()->to(getAdminUrl().'/reservations'); 
		}
		$data['usertype'] = $this->config->usertype;

		return view('admin/reservations/view', $data);
	}	
}
