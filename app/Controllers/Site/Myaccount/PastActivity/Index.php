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

    	$userdetail = getSiteUserDetails();
    	$userid=$userdetail['id'];

		$bookingcount = $this->booking->getBooking('count', ['booking'], ['userid' => $userid]);
		$data['bookings'] = $this->booking->getBooking('all', ['booking', 'event','stall'], ['userid' => $userid,'start' => $offset, 'length' => $perpage]);

		$data['pager'] = $pager->makeLinks($page, $perpage, $bookingcount);

    	return view('site/myaccount/pastactivity/index',$data);

    }
}