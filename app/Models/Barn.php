<?php

namespace App\Models;

use App\Models\BaseModel;

class Barn extends BaseModel
{	
	public function getBarn($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('barn', $querydata)){
			$data		= 	['b.*'];							
			$select[] 	= 	implode(',', $data);
		}
			
		$query = $this->db->table('barn b');
				
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('b.id', $requestdata['id']);
		if(isset($requestdata['name'])) 				$query->where('b.name', $requestdata['name']);
		if(isset($requestdata['event_id'])) 			$query->where('b.event_id', $requestdata['event_id']);
		
		if($type=='count'){
			$result = $query->countAllResults();
		}else{
			$query = $query->get();
			
			if($type=='all') 		$result = $query->getResultArray();
			elseif($type=='row') 	$result = $query->getRowArray();
		}
	
		return $result;
    }
}