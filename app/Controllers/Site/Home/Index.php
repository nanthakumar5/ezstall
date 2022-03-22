<?php 

namespace App\Controllers\Site\Home;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Cms;

class Index extends BaseController
{
	public function __construct()
	{
		$this->event = new Event();
        $this->cms = new Cms;
	}
    
    public function index()
    { 
    	$now = date('Y-m-d h:i:s');
    	$data['upcoming_events'] = $this->event->getEvent('all', ['event'],['status' => ['1'], 'upcoming' => $now], ['orderby' => 'start_date', 'sort'=>'ASC']);         
    	$data['past_events'] = $this->event->getEvent('all', ['event'],['status' => ['1'], 'past' => $now], ['orderby' => 'start_date', 'sort'=>'ASC']);
        $data['result'] = $this->cms->getCms('all', ['cms'], ['status' => ['1'], 'type' => ['3']]);
    	
     	return view('site/home/index', $data);
    }
    
}
