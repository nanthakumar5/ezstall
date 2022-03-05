<?php 

namespace App\Controllers\Site\Home;

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
    	$now = date('Y-m-d h:i:s');
    	$data['upcoming_events'] = $this->event->getEvent('all', ['event'],['status'=>'1', 'upcoming'=>$now], ['orderby' => 'start_date', 'sort'=>'ASC']);         
    	$data['past_events'] = $this->event->getEvent('all', ['event'],['status'=>'1', 'past'=>$now], ['orderby' => 'start_date', 'sort'=>'ASC']);
    	
     	return view('site/home/index', $data);
    }
}
