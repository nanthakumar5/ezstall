<?php

namespace App\Controllers\Admin\Report;

use App\Controllers\BaseController;

use App\Models\Event;
use App\Models\Booking;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Index extends BaseController
{
	public function __construct()
	{  
		$this->event  	= new Event();
		$this->booking 	= new Booking();
    }
	
	public function index()
	{	
		$result['event'] = $this->event->getEvent('all', ['event'], ['status' => ['1']]);
		return view('admin/report/index', $result);
	}

	public function exportevent($id)
    {	
    	if($id=='all'){
    		$datas  = $this->event->getEvent('all', ['event']);
    		$data = [];
    		foreach($datas as $event){
    			$data[]	= $this->event->getEvent('row', ['event', 'barn', 'stall', 'bookedstall'],['id' => $event['id']]); 
    		}
    	}else{
    		$data[] 			= $this->event->getEvent('row', ['event', 'barn', 'stall', 'bookedstall'],['id' => $id]);
    	} 

		$spreadsheet 	= new Spreadsheet();
		$sheet 		 	= $spreadsheet->getActiveSheet();

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

     	$row = 2;
     	$col = 1;$col2 = 2;$col3 = 3;$col4 = 4;$col5 = 5;$col6 = 6;$col7 = 7;$col8 = 8;$col9 = 9;$col0 = 10;
        

     	foreach($data as $data){
     		$sheet->setCellValueByColumnAndRow($col, $row, $data['name']);
     		if($data['type']=='1'){
	     		$sheet->setCellValueByColumnAndRow($col2, $row, $data['description']);
	     		$sheet->setCellValueByColumnAndRow($col3, $row, $data['location']);
	     		$sheet->setCellValueByColumnAndRow($col4, $row, $data['mobile']);
	     		$sheet->setCellValueByColumnAndRow($col5, $row, $data['start_date']);
	     		$sheet->setCellValueByColumnAndRow($col6, $row, $data['end_date']);
	     		$sheet->setCellValueByColumnAndRow($col7, $row, formattime($data['start_time']));
	     		$sheet->setCellValueByColumnAndRow($col9, $row, $data['stalls_price']);
	     		$sheet->setCellValueByColumnAndRow($col0, $row, $data['rvspots_price']);
     		}
     		$cols = 1;
     		foreach ($data['barn'] as $key => $barn) { 
				$sheet->setCellValueByColumnAndRow($cols, $row+1, $barn['name']);
					foreach($barn['stall'] as $key=> $stall){  
                        $stallname  = $stall['name'];
                        $status     = 'Available';
                        $bookingname = [];
                        $checkin = [];
                        $checkout = [];
                        foreach($stall['bookedstall'] as $keys=> $booking){
                            $bookingname[]   =   $booking['name'];
                            $checkin[]        =   $booking['check_in'];
                            $checkout[]     =   $booking['check_out'];
                        }
                        $bookingname = implode(" , ", $bookingname);
                        $checkin = implode(" , ", $checkin);
                        $checkout = implode(" , ", $checkout);

                        $sheet->setCellValueByColumnAndRow($cols, $key+$row+2, $stallname.'-'.$status);
                        if($bookingname!=''){ 
	                        $sheet->setCellValueByColumnAndRow($cols, $key+$row+2, $stallname.'Name : '.$bookingname."\n"."Date  : ".$checkin."-".$checkout);
	                        $sheet->getCellByColumnAndRow($cols, $key+$row+2)->getStyle()->getAlignment()->setWrapText(true);
	                        $sheet->getCellByColumnAndRow($cols, $key+$row+2)->getStyle()->getFont()->setBold(true);
                        }
                	} 

                $cols++;
				}
				
				$row = $key+$row+1;
      			$row++;
     	}


       

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$data['name'].'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
    }

	
	}
