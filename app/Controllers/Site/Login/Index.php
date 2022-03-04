<?php 

namespace App\Controllers\Site\Login;

use App\Controllers\BaseController;
use App\Models\Users;

class Index extends BaseController
{
	public function __construct()
	{
		$this->users = new Users();	
	}
    
    public function index()
    { 
		if ($this->request->getMethod()=='post')
        {
			$email = $this->request->getPost('email');
			$password = $this->request->getPost('password');
			$result = $this->users->getUsers('row', ['users'], ['email' => $email,'password' => $password, 'type' => ['3']]);
			if($result){
				if($result['status']=='1'){ 
					$this->session->set('sitesession',['userid' => $result['id'],'username' => $result['name']]);
					
					return redirect()->to(base_url().'/myaccount/events'); 
				}elseif($result['status']=='0'){
					$this->session->setFlashdata('danger', 'User is inactive, contact admin.');
					return redirect()->to('/login'); 
				}elseif($result['status']=='2'){
					$this->session->setFlashdata('danger', 'User is inactive, contact admin.');
					return redirect()->to('/login'); 
				} else {
					$this->session->setFlashdata('danger', 'Invalid Credentials');
					return redirect()->to('/login'); 
				}
			}else{
				$this->session->setFlashdata('danger', 'Invalid Credentials');
				return redirect()->to('/login'); 
			}
        }
		
        return view('site/login/index');
    }
}
