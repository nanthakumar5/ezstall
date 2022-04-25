<?php 
namespace App\Controllers\Site\Myaccount\Facility;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Stripe;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Index extends BaseController
{
	public function __construct()
	{	
		$this->event = new Event();
		$this->users = new Users();
		$this->stripe = new Stripe();
		$this->booking = new Booking();
	}
    
    public function index()
    { 			
		$userdetail = getSiteUserDetails();
		$userid = $userdetail['id'];
		$usertype = $userdetail['type'];
		if($usertype == '4') $userid = $userdetail['parent_id'];
		
		if ($this->request->getMethod()=='post')
        {
			$requestData = $this->request->getPost();
			if(isset($requestData['stripepay'])){
				$payment = $this->stripe->stripepayment($requestData);
				if($payment){
					$usersubscriptioncount = $userdetail['producer_count'];
					$this->users->action(['user_id' => $userid, 'actionid' => $userid, 'producercount' => $usersubscriptioncount+1]);
					$this->session->setFlashdata('success', 'Successfully paid.');
				}else{
					$this->session->setFlashdata('danger', 'Try Later.');
				}
				
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$result = $this->event->delete($requestData);
				
				if($result){
					$this->session->setFlashdata('success', 'Event deleted successfully.');
					return redirect()->to(base_url().'/myaccount/events'); 
				}else{
					$this->session->setFlashdata('danger', 'Try Later');
					return redirect()->to(base_url().'/myaccount/events'); 
				}
			}
        }
		
    	$pager = service('pager'); 
		$page = (int)(($this->request->getVar('page')!==null) ? $this->request->getVar('page') :1)-1;
		$perpage =  10; 
		$offset = $page * $perpage;
		
		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}
		
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status' => ['1'], 'userid' => $userid, 'type' => '1']);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status' => ['1'], 'userid' => $userid, 'type' => '2', 'start' => $offset, 'length' => $perpage], ['orderby' => 'e.id desc']);

        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		$data['userid'] = $userid;
		$data['usertype'] = $usertype;
		$data['eventcount'] = $eventcount;
    	$data['stripe'] = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
		return view('site/myaccount/facility/index', $data);
    }

    public function action($id='')
	{   
		$userdetails 	= getSiteUserDetails();
		$userid         = $userdetails['id'];
		$usertype       = $userdetails['type'];
		$checksubscription = checkSubscription();
		$checksubscriptiontype = $checksubscription['type'];
		$checksubscriptionfacility = $checksubscription['facility'];
		$checksubscriptionstallmanager = $checksubscription['stallmanager'];

		$eventcount = $this->event->getEvent('count', ['event'], ['status' => ['1'], 'userid' => $userid, 'type' => '2']);
		
		if($checksubscriptiontype=='2' && $checksubscriptionfacility!='1'){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}
		elseif($checksubscriptiontype=='4' && $checksubscriptionstallmanager!='4'){ 
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}
		
		if($id!=''){
			$result = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'status' => ['1'], 'userid' => $userid, 'type' => '2']);
			if($result){				
				$data['occupied'] 	= getOccupied($id);
				$data['reserved'] 	= getReserved($id);
				$data['result'] 	= $result;
			}else{
				$this->session->setFlashdata('danger', 'No Record Found.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
		}
		
		if ($this->request->getMethod()=='post'){
			$requestData = $this->request->getPost();
			if(isset($requestData['start_date'])) $requestData['start_date'] 	= formatdate($requestData['start_date']);
    		if(isset($requestData['start_date'])) $requestData['end_date'] 		= formatdate($requestData['end_date']);
    		$requestData['type'] = '2';
            $result = $this->event->action($requestData);
			
			if($result){
				$this->session->setFlashdata('success', 'Event submitted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        } 
		
		$data['userid'] = $userid;
		$data['usertype'] = $usertype;
		$data['statuslist'] = $this->config->status1;
		$data['stripe'] = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetails]);
		return view('site/myaccount/facility/action', $data);
	}
	
	public function view($id)
    {  
		$data['detail']  	= $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' => '2']);
		$data['occupied'] 	= getOccupied($id); 
		$data['reserved'] 	= getReserved($id);
		
		return view('site/myaccount/facility/view',$data);
    }
	
    public function export($id)
    {	
    	$data 		= $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' => '2']);
		$booking 	= $this->booking->getBooking('all', ['booking'],['eventid' => $id]);
		$occupied 	= getOccupied($id); 

		$spreadsheet = new Spreadsheet();
		$sheet 		 = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Event Name');

     	$rows = 2;
		$sheet->setCellValue('A' . $rows, $data['name']);
        
         $row = 4;
         $col = 1;
         foreach ($data['barn'] as $barn) {  
				$sheet->setCellValueByColumnAndRow($col, $row, $barn['name']);

			foreach($barn['stall'] as $key=> $stall){   
				$stallname = $stall['name'];
				$status = in_array($stall['id'], $occupied)? 'Occupied' : 'Available'; 
				$sheet->setCellValueByColumnAndRow($col, $key+$row+1, $stallname. '- ' .$status);
			}
			$col++;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$data['name'].'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
    }
	
	public function importbarnstall()
    {	
		$phpspreadsheet = new Spreadsheet();

      	$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      	$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
		$sheetdata = $spreadsheet->getActiveSheet()->toArray();
		$array = [];
		
		foreach($sheetdata as $key1 => $data1){
			if($key1=='0') continue;
			
			foreach($data1 as $key2 => $data2){
				if($key1=='1' && ($key2%2)=='0'){
					$array[$key2]['name'] = $data2;
				}
				
				if($key1 > '1'  && ($key2%2)=='0'){
					$array[$key2]['stall'][] = ['name' => $data2, 'price' => (isset($data1[$key2+1]) ? $data1[$key2+1] : '')];
				}
			}
		}
		
		$array = array_values($array);
		echo json_encode($array);
    }
}
