<?php 
namespace App\Controllers\Site\Myaccount\Dashboard;

use App\Controllers\BaseController;
use App\Models\Event;
use App\Models\Booking;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
	}
    
    public function index()
    { 	
     	$datetime			= date('Y-m-d H:i:s');
    	$userid 			= getSiteUserID();

    	$prevmonth = date('D M Y', strtotime("last month"));
    	$startdatestring=$datetime.'first day of last month';
		$dt=date_create($startdatestring);
		$paststartdate =  $dt->format('Y-m-d');
		$enddatestring = $datetime.'last day of last month';
		$dt=date_create($enddatestring);
		$endstartdate = $dt->format('Y-m-d');
    	$eventpast = $this->event->getEvent('all', ['event', 'stallcount','bookingstall'],['userid'=>$userid,'start_date' => $paststartdate,'end_date' => $endstartdate]);
    	$price = [];
      	$paststallcount = [];
      	$totaleventpast = [];
      		foreach ($eventpast as $eventkey => $event) { 
      			$totaleventpast[] = $event['id'];
      			foreach ($event['stall'] as $stallcount) { 
					foreach ($stallcount['booking'] as $key => $booking) {
						if($booking['stall_id']!=''){
							$paststallcount[] = $booking['stall_id']; 
							$price[] = $stallcount['price'];
						}
		      		}
				}

	      	}

    	$event['upcomingevents'] = $this->event->getEvent('all', ['event'],['userid'=>$userid,'start_date' => $datetime,'status' => ['1']]);

      	$events = $this->event->getEvent('all', ['event', 'stallcount','bookingstall'],['userid'=>$userid,'start_date' => $datetime]);
      	$bookingstall = [];
      	$currentstallcount = [];

      		foreach ($events as $stallkey => $stall) { 
      			foreach ($stall['stall'] as $stallcount) {
					$currentstallcount[] = $stallcount['id'];
					foreach ($stallcount['booking'] as $key => $booking) {
	      			$bookingstall[] = $booking['id'];
		      		}
				}
	      	}
      	

      	$event['stallcount'] 		= count($currentstallcount);
      	$event['bookingstall'] 		= count($bookingstall); 
      	$event['paststallcount'] 	= count($paststallcount);
      	$event['totaleventpast'] 	= count($totaleventpast);
      	$event['paststallprice'] 	= array_sum($price);
      	$event['available'] 	= ($event['stallcount'] - $event['bookingstall']);
		return view('site/myaccount/dashboard/index',$event);
	}
}
