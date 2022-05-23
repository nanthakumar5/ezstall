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
	
	public function eventreport()
    {	
		if ($this->request->getMethod()=='post')
        {
			$requestdata 	= $this->request->getPost();
			$condition 		= ($requestdata['eventid']=='all') ? [] : ['id' => $requestdata['eventid']]; 
			$data			= $this->event->getEvent('all', ['event', 'barn', 'stall', 'bookedstall'], $condition);

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

			foreach($data as $data){
					$sheet->setCellValue('A' . $row, $data['name']);
				if($data['type']=='1'){
					$sheet->setCellValue('B' . $row, $data['description']);
					$sheet->setCellValue('C' . $row, $data['location']);
					$sheet->setCellValue('D' . $row, $data['mobile']);
					$sheet->setCellValue('E' . $row, $data['start_date']);
					$sheet->setCellValue('F' . $row, $data['end_date']);
					$sheet->setCellValue('G' . $row, formattime($data['start_time']));
					$sheet->setCellValue('H' . $row, formattime($data['end_time']));
					$sheet->setCellValue('I' . $row, $data['stalls_price']);
					$sheet->setCellValue('J' . $row, $data['rvspots_price']);
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
		
		$data['event'] = $this->event->getEvent('all', ['event'], ['status' => ['1'], 'type' => '1']);
		return view('admin/report/eventreport', $data);
    }
}
