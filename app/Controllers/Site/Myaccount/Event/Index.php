<?php 
namespace App\Controllers\Site\Myaccount\Event;

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
		$this->users 	= new Users();
		$this->event 	= new Event();
		$this->booking 	= new Booking();
		$this->stripe 	= new Stripe();
	}
    
    public function index()
    { 			
		$userdetail 					= getSiteUserDetails();
		$userid 						= $userdetail['id'];
		$usertype						= $userdetail['type'];

		if($usertype == '4') $userid = $userdetail['parent_id'];
		
		if ($this->request->getMethod()=='post')
        {
			$requestData = $this->request->getPost();

			if(isset($requestData['stripepay'])){
				$payment = $this->stripe->action(['status' => '1', 'id' => $requestData['stripepayid']]);
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
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status' => ['1'], 'userid' => $userid, 'type' => '1', 'start' => $offset, 'length' => $perpage], ['orderby' => 'e.id desc']);
		$settings = getSettings();
		
        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		$data['userid'] = $userid;
		$data['usertype'] = $usertype;
		$data['eventcount'] = $eventcount;
		$data['currencysymbol'] = $this->config->currencysymbol;
    	$data['stripe'] = view('site/common/stripe/stripe1', ['pagetype' => '1']);
    	$data['settings'] = $settings;
		
		return view('site/myaccount/event/index', $data);
    }

    public function action($id='')
	{   
		$userdetails 					= getSiteUserDetails();
		$userid         				= $userdetails['id'];
		$usertype       				= $userdetails['type'];
		$checksubscription 				= checkSubscription();
		$checksubscriptiontype 			= $checksubscription['type'];
		$checksubscriptionproducer 		= $checksubscription['producer'];
		$checksubscriptionstallmanager 	= $checksubscription['stallmanager'];

		$eventcount = $this->event->getEvent('count', ['event'], ['status' => ['1'], 'userid' => $userid, 'type' => '1']);
		
		if($checksubscriptiontype=='3' && (($id=='' && $checksubscriptionproducer <= $eventcount) || ($id!='' && $checksubscriptionproducer < $eventcount))){
			$this->session->setFlashdata('danger', 'Please pay now for add more event');
			return redirect()->to(base_url().'/myaccount/events'); 
		}elseif($checksubscriptiontype=='4' && $checksubscriptionstallmanager!='4'){ 
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}
		
		if($id!=''){
			$result = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'status' => ['1'], 'userid' => $userid, 'type' => '1']);
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
			$requestData 			= $this->request->getPost();
			$requestData['type'] 	= '1';

			if(isset($requestData['start_date'])) $requestData['start_date'] 	= formatdate($requestData['start_date']);
    		if(isset($requestData['end_date'])) $requestData['end_date'] 		= formatdate($requestData['end_date']);
            $result = $this->event->action($requestData);
			
			if($result){
				$this->session->setFlashdata('success', 'Event submitted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        } 
		
		$data['userid'] 	= $userid;
		$data['statuslist'] = $this->config->status1;
		return view('site/myaccount/event/action', $data);
	}
	
	public function view($id)
    {  
		$data['detail']  	= $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' => '1']);
		$data['occupied'] 	= getOccupied($id); 
		$data['reserved'] 	= getReserved($id);
		
		return view('site/myaccount/event/view',$data);
    }
	
    public function export($id)
    {	
    	$data 		= $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'type' => '1']);
		$booking 	= $this->booking->getBooking('all', ['booking'],['eventid' => $id]);
		$occupied 	= getOccupied($id); 

		$spreadsheet = new Spreadsheet();
		$sheet 		 = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('A1', 'Event Name');
		$sheet->setCellValue('B1', 'Description');
		$sheet->setCellValue('C1', 'Location');
		$sheet->setCellValue('D1', 'Mobile');
		$sheet->setCellValue('E1', 'start_date');
		$sheet->setCellValue('F1', 'end_date');
		$sheet->setCellValue('G1', 'start_time');
		$sheet->setCellValue('H1', 'end_time');
		$sheet->setCellValue('I1', 'stalls_price');
		$sheet->setCellValue('J1', 'rvspots_price');

     	$rows = 2;
		$sheet->setCellValue('A' . $rows, $data['name']);
		$sheet->setCellValue('B' . $rows, $data['description']);
		$sheet->setCellValue('C' . $rows, $data['location']);
		$sheet->setCellValue('D' . $rows, $data['mobile']);
		$sheet->setCellValue('E' . $rows, $data['start_date']);
		$sheet->setCellValue('F' . $rows, $data['end_date']);
		$sheet->setCellValue('G' . $rows, formattime($data['start_time']));
		$sheet->setCellValue('H' . $rows, formattime($data['end_time']));
		$sheet->setCellValue('I' . $rows, $data['stalls_price']);
		$sheet->setCellValue('J' . $rows, $data['rvspots_price']);
        
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

      	$reader 		= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
      	$spreadsheet 	= $reader->load($_FILES['file']['tmp_name']);
		$sheetdata 		= $spreadsheet->getActiveSheet()->toArray();
		$array 			= [];
		
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
