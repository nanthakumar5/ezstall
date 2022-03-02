<?php

namespace App\Models;

use App\Models\BaseModel;

class Stall extends BaseModel
{	
	public function getStall($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('stall', $querydata)){
			$data		= 	['s.*'];							
			$select[] 	= 	implode(',', $data);
		}
			
		$query = $this->db->table('stall s');
				
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('s.id', $requestdata['id']);
		if(isset($requestdata['name'])) 				$query->where('s.name', $requestdata['name']);
		if(isset($requestdata['barn_id'])) 			    $query->where('s.barn_id', $requestdata['barn_id']);
		
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