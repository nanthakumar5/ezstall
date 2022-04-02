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
		$this->booking = new Booking();
	}
    
    public function index()
    { 	
     	$datetime			= date('Y-m-d H:i:s');
    	$userid 			= getSiteUserID();
		
    	$pastevent = $this->booking->getBooking('all', ['event','booking','booking_details','payment'],['userid'=>[$userid],'end_date' => $datetime]);
      	$countpastevent = [];
      	$countpaststall = [];
      	$countpastamount = [];
      		foreach ($pastevent as $eventkey => $event) {  
      			$countpastevent[] = $event['id'];
      			$countpaststall[] = $event['stallid'];
      			$countpastamount[] = $event['useramount'];
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

      	$event['monthlyincome'] = $this->booking->getBooking('all', ['event','booking','payment'],['userid'=>[$userid]]);


      	$event['stallcount'] 		= count($currentstallcount);
      	$event['bookingstall'] 		= count($bookingstall); 
      	$event['countpaststall'] 	= count($countpaststall)?count($countpaststall): 0; 
      	$event['pastevent'] 		= count($countpastevent);
      	$event['countpastamount'] 	= array_sum($countpastamount);

      	$event['available'] 	= ($event['stallcount'] - $event['bookingstall']);
      	
		return view('site/myaccount/dashboard/index',$event);
	}
}
