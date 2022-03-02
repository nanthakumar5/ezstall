<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;

//use App\Models\Users;

class Index extends BaseController
{
	public function __construct()
	{
		//$this->users = new Users();	
	}
    
    public function index()
    { 	
        return view('site/event/index');
    }
    public function action()
	{    
		if ($this->request->getMethod()=='post')
        {    print_r($this->request->getPost());die;
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event saved successfully.');
				return redirect()->to(getAdminUrl().'/event'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(getAdminUrl().'/event'); 
			}
        } 
        else{
            print_r($this->request->getPost());
        }
		return view('site/event/action');
	}	
}
