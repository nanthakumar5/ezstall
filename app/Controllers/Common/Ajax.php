<?php

namespace App\Controllers\Common;

use App\Controllers\BaseController;

class Ajax extends BaseController
{
    public function __construct()
    {
        $this->db = db_connect();
	}
	
	public function fileupload()
	{
		$file = $this->request->getFile('file');
		$name = $file->getRandomName();
		$file->move($this->request->getPost('path'), $name);
		
		$this->db->table('fileupload')->insert(['name' => $name, 'date' => date('Y-m-d')]);
		echo json_encode(['success' => $name]);
	}
	
	public function ajaxoccupied()
	{
		$eventid = $this->request->getPost('eventid');
		$checkin = formatdate($this->request->getPost('checkin'));
		$checkout = formatdate($this->request->getPost('checkout'));
		$result = getOccupied($eventid, ['checkin' => $checkin, 'checkout' => $checkout]);
		
		echo json_encode(['success' => $result]);
	}
	
	public function ajaxreserved()
	{
		$eventid = $this->request->getPost('eventid');
		$checkin = formatdate($this->request->getPost('checkin'));
		$checkout = formatdate($this->request->getPost('checkout'));
		$result = getReserved($eventid, ['checkin' => $checkin, 'checkout' => $checkout]);
		
		echo json_encode(['success' => $result]);
	}
}
