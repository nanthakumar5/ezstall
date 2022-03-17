<?php 
namespace App\Models;

use App\Models\BaseModel;

class Checkout extends BaseModel
{

	public function action($data,$paymentId)
	{
		//echo "checkout Model";
/*echo "<pre>";
print_r($data);
echo $data['payer_id'];
exit;*/
		$this->db->transStart();
		
		$datetime			= date('Y-m-d H:i:s');
        $status	= '1';
		if(isset($data['firstname']) && $data['firstname']!='')            $request['firstname']      = $data['firstname'];
		if(isset($data['lastname']) && $data['lastname']!='')              $request['lastname']       = $data['lastname'];
		if(isset($data['mobile']) && $data['mobile']!='')      	           $request['mobile'] 	      = $data['mobile'];
		if(isset($data['check_in']) && $data['check_in']!='')              $request['check_in'] 	  = $data['check_in'];
		if(isset($data['check_out']) && $data['check_out']!='')      	   $request['check_out'] 	  = $data['check_out'];
		if(isset($data['stallid']) && $data['stallid']!='')      	       $request['stall_id'] 	  = $data['stallid'];
		if(isset($paymentId) && $paymentId!='')      	                   $request['payment_id'] 	  = $paymentId;
		if(isset($status) && $status!='')      	                           $request['status'] 	      = $status;

		if(isset($request)){				
			$request['updated_at'] 	= $datetime;
			$request['updated_by'] 	= $data['payer_id'];						
			
				$request['created_at'] 		= 	$datetime;
				$request['created_by'] 		= 	$data['payer_id'];
				$booking = $this->db->table('booking')->insert($request);
				$insertid = $this->db->insertID();
			
		}
			//exit;

		if(isset($insertid) && $this->db->transStatus() === FALSE){
			$this->db->transRollback();
			return false;
		}else{
			$this->db->transCommit();
			return $insertid;
		}

	}
}