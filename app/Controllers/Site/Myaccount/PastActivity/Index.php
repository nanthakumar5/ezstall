<?php
namespace App\Controllers\Site\Myaccount\PastActivity;

use App\Controllers\BaseController;
use App\Models\Booking;

class Index extends BaseController
{
	public function __construct()
	{
		$this->booking = new Booking();	
	}

	public function index()
    {
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  5; 
		$offset = $page * $perpage;
     	$date	= date('Y-m-d');

    	$userdetail = getSiteUserDetails();
    	$userid=$userdetail['id'];
		$allids = getStallManagerIDS($userid);
		array_push($allids, $userid);

		$bookingcount = $this->booking->getBooking('count', ['booking', 'event', 'users'], ['userid' => $allids]);
		$data['bookings'] = $this->booking->getBooking('all', ['booking', 'event', 'users','barnstall'], ['userid' => $allids,'end_date' => $date,'start' => $offset, 'length' => $perpage]);
		$data['pager'] = $pager->makeLinks($page, $perpage, $bookingcount);
		$data['usertype'] = $this->config->usertype;

    	return view('site/myaccount/pastactivity/index',$data);

    }
}