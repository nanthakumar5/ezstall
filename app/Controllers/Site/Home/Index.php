<?php 

namespace App\Controllers\Site\Home;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Cms;
use App\Models\Newsletter;

class Index extends BaseController
{
	public function __construct()
	{
		$this->event = new Event();
        $this->cms = new Cms;
        $this->news = new Newsletter();
	}
    
    public function index()
    { 
    	if($this->request->getMethod()=='post'){
            $result = $this->news->action($this->request->getPost()); 
			return redirect()->to(base_url().'/'); 
        }
		
    	$now = date('Y-m-d h:i:s');
    	$data['upcomingevents'] = $this->event->getEvent('all', ['event'],['status' => ['1'], 'upcoming' => $now], ['orderby' => 'start_date', 'sort'=>'ASC']);         
    	$data['pastevents'] = $this->event->getEvent('all', ['event'],['status' => ['1'], 'past' => $now], ['orderby' => 'start_date', 'sort'=>'ASC']);
        $data['banners'] = $this->cms->getCms('all', ['cms'], ['status' => ['1'], 'type' => ['3']]);
    	
     	return view('site/home/index', $data);
    }
    
}
