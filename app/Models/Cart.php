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
			
		$query = $this->db->table('cart c');
				
		if(isset($extras['select'])) 					        $query->select($extras['select']);
		else											        $query->select(implode(',', $select));
		
		if(isset($requestdata['userid'])) 				            $query->where('c.userid', $requestdata['userid']);
		if(isset($requestdata['event_id'])) 				    $query->where('c.event_id', $requestdata['event_id']);
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
	
		if(isset($data['userid'])&& $data['userid']!='') 	 	               $request['userid'] 			    = $data['userid'];
		if(isset($data['stall_id'])&& $data['stall_id']!='')           $request['stall_id'] 	    = $data['stall_id'];
		if(isset($data['event_id'])&& $data['event_id']!='')           $request['event_id'] 	    = $data['event_id'];
		if(isset($data['stall_price'])&& $data['stall_price']!='')     $request['price'] 	        = $data['stall_price'];
		if(isset($data['startdate'])&& $data['startdate']!='')         $request['check_in'] 	    = $data['startdate'];
		if(isset($data['enddate'])&& $data['enddate']!='')             $request['check_out'] 	    = $data['enddate'];


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
		if(isset($data['userid']))            	 $request['userid']     = $data['userid'];
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