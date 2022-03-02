<?php 

namespace App\Controllers\Site\Register;

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
            $post = $this->request->getPost(); 
            $result = $this->users->action($post); 
			
			if($result){ //echo "if";die;
				$this->session->setFlashdata('success', 'Registration is successfully.'); 
				//return redirect()->to('/login'); 
				return redirect()->to(base_url().'/login'); 
			}else{ echo "else";die;
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/register'); 
			}
       
       
        }
    return view('site/register/index');
    }
    public function checkemail(){
        echo "fa";
    }
}
