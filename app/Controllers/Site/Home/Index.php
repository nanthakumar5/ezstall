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
    	$data['upcoming_events'] = $this->event->getEvent('all', ['event'],['status'=>'1', 'upcoming'=>$now], ['orderby' => 'start_date']); 
    	$data['past_events'] = $this->event->getEvent('all', ['event'],['status'=>'1', 'past'=>$now], ['orderby' => 'start_date']);
    	//echo '<pre>'; print_r($data['past_events']); die();
     	return view('site/home/index', $data);
    }
}
