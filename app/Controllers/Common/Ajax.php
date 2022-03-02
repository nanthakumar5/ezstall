<?php

namespace App\Controllers\Common;

use App\Controllers\BaseController;

class Ajax extends BaseController
{
	public function fileupload()
	{
		$db = db_connect();
		
		$file = $this->request->getFile('file');
		$name = $file->getRandomName();
		$file->move($this->request->getPost('path'), $name);
		
		$db->table('fileupload')->insert(['name' => $name, 'date' => date('Y-m-d')]);
		echo json_encode(['success' => $name]);
	}
}
