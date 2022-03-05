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
