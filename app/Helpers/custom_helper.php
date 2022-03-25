<?php
function getAdminUrl()
{
	return base_url().'/administrator';
}

function getUserDetails($id)
{	
	$users 	= new \App\Models\Users;
	$result = $users->getUsers('row', ['users'], ['id' => $id]);

	if ($result) {
		return $result;
	} else {
		return false;
	}
}

function getUserID($id)
{
	$userDetails = getUserDetails($id);

	if ($userDetails) {
		return $userDetails['id'];
	} else {
		return false;
	}
}

function getAdminUserID($id='')
{
	if($id=='' && !isset(session()->get('sitesession')['userid'])) return false;
	$id = ($id=='') ? session()->get('adminsession')['userid'] : $id;
	return getUserID($id);
}

function getSiteUserID($id='')
{
	if($id=='' && !isset(session()->get('sitesession')['userid'])) return false;	
	$id = ($id=='') ? session()->get('sitesession')['userid'] : $id;
	return getUserID($id);
}

function getAdminUserDetails($id='')
{
	if($id=='' && !isset(session()->get('sitesession')['userid'])) return false;	
	$id = ($id=='') ? session()->get('adminsession')['userid'] : $id;
	return getUserDetails($id);
}

function getSiteUserDetails($id='')
{
	if($id=='' && !isset(session()->get('sitesession')['userid'])) return false;	
	$id = ($id=='') ? session()->get('sitesession')['userid'] : $id;
	return getUserDetails($id);
}

function checkSubscription()
{
	$date = date('Y-m-d');
	$userdetails = getSiteUserDetails();
	$type = '0';
	$facility = '0';
	$producer = '0';
	$stallmanager = '0';
	
	if(isset($userdetails)){
		$type = $userdetails['type'];
		
		if($type=='2' && $date < $userdetails['subscription_end_date']){
			$facility = '1';
		}
		
		if($type=='3'){
			$producer = $userdetails['subscription_count'];
		}

		if($type=='4' && $date < $userdetails['subscription_end_date']){
			$stallmanager = '1';
		}
	}
	
	return ['type' => $type, 'facility' => $facility, 'producer' => $producer, 'stallmanager' => $stallmanager];
}

function dateformat($date, $type='')
{
	if ($type == '1') return date('d-m-Y H:i:s', strtotime($date));
	else return date('d-m-Y', strtotime($date));
}

function filedata($file, $path, $extras=[])
{
	$sourceimg 			= (in_array('profile', $extras)) ? base_url().'/assets/images/profile.jpg' : base_url().'/assets/images/upload.png';
	$pdfimg 			= base_url().'/assets/images/pdf.png';
	$relativepath		= str_replace(base_url(), '.', $path);
	
	if($file!=''){
		$explodefile 	= explode('.', $file);
		$ext 			= array_pop($explodefile);
		$image 			= (in_array($ext, ['pdf', 'tiff'])) ? $pdfimg : (file_exists($relativepath.$file) ? $path.$file : $sourceimg);
	}else{
		$image 			= $sourceimg;
	}
	
	return [$file, $image];
}

function filemove($file, $destination)
{
	createDirectory($destination);
	
	$source 			= './assets/uploads/temp/'.$file;
	$destination 		= $destination.'/'.$file;
		
	if(file_exists($source)) rename($source, $destination);
}

function createDirectory($path)
{
	$location = explode('/', $path);
	for($i=0; $i<count($location); $i++)
	{
		if($location[$i]!='.'){
			$dir = implode('/', array_slice($location, 0, $i+1));
			if(!is_dir($dir))
			{
				$mask = umask(0);
				mkdir($dir, 0755);
				umask($mask);
			}
		}
	}
}

function send_mail($to,$subject,$message)
{
	$email = \Config\Services::email();

	$config['protocol'] = 'sendmail';
	$config['mailPath'] = '/usr/sbin/sendmail';
	$config['charset']  = 'iso-8859-1';
	$config['wordWrap'] = true;

	//$email->initialize($config);

	$email->setFrom('developer@itflexsolutions.com', 'Ezstall');
	$email->setTo($to);
	$email->setSubject($subject);
	$email->setMessage($message);

    if($email->send()){
        return "sent";
    }else{
        print_r($email->printDebugger());exit;
        return "not sent";
    }

} 

function getUsersList()
{	
	$users 		= 	new \App\Models\Users;;	
	$result		= 	$users->getUsers('all', ['users'], ['status' => ['1'], 'type' => ['2']]);
	
	if(count($result) > 0) return ['' => 'Select User']+array_column($result, 'name', 'id');
	else return [];	
}

function getCart(){ 
	$request 		= service('request');
    $userid 		= getSiteUserID();
	$cart 		    = new \App\Models\Cart;
	$result         = $cart->getCart('all', ['cart'], ['user_id' => $userid]);

	if($result){

		$barnstall = [];
		foreach ($result as $res) {
			$barnstall[] = ['barn_id' => $res['barn_id'], 'stall_id' => $res['stall_id']];
		}

		$event_id 		= array_unique(array_column($result, 'event_id'))[0];
	    $check_in       = array_unique(array_column($result, 'check_in'))[0];
	    $check_out      = array_unique(array_column($result, 'check_out'))[0];
	    $start          = strtotime($check_in);
		$end            = strtotime($check_out);
		$date           = ceil(abs($end - $start) / 86400);
		$price          = array_sum(array_column($result, 'price')); 	

		return ['event_id'=>$event_id, 'barnstall'=>$barnstall, 'price' => $price, 'interval' => $date, 'check_in' => $check_in,'check_out' => $check_out];	
	}else{
		return false;
	}
}