<?php 

namespace App\Controllers\Site\Event;

use App\Controllers\BaseController;

use App\Models\Event;

class Index extends BaseController
{
	public function __construct()
	{
		$this->event = new Event();	
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
        
		return view('site/event/action');
	}	
}
