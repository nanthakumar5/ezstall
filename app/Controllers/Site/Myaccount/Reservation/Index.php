<?php
namespace App\Controllers\Site\Myaccount\Reservation;

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

    	$userid = getSiteUserID();

		$bookingcount = $this->booking->getBooking('count', ['booking'], ['userid' => $userid]);
		$data['bookings'] = $this->booking->getBooking('all', ['booking', 'event','stall'], ['userid' => $userid,'start' => $offset, 'length' => $perpage]);

		$data['pager'] = $pager->makeLinks($page, $perpage, $bookingcount);

    	return view('site/myaccount/reservation/index',$data);

    }


	public function view($id)
	{
    	$userid = getSiteUserID();

		$result = $this->booking->getBooking('row', ['booking', 'event','stall'], ['id' => $id,'userid' => $userid]);

		if($result){
			$data['result'] = $result;
		}else{
			$this->session->setFlashdata('danger', 'No Record Found.');
			return redirect()->to(base_url().'/myaccount/bookings'); 
		}

		return view('site/myaccount/reservation/view', $data);
	}	
}