<?php

namespace App\Models;

use App\Models\BaseModel;

class Event extends BaseModel
{	
	public function getEvent($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 			= [];
		
		if(in_array('event', $querydata)){
			$data		= 	['e.*'];							
			$select[] 	= 	implode(',', $data);
		}
		
		if(in_array('barnstall', $querydata)){
		    $select[]	= 	'GROUP_CONCAT( CONCAT_WS( "@-@", COALESCE(b.id, ""), COALESCE(b.name, ""), 
							( SELECT GROUP_CONCAT(concat_ws("@@", COALESCE(s.id, ""), COALESCE(s.name, ""), COALESCE(s.price, ""), COALESCE(s.status, ""))) FROM stall s 
							WHERE s.barn_id = b.id ) ) SEPARATOR "^" ) 
							AS barnid_stallid';	
		}
			
		$query = $this->db->table('event e');
		
		if(in_array('barnstall', $querydata)) 	$query->join('barn b', 'b.event_id=e.id', 'left');
				
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('e.id', $requestdata['id']);
		if(isset($requestdata['status'])) 				$query->where('e.status', $requestdata['status']);
		if(isset($requestdata['upcoming'])) 				$query->where('e.start_date>=', $requestdata['upcoming']);
		if(isset($requestdata['past'])) 				$query->where('e.end_date<', $requestdata['past']);
		
		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$query->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			if(isset($requestdata['page']) && $requestdata['page']=='events'){
				$column = ['e.name', 'e.image', 'e.start_date', 'e.location', 'e.mobile', 'e.id'];
				$query->orderBy($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
			}
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
						
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				
				$query->groupStart();
					if($page=='events'){				
						$query->like('e.name', $searchvalue);
						$query->orLike('e.location', $searchvalue);
						$query->orLike('e.mobile', $searchvalue);
					}
				$query->groupEnd();
			}			
		}
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('e.id');
		
		if(isset($extras['orderby'])) 	$query->orderBy($extras['orderby'], $extras['sort']);

		if($type=='count'){
			$result = $query->countAllResults();
		}else{
			$query = $query->get();
			//echo $this->db->getLAstquery(); die();
			if($type=='all') 		$result = $query->getResultArray();
			elseif($type=='row') 	$result = $query->getRowArray();
		}
	
		return $result;
    }
	
	public function action($data)
	{ 	
		$this->db->transStart();
		
		$datetime			= date('Y-m-d H:i:s');
		$userid				= (isset($data['user_id'])) ? $data['user_id'] : getUserID();
		
		$actionid 			= (isset($data['actionid'])) ? $data['actionid'] : '';

        $eventinsertid='';
		
		if(isset($data['name']) && $data['name']!='')      		        $request['name'] 			= $data['name'];
		if(isset($data['description']) && $data['description']!='')     $request['description']     = $data['description'];
		if(isset($data['location']) && $data['location']!='')           $request['location'] 		= $data['location'];
		if(isset($data['mobile']) && $data['mobile']!='')      	        $request['mobile'] 			= $data['mobile'];
		if(isset($data['start_date']) && $data['start_date']!='')       $request['start_date']		= date('Y-m-d', strtotime($data['start_date']));;
		if(isset($data['end_date']) && $data['end_date']!='')           $request['end_date'] 		= date('Y-m-d', strtotime($data['end_date']));		
		if(isset($data['start_time']) && $data['start_time']!='')       $request['start_time'] 		= $data['start_time'];
		if(isset($data['end_time']) && $data['end_time']!='')           $request['end_time'] 		= $data['end_time'];
		
		
		if(isset($data['stalls_price']) && $data['stalls_price']!='')   $request['stalls_price']	= $data['stalls_price'];
		if(isset($data['rvspots_price']) && $data['rvspots_price']!='') $request['rvspots_price'] 	= $data['rvspots_price'];
		
		if(isset($data['image']) && $data['image']!=''){
 			$request['image'] = $data['image'];		
			filemove($data['image'], './assets/uploads/event');		
		}
		
		if(isset($data['status']) && $data['status']!='')      		     $request['status'] 		= $data['status'];
		
		if(isset($data['eventflyer']) && $data['eventflyer']!=''){
 			$request['eventflyer'] = $data['eventflyer'];		
			filemove($data['eventflyer'], './assets/uploads/eventflyer');		
		}
		
		if(isset($data['stallmap']) && $data['stallmap']!=''){
 			$request['stallmap'] = $data['stallmap'];		
			filemove($data['stallmap'], './assets/uploads/stallmap');		
		}
		
		$request['status'] = '1';
		if(isset($request)){				
			$request['updated_at'] 	= $datetime;
			$request['updated_by'] 	= $userid;						
			
			if($actionid==''){
				$request['created_at'] 		= 	$datetime;
				$request['created_by'] 		= 	$userid;
				
				$event = $this->db->table('event')->insert($request);
				$eventinsertid = $this->db->insertID();
			}else{
				$event = $this->db->table('event')->update($request, ['id' => $actionid]);
				$eventinsertid = $actionid;
			}
		}
		
		
		if(isset($data['barn']) && count($data['barn']) > 0){

			foreach($data['barn'] as $barns){
				$barn['id']       = isset($barns['id']) ? $barns['id'] : '';
				$barn['event_id'] = !empty($barns['event_id']) ? $barns['event_id'] : $eventinsertid;
				$barn['name']     = $barns['name'];
				$stall     = $barns['stall'];
				
				
				if($barn['id']==''){
					$this->db->table('barn')->insert($barn);
					$barninsertid = $this->db->insertID();
				}else {
				   $this->db->table('barn')->update($barn, ['id' => $barn['id']]);
				   $barninsertid = $barn['id'];
				}	
				
				if(isset($barns['stall']) && count($barns['stall']) > 0){ 
					
        			$stallidcolumn = array_filter(array_column($barns['stall'], 'id'));
        			if(count($stallidcolumn)){
        				$this->db->table('stall')->whereNotIn('id', $stallidcolumn)->update(['status' => '0'], ['barn_id' => $barninsertid]);
        			}
        			foreach($barns['stall'] as $stalls){
        				
        				$stalls['id']         = isset($stalls['id']) ? $stalls['id'] : '' ;
        				$stalls['barn_id']    = $barninsertid;
        				$stalls['name']       = $stalls['name'];
        				$stalls['price']      = $stalls['price'];
        				$stalls['status']     = $stalls['status'];
        				$stalls['created_at'] = $datetime;
        				$stalls['created_by'] = $userid;
        				$stalls['updated_at'] = $datetime;
        				$stalls['updated_by'] = $userid;
        				
        				
        				if($stalls['id']==''){
        					$this->db->table('stall')->insert($stalls);
        				}else {
        				   $this->db->table('stall')->update($stalls, ['id' => $stalls['id']]);
        				}	
        			}
        		}else{  }
			}
		}
		
		if(isset($eventinsertid) && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return $eventinsertid;
		}
	}

	public function delete($data)
	{
		$this->db->transStart();
		
		$datetime		= date('Y-m-d H:i:s');
		$userid			= (isset($data['user_id'])) ? $data['user_id'] : getUserID();
		$id 			= $data['id'];
		
		$event 			= $this->db->table('event')->update(['updated_at' => $datetime, 'updated_by' => $userid, 'status' => '0'], ['id' => $id]);
		
		if($event && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return true;
		}
	}
	
	public function stalldelete($data)
	{
		$this->db->transStart();
		
		$datetime		= date('Y-m-d H:i:s');
		$userid			= (isset($data['user_id'])) ? $data['user_id'] : getUserID();
		$id 			= $data;

		$event 			= $this->db->table('stall')->update(['updated_at' => $datetime, 'updated_by' => $userid, 'status' => '0'], ['id' => $id]);
		
		if($event && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return true;
		}
	}
	
	
	public function getBarnStall($type, $querydata=[], $requestdata=[], $extras=[])
	{
		
		$select 			= [];
		
		if(in_array('event', $querydata)){
			$data		= 	['e.*'];							
			$select[] 	= 	implode(',', $data);
		}
			
		if(in_array('barn', $querydata)){
		    $select[]	= 	'group_concat(DISTINCT IF(COALESCE(b.id, "")="", "", concat_ws("@@@", COALESCE(b.id, ""), COALESCE(b.event_id, ""),	COALESCE(b.name, ""), (select group_concat(s.id) from stall s where s.barn_id=b.id order by s.id desc limit 10))) separator "@-@") as barnvalue';	
		}
		
		if(in_array('stall', $querydata)){
		    $select[]	= 	'group_concat(IF(COALESCE(s.id, "")="", "", concat_ws("@@@", COALESCE(s.id, ""), COALESCE(s.barn_id, ""), COALESCE(s.name, ""),COALESCE(s.price, ""), COALESCE(s.status, ""),(select group_concat(b.id) from barn b where b.id=s.barn_id order by b.id desc limit 10))) separator "@-@") as stallvalue';
		}
		
		$query = $this->db->table('event e');
		
		if(in_array('barn', $querydata)) 	$query->join('barn b', 'b.event_id=e.id', 'left');	
        if(in_array('stall', $querydata)) 	$query->join('stall s', 's.barn_id=b.id', 'left');			
		
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('e.id', $requestdata['id']);
		if(isset($requestdata['event_id'])) 			$query->where('b.event_id', $requestdata['event_id']);
		if(isset($requestdata['main_event_id'])) 	    $query->where('e.id', $requestdata['main_event_id']);
		if(isset($requestdata['status'])) 				$query->whereIn('e.status', $requestdata['status']);
		
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('e.id');
		
		
		if($type=='count'){
			$result = $query->countAllResults();
		}else{
			$query = $query->get();
			
			if($type=='all') 		$result = $query->getResultArray();
			elseif($type=='row') 	$result = $query->getRowArray();
		}
	
		return $result;
		
	}
	
	public function getBarnStalls($type, $querydata=[], $requestdata=[], $extras=[])
	{
		
		$select 			= [];
		
		if(in_array('event', $querydata)){
			$data		= 	['e.*'];							
			$select[] 	= 	implode(',', $data);
		}
			
		if(in_array('barn_stall', $querydata)){
		    $select[]='GROUP_CONCAT( CONCAT_WS( "@-@", COALESCE(b.id, ""), COALESCE(b.event_id, ""),COALESCE(b.name, ""), 
( SELECT GROUP_CONCAT(concat_ws("@@", COALESCE(s.id, ""), COALESCE(s.name, ""), COALESCE(s.price, ""))) FROM stall s WHERE s.barn_id = b.id ) ) 
SEPARATOR "^" ) AS barnid_stallid';
		}
		
		$query = $this->db->table('event e');
		
		if(in_array('barn_stall', $querydata)) 	$query->join('barn b', 'b.event_id=e.id', 'left');	
        			
		
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('e.id', $requestdata['id']);
		if(isset($requestdata['event_id'])) 			$query->where('b.event_id', $requestdata['event_id']);
		if(isset($requestdata['main_event_id'])) 	    $query->where('e.id', $requestdata['main_event_id']);
		if(isset($requestdata['status'])) 				$query->whereIn('e.status', $requestdata['status']);
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('e.id');
		
		
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