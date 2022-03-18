<?php 
namespace App\Models;

use App\Models\BaseModel;

class Payments extends BaseModel
{
public function getPayments($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('payment', $querydata)){
			$data		= 	['p.*'];							
			$select[] 	= 	implode(',', $data);
		}
		
		$query = $this->db->table('payment p');
		
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('p.id', $requestdata['id']);
		if(isset($requestdata['userid'])) 				$query->where('p.payer_id', $requestdata['userid']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$query->limit($requestdata['length'], $requestdata['start']);
		}
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('p.id');
		
		if(isset($extras['orderby'])) 	$query->orderBy($extras['orderby'], $extras['sort']);

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