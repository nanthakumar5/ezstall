<?php

namespace App\Controllers\Admin\Aboutus;

use App\Controllers\BaseController;

use App\Models\Cms;

class Index extends BaseController
{
	public function __construct()
	{  
		$this->cms  = new Cms();
    }
	
	public function index()
	{		
		$data = [];

		$result = $this->cms->getCms('row', ['cms'], ['id' => '1', 'status' => ['1'], 'type' => ['1']]);
		if($result){
			$data['result'] = $result;
		}else{
			$this->session->setFlashdata('danger', 'Try Later.');
			return redirect()->to(getAdminUrl().'/'); 
		}
		
		if ($this->request->getMethod()=='post')
        {
			$requestdata = $this->request->getPost();
			$requestdata['userid'] = getAdminUserID();
			$requestdata['status'] = '1';
			$requestdata['type'] = '1';
			
            $result = $this->cms->action($requestdata);
			
			if($result){
				$this->session->setFlashdata('success', 'About Us content saved successfully.');
				return redirect()->to(getAdminUrl().'/aboutus'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(getAdminUrl().'/aboutus'); 
			}
        }
		
		return view('admin/aboutus/index', $data);
	}	
}
