<?php

namespace App\Models;

use App\Models\BaseModel;

class Cart extends BaseModel
{	
	public function getCart($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('cart', $querydata)){
			$data		= 	['c.*'];							
			$select[] 	= 	implode(',', $data);
		}

		if(in_array('event', $querydata)){
			$data		= 	['e.name eventname, e.location eventlocation, e.description eventdescription'];							
			$select[] 	= 	implode(',', $data);
		}
		if(in_array('barn', $querydata)){
			$data		= 	['b.name barnname'];							
			$select[] 	= 	implode(',', $data);
		}
		if(in_array('stall', $querydata)){
			$data		= 	['s.name stallname'];							
			$select[] 	= 	implode(',', $data);
		}

		$query = $this->db->table('cart c');

		if(in_array('event', $querydata)) $query->join('event e', 'e.id=c.event_id', 'left');
		if(in_array('barn', $querydata)) $query->join('barn b', 'b.id=c.barn_id', 'left');
		if(in_array('stall', $querydata)) $query->join('stall s', 's.id=c.stall_id', 'left');


		if(isset($extras['select'])) 					        $query->select($extras['select']);
		else											        $query->select(implode(',', $select));
		
		if(isset($requestdata['user_id'])) 				        $query->where('c.user_id', $requestdata['user_id']);
		if(isset($requestdata['event_id'])) 				    $query->where('c.event_id', $requestdata['event_id']);
		if(isset($requestdata['barn_id'])) 				    	$query->where('c.barn_id', $requestdata['barn_id']);
		if(isset($requestdata['stall_id'])) 				    $query->where('c.stall_id', $requestdata['stall_id']);
		
		if($type=='count'){
			$result = $query->countAllResults();
		}else{
			$query = $query->get();
			
			if($type=='all') 		$result = $query->getResultArray();
			elseif($type=='row') 	$result = $query->getRowArray();
		}
		return $result;
    }
	
	public function action($data)
	{    
		$this->db->transStart();
	
		if(isset($data['user_id'])&& $data['user_id']!='') 	 	       	$request['user_id'] 		= $data['user_id'];
		if(isset($data['stall_id'])&& $data['stall_id']!='')           	$request['stall_id'] 	    = $data['stall_id'];
		if(isset($data['event_id'])&& $data['event_id']!='')           	$request['event_id'] 	    = $data['event_id'];
		if(isset($data['barn_id'])&& $data['barn_id']!='')           	$request['barn_id'] 	    = $data['barn_id'];
		if(isset($data['price'])&& $data['price']!='')     				$request['price'] 	        = $data['price'];
		if(isset($data['startdate'])&& $data['startdate']!='')         	$request['check_in'] 	    = $data['startdate'];
		if(isset($data['enddate'])&& $data['enddate']!='')             	$request['check_out'] 	    = $data['enddate'];


		if(isset($request)){ 
			$cart = $this->db->table('cart')->insert($request);
			$usersinsertid = $this->db->insertID();
		}
		
		if(isset($usersinsertid) && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return $usersinsertid;
		}
	}

	public function delete($data)
	{
		$this->db->transStart();
		
		$request = [];
		if(isset($data['user_id']))            	 $request['user_id']    = $data['user_id'];
		if(isset($data['stall_id']))             $request['stall_id'] 	= $data['stall_id'];
		
		if(count($request)){
			$cart 			= $this->db->table('cart')->delete($request);
		}

		if(isset($cart) && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return true;
		}
	}
}