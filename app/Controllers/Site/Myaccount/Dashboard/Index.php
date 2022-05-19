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
		$countcurrentstall 		= 0;
      	$countcurrentbooking 	= 0;
      	$countpastevent 		= [];
      	$countpaststall 		= 0;
      	$countpastamount 		= 0;
		
     	$datetime			= date('Y-m-d H:i:s');
     	$date				= date('Y-m-d');
    	$userdetail 		= getSiteUserDetails();
    	$usertype 			= $userdetail['type'];
    	$data['usertype'] 	= $this->config->usertype;
    	$userid 			= $userdetail['id'];
		$allids 			= getStallManagerIDS($userid);
		array_push($allids, $userid);
		
      	if($usertype=='3'){
      		$currentreservation = $this->event->getEvent('all', ['event', 'barn', 'stall'],['status' => ['1'], 'userids' => $allids, 'type' => '1', 'gtenddate' => $date]);
      	}
      	if($usertype=='2'){
      		$currentreservation = $this->event->getEvent('all', ['event', 'barn', 'stall'],['status' => ['1'], 'userids' => $allids, 'type' => '2', 'fenddate' => $date]);
      	}
      	
      	if($usertype=='2' || $usertype =='3'){
	  		foreach ($currentreservation as $event) { 
	  			foreach ($event['barn'] as $barn) {
					$countcurrentstall += count(array_column($barn['stall'], 'id'));
				}
			
				$bookedevents = $this->booking->getBooking('all', ['booking','event','barnstall'],['eventid'=> $event['id']]);
				if(count($bookedevents) > 0){
					foreach($bookedevents as $bookedevent){
						$barnstall = $bookedevent['barnstall'];
						if(count($barnstall) > 0) $countcurrentbooking += count(array_column($barnstall, 'stall_id'));
					}
				}
	      	}
      	
	      	$pastevent = $this->booking->getBooking('all', ['booking','event','payment','barnstall'],['userid'=> $allids, 'ltenddate' => $date]);

			foreach ($pastevent as $event) {  
	  			$countpastevent[] = $event['event_id'];
	  			$barnstall = $event['barnstall'];
	  			if(count($barnstall) > 0) $countpaststall += count(array_column($barnstall, 'stall_id'));
	  			$countpastamount += $event['amount'];
	      	}
      	}
		

		$data['monthlyincome'] = $this->booking->getBooking('all', ['booking', 'event', 'payment'],['userid'=> $allids], ['groupby' => 'DATE_FORMAT(b.created_at, "%M %Y")', 'select' => 'SUM(p.amount) as paymentamount, DATE_FORMAT(b.created_at, "%M %Y") AS month']);


		if($usertype=='2'){
			$data['upcomingevents'] = $this->event->getEvent('all', ['event'],['userids' => $allids, 'fenddate'=> $date, 'status' => ['1'], 'type' => '2']);
		}
		if($usertype=='3'){
			$data['upcomingevents'] = $this->event->getEvent('all', ['event'],['userids' => $allids, 'start_date' => $date, 'status' => ['1'], 'type' => '1']);
		}
    	
    	if($usertype=='5'){

    		$horseevent = $this->booking->getBooking('all', ['booking','event','payment','barnstall'],['userid'=> $allids]);

    		$eventid 	= [];
    		$amount 	= 0;
    		$bookingid 	= [];
    		foreach ($horseevent as  $event) {
    			$eventid[] = $event['id'];
    			$amount += $event['amount'];
    			foreach($event['barnstall'] as $stall){
    				$bookingid[] = $stall['booking_id'];
    			}
    		}
    		$data['totalevent']  			= count($eventid);
			$data['totalamount'] 			= $amount;
			$data['totalstall']  			= count($bookingid);
    	}
      	
      	$data['userdetail'] 			= $userdetail;
      	$data['countcurrentstall'] 		= $countcurrentstall; 
      	$data['countcurrentbooking'] 	= $countcurrentbooking;
      	$data['countcurrentavailable'] 	= ($countcurrentstall - $countcurrentbooking);
      	$data['pastevent'] 				= count(array_unique($countpastevent));
      	$data['countpaststall'] 		= $countpaststall;
      	$data['countpastamount'] 		= $countpastamount;
		
		return view('site/myaccount/dashboard/index',$data);
	}
}
