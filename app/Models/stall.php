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
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$query->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			if(isset($requestdata['page']) && $requestdata['page']=='stalls'){
				$column = ['s.name', 's.image'];
				$query->orderBy($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
			}
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
						
			if(isset($requestdata['page'])){ 
				$page = $requestdata['page'];
				//print_r($page);die;
				$query->groupStart();
					if($page=='stalls'){ 		
						$query->like('s.name', $searchvalue);
						$query->orLike('s.price', $searchvalue);
						//$query->orLike('e.mobile', $searchvalue);
					}
				$query->groupEnd();
			}			
		}
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('s.id');
		
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