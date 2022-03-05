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
			
			if($result){ 
				$this->session->setFlashdata('success', 'Registered successfully. Check mail for verification.'); 
				return redirect()->to(base_url().'/login'); 
			}else{ 
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/register'); 
			}
       
        }
		
		return view('site/register/index');
    }
}
