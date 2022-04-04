<?php 
namespace App\Models;

use App\Models\BaseModel;

class Booking extends BaseModel
{
	public function getBooking($type, $querydata=[], $requestdata=[], $extras=[])
    {  
    	$select 		= [];
		

		if(in_array('booking', $querydata)){
			$data		= 	['b.*','DATE_FORMAT(b.created_at, "%M %Y") AS month'];							
			$select[] 	= 	implode(',', $data);
		}
		
		if(in_array('event', $querydata)){
			$data		= 	['e.name eventname','GROUP_CONCAT(e.id) as eventid'];							
			$select[] 	= 	implode(',', $data);
		}

		if(in_array('users', $querydata)){
			$data		= 	['u.name username','u.type usertype'];							
			$select[] 	= 	implode(',', $data);
		}

		if(in_array('payment', $querydata)){
			$data		= 	['SUM(p.amount) as paymentamount','p.amount'];							
			$select[] 	= 	implode(',', $data);
		}

		$query = $this->db->table('booking b');

		if(in_array('event', $querydata)){
			$query->join('event e', 'e.id=b.event_id', 'left');
			if(isset($extras['groupBy'])) $query->groupBy('e.id');
		} 

		if(in_array('users', $querydata)) 	$query->join('users u', 'u.id=b.user_id', 'left');		
		if(in_array('payment',$querydata))	$query->join('payment p', 'p.id=b.payment_id', 'left');
		
		if(isset($extras['select'])) 					$query->select($extras['select']);
		else											$query->select(implode(',', $select));
		
		if(isset($requestdata['id'])) 					$query->where('b.id', $requestdata['id']);
		if(isset($requestdata['end_date'])) 			$query->where('e.end_date <=', $requestdata['end_date']);
		if(isset($requestdata['start_date'])) 			$query->where('e.start_date >=', $requestdata['start_date']);
		if(isset($requestdata['userid'])) 				
		{
			$query->groupStart();
				$query->whereIn('b.user_id', $requestdata['userid']);
				$query->orWhereIn('e.user_id', $requestdata['userid']);
			$query->groupEnd();
		} 		

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
		else $query->groupBy('DATE_FORMAT(b.created_at, "%M %Y")');
		
		if(isset($extras['orderby'])) 	$query->orderBy($extras['orderby'], $extras['sort']);

		if($type=='count'){
			$result = $query->countAllResults(); 
		}else{
			$query = $query->get(); //echo $this->db->getLastQuery(); die();
			if($type=='all'){
				$result = $query->getResultArray();
				
				if(in_array('barnstall', $querydata)){
					foreach ($result as $key => $booking) {
						$bookingstall = $this->db->table('booking_details bd')
										->join('barn b', 'b.id = bd.barn_id', 'left')
										->join('stall s','s.id  = bd.stall_id', 'left')
										->select('bd.*, b.name barnname, s.name stallname')
										->where('bd.booking_id', $booking['id'])
										->get()
										->getResultArray();
						$result[$key]['barnstall'] = $bookingstall;
					}
				}

			}elseif($type=='row'){
				$result = $query->getRowArray();
				
			 	if(in_array('barnstall', $querydata)){
					$bookingstall = $this->db->table('booking_details bd')
									->join('barn b', 'b.id = bd.barn_id', 'left')
									->join('stall s', 's.id  = bd.stall_id', 'left')
									->select('bd.*, b.name barnname, s.name stallname')
									->where('bd.booking_id', $result['id'])
									->get()
									->getResultArray();
					$result['barnstall'] = $bookingstall;
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
		if(isset($data['paymentid']) && $data['paymentid']!='')      	   $request['payment_id'] 	  = $data['paymentid'];
		if(isset($data['userid']) && $data['userid']!='')      	           $request['user_id'] 	      = $data['userid'];
 		$request['status'] 	      = '1';

		if(isset($request)){				
			$request['updated_at'] 	= $datetime;
			$request['updated_by'] 	= $data['userid'];						
			$request['created_at'] 	= $datetime;
			$request['created_by'] 	= $data['userid'];

			$this->db->table('booking')->insert($request);
			$insertid = $this->db->insertID();
		}

		if(isset($data['barnstall'])){	
			$barnstall = json_decode($data['barnstall'], true);
			foreach ($barnstall as $value){
				$bookingdetails = array(
					'booking_id' => $insertid,
					'barn_id' 	 => $value['barn_id'],
					'stall_id' 	 => $value['stall_id'],
					'status' 	 => 1
				);

				$this->db->table('booking_details')->insert($bookingdetails);
			}
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