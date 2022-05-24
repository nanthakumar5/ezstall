<?php 
namespace App\Models;

use App\Models\BaseModel;

class Paymentsid extends BaseModel
{
	public function getPaymentsid($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('paymentid', $querydata)){
			$data		= 	['pd.*'];							
			$select[] 	= 	implode(',', $data);
		}

		$query = $this->db->table('payment_id pd');

		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('pd.id', $requestdata['id']);
		if(isset($requestdata['name']))					$query->where('pd.name', $requestdata['name']);
		if(isset($requestdata['paymenttype'])) 			$query->where('pd.type', $requestdata['paymenttype']);

		
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$query->limit($requestdata['length'], $requestdata['start']);
		}

		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		if(isset($extras['orderby'])) 	$query->orderBy($extras['orderby']);
		
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