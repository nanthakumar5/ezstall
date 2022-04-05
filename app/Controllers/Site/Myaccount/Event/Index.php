<?php 
namespace App\Controllers\Site\Myaccount\Event;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Event;
use App\Models\Stripe;
use App\Models\Booking;
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
				
				return redirect()->to(base_url().'/myaccount/dashboard'); 
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
		$perpage =  5; 
		$offset = $page * $perpage;
		
		if($this->request->getVar('q')!==null){
			$searchdata = ['search' => ['value' => $this->request->getVar('q')], 'page' => 'events'];
			$data['search'] = $this->request->getVar('q');
		}else{
			$searchdata = [];
			$data['search'] = '';
		}
		
		$eventcount = $this->event->getEvent('count', ['event'], $searchdata+['status' => ['1'], 'userid' => $userid]);
		$event = $this->event->getEvent('all', ['event'], $searchdata+['status' => ['1'], 'start' => $offset, 'length' => $perpage, 'userid' => $userid]);
        $data['list'] = $event;
        $data['pager'] = $pager->makeLinks($page, $perpage, $eventcount);
		$data['userid'] = $userid;
		$data['eventcount'] = $eventcount;
    	$data['stripe'] = view('site/common/stripe/stripe1', ['stripepublishkey' => $this->config->stripepublishkey, 'userdetail' => $userdetail]);
		
		return view('site/myaccount/event/index', $data);
    }

    public function action($id='')
	{   
		$userid = getSiteUserID();
		$checksubscription = checkSubscription();
		$checksubscriptiontype = $checksubscription['type'];
		$checksubscriptionfacility = $checksubscription['facility'];
		$checksubscriptionproducer = $checksubscription['producer'];
		$checksubscriptionstallmanager = $checksubscription['stallmanager'];

		$eventcount = $this->event->getEvent('count', ['event'], ['status' => ['1'], 'userid' => $userid]);
		
		if($checksubscriptiontype=='2' && $checksubscriptionfacility!='1'){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}elseif($checksubscriptiontype=='3' && (($id=='' && $checksubscriptionproducer <= $eventcount) || ($id!='' && $checksubscriptionproducer < $eventcount))){
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/events'); 
		}elseif($checksubscriptiontype=='4' && $checksubscriptionstallmanager!='4'){ 
			$this->session->setFlashdata('danger', 'Please subscribe the account.');
			return redirect()->to(base_url().'/myaccount/subscription'); 
		}
		
		if($id!=''){
			$result = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id, 'status' => ['1'], 'userid' => $userid]);
			if($result){
				$data['result'] = $result;
			}else{
				$this->session->setFlashdata('danger', 'No Record Found.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
		}
		
		if ($this->request->getMethod()=='post'){
            $result = $this->event->action($this->request->getPost());
			
			if($result){
				$this->session->setFlashdata('success', 'Event submitted successfully.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}else{
				$this->session->setFlashdata('danger', 'Try Later.');
				return redirect()->to(base_url().'/myaccount/events'); 
			}
        } 
		
		$data['userid'] = $userid;
		$data['statuslist'] = $this->config->status1;
		return view('site/myaccount/event/action', $data);
	}
	
	public function view($id)
    {  
		$data['detail']  = $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id]);
		$booking = $this->booking->getBooking('all', ['booking'],['eventid' => $id]);
		$data['occupied'] = explode(',', implode(',', array_column($booking, 'stall_id')));
		
		return view('site/myaccount/event/view',$data);
    }
	
    public function export($id)
    {	
    	$data 		= $this->event->getEvent('row', ['event', 'barn', 'stall'],['id' => $id]);
		$booking 	= $this->booking->getBooking('all', ['booking'],['eventid' => $id]);
		$occupied 	= explode(',', implode(',', array_column($booking, 'stall_id')));

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
		$sheet->setCellValue('G' . $rows, $data['start_time']);
		$sheet->setCellValue('H' . $rows, $data['end_time']);
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
		header('Content-Disposition: attachment;filename="GeneratedFile.xlsx"');
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
