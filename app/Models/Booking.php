<?php 
namespace App\Models;

use App\Models\BaseModel;

class Booking extends BaseModel
{
	public function getBooking($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 		= [];
		
		if(in_array('booking', $querydata)){
			$data		= 	['b.*'];							
			$select[] 	= 	implode(',', $data);
		}
		
		if(in_array('event', $querydata)){
			$data		= 	['e.name eventname'];							
			$select[] 	= 	implode(',', $data);
		}

		if(in_array('users', $querydata)){
			$data		= 	['u.name username'];							
			$select[] 	= 	implode(',', $data);
		}

		$query = $this->db->table('booking b');
		if(in_array('event', $querydata)) $query->join('event e', 'e.id=b.event_id', 'left');
		if(in_array('users', $querydata)) $query->join('users u', 'u.id=b.user_id', 'left');
		
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('b.id', $requestdata['id']);
		if(isset($requestdata['userid'])) 				$query->where('b.user_id', $requestdata['userid']);

		if($type!=='count' && isset($requestdata['start']) && isset($requestdata['length'])){
			$query->limit($requestdata['length'], $requestdata['start']);
		}
		if(isset($requestdata['order']['0']['column']) && isset($requestdata['order']['0']['dir'])){
			if(isset($requestdata['page']) && $requestdata['page']=='adminreservations'){
				$column = ['b.firstname', 'b.lastname','b.mobile'];
				$query->orderBy($column[$requestdata['order']['0']['column']], $requestdata['order']['0']['dir']);
			}
		}
		if(isset($requestdata['search']['value']) && $requestdata['search']['value']!=''){
			$searchvalue = $requestdata['search']['value'];
						
			if(isset($requestdata['page'])){
				$page = $requestdata['page'];
				
				$query->groupStart();
					if($page=='adminreservations'){				
						$query->like('b.firstname', $searchvalue);
						$query->orLike('b.lastname', $searchvalue);
						$query->orLike('b.mobile', $searchvalue);
					}
				$query->groupEnd();
			}			
		}
		
		if(isset($extras['groupby'])) 	$query->groupBy($extras['groupby']);
		else $query->groupBy('b.id');
		
		if(isset($extras['orderby'])) 	$query->orderBy($extras['orderby'], $extras['sort']);

		if($type=='count'){
			$result = $query->countAllResults();
		}else{
			$query = $query->get();
			if($type=='all'){
				$result = $query->getResultArray();

				if(in_array('stall', $querydata)){
					foreach ($result as $key => $booking) {
						$stallid = explode(',', $booking['stall_id']);
						$stalldata = $this->db->table('stall s')->whereIn('s.id', $stallid)->get()->getResultArray();
						$result[$key]['stall'] = array_column($stalldata, 'name');
					}
				}
			}elseif($type=='row'){
				$result = $query->getRowArray();
				
				if(in_array('stall', $querydata)){
					$stallid = explode(',', $result['stall_id']);
					$stalldata = $this->db->table('stall s')->whereIn('s.id', $stallid)->get()->getResultArray();
					$result['stall'] = array_column($stalldata, 'name');
				}
			}	

		}
	
		return $result;
    }

	public function action($data)
	{

		$this->db->transStart();
		$datetime = date('Y-m-d H:i:s');
		
		if(isset($data['firstname']) && $data['firstname']!='')            $request['firstname']      = $data['firstname'];
		if(isset($data['lastname']) && $data['lastname']!='')              $request['lastname']       = $data['lastname'];
		if(isset($data['mobile']) && $data['mobile']!='')      	           $request['mobile'] 	      = $data['mobile'];
		if(isset($data['checkin']) && $data['checkin']!='')                $request['check_in'] 	  = $data['checkin'];
		if(isset($data['checkout']) && $data['checkout']!='')      	  	   $request['check_out'] 	  = $data['checkout'];
		if(isset($data['eventid']) && $data['eventid']!='')      	       $request['event_id'] 	  = $data['eventid'];
		if(isset($data['stallid']) && $data['stallid']!='')      	       $request['stall_id'] 	  = $data['stallid'];
		if(isset($data['paymentid']) && $data['paymentid']!='')      	   $request['payment_id'] 	  = $data['paymentid'];
		if(isset($data['userid']) && $data['userid']!='')      	           $request['user_id'] 	      = $data['userid'];
 		$request['status'] 	      = '1';

		if(isset($request)){				
			$request['updated_at'] 	= $datetime;
			$request['updated_by'] 	= $data['userid'];						
			$request['created_at'] 	= $datetime;
			$request['created_by'] 	= $data['userid'];

			$booking = $this->db->table('booking')->insert($request);
			$insertid = $this->db->insertID();
		}

		if(isset($insertid) && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return $insertid;
		}

	}
}