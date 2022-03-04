<?php 

namespace App\Controllers\Site\Myaccount;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Barn;
use App\Models\Stall;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
		$this->barn = new Barn();
		$this->stall = new Stall();
		$this->uri = service('uri');
	}
    
    public function index()
    { 	
    	$data['events'] = $this->event->getEvent('all', ['event'],['status'=>'1'], ['orderby' => 'start_date', 'sort'=>'ASC']);
    	
        return view('site/myaccount/index', $data);
    }

    
}
