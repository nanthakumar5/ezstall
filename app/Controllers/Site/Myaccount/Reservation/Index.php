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
		$date	= date('Y-m-d');

		$userid = getSiteUserID();
		$allids = getStallManagerIDS($userid);
		array_push($allids, $userid);
		
		$bookingcount = $this->booking->getBooking('count', ['booking', 'event', 'users'], ['userid'=> $allids, 'gtenddate'=> $date]);
		$data['bookings'] = $this->booking->getBooking('all', ['booking', 'event', 'users', 'barnstall', 'payment'], ['userid'=> $allids, 'gtenddate'=> $date, 'start' => $offset, 'length' => $perpage], ['orderby' => 'b.id desc']);		
		$data['pager'] = $pager->makeLinks($page, $perpage, $bookingcount);
		$data['usertype'] = $this->config->usertype;

    	return view('site/myaccount/reservation/index', $data);
    }


	public function view($id)
	{
    	$userid = getSiteUserID();

		$result = $this->booking->getBooking('row', ['booking', 'event', 'users','barnstall','payment'], ['userid' => [$userid], 'id' => $id]);

		if($result){
			$data['result'] = $result;
		}else{
			$this->session->setFlashdata('danger', 'No Record Found.');
			return redirect()->to(base_url().'/myaccount/bookings'); 
		}
		
		$data['usertype'] = $this->config->usertype;
		return view('site/myaccount/reservation/view', $data);
	}	

	public function bookeduser()
	{
		$requestData = $this->request->getPost(); 
		$result = array();

		if (isset($requestData['search'])) {
			$result = $this->booking->getBooking('all', ['booking'], ['page' => 'reservations', 'search' => ['value' => $requestData['search']]]);
		}

		$response['data'] = $result;

		return $this->response->setJSON($result);
	}
}