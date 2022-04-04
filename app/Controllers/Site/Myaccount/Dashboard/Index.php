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
     	$date				= date('Y-m-d');
    	$userid 			= getSiteUserID();
		
      	$countpaststall 	= 0;
      	$countpastamount 	= 0;
      	
    	$pastevent = $this->booking->getBooking('all', ['booking','event','payment','barnstall'],['userid'=>[$userid],'end_date' => $date],['groupBy'=>'id']);

  		foreach ($pastevent as $event) {  
  			$barnstall = $event['barnstall'];
  			if(count($barnstall) > 0) $countpaststall += count(array_column($barnstall, 'stall_id'));
  			$countpastamount += $event['paymentamount'];
      	}

      	$currentreservation = $this->event->getEvent('all', ['event', 'bookingstall'],['userid'=>$userid,'start_date' => $datetime]);
      	
      	$bookingstall 		= [];
      	$stallid 			= [];

  		foreach ($currentreservation as $stallkey => $stall) { 
  			foreach ($stall['bookingstall'] as $booking) {
				$bookinid[] = $booking['booking_id'];
				$stallid[] 	= $booking['stall_id'];
			}
      	}

      	$data['monthlyincome'] = $this->booking->getBooking('all', ['event','booking','payment'],['userid'=>[$userid]]);
    	$data['upcomingevents'] = $this->event->getEvent('all', ['event'],['userid'=>$userid,'start_date' => $datetime,'status' => ['1']]);
      	

      	$data['stallid'] 			= count($stallid);
      	$data['bookingstall'] 		= count($bookingstall); 
      	$data['pastevent'] 			= count($pastevent);
      	$data['countpaststall'] 	= $countpaststall;
      	$data['countpastamount'] 	= $countpastamount;

      	$data['available'] 	= ($data['stallid'] - $data['bookingstall']);
      	
		return view('site/myaccount/dashboard/index',$data);
	}
}
