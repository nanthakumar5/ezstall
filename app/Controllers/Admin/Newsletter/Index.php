<?php

namespace App\Controllers\Admin\Newsletter;

use App\Controllers\BaseController;

use App\Models\Newsletter;

class Index extends BaseController
{
	public function __construct()
	{  
		$this->news  = new Newsletter();
    }
	
	public function index()
	{		
		return view('admin/newsletter/index');
	}
	
	public function DTnewsletter()
	{	
		$post 			= $this->request->getPost(); 
		$totalcount 	= $this->news->getNewsletter('count', ['newsletter'],$post);
		$results 		= $this->news->getNewsletter('all', ['contactus'],$post);
		$totalrecord 	= [];
				
		if(count($results) > 0){
			foreach($results as $key => $result){
				$totalrecord[] = 	[
										'email'  	=>  $result['email'],
										'date'  	=>  date('d-m-Y', strtotime($result['date'])),
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
	
}