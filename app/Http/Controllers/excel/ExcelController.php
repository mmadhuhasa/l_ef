<?php

namespace App\Http\Controllers\excel;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExcelController extends Controller {

    public function index(Request $request) {
	$template_name = $request->template_name;
	$format = $request->format;
	switch ($format) {
	    case 'xls':
		$header_content_type = 'Content-Type: application/vnd.ms-excel';
		$header_objWriter = 'Excel5';
		$extension = '.xls';
		break;
	    case 'xlsx':
		$header_content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		$header_objWriter = 'Excel2007';
		$extension = '.xlsx';
		break;
	    case 'odt':
		$header_content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		$header_objWriter = 'Excel2007';
		break;
	    case 'odtx':
		$header_content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		$header_objWriter = 'Excel2007';
		break;
	    default :
		$header_content_type = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		$header_objWriter = 'Excel2007';
		break;
	}
	switch ($template_name) {
	    case 'abcd':
		$template_version = 'Constraints_';
		$heading = 'Manager Constraints';
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A2', 'ManagerEmail')
			->setCellValue('B2', 'RewardName')
			->setCellValue('C2', 'fromDate')
			->setCellValue('D2', 'toDate')
			->setCellValue('E2', 'MaxRewards');
		$objPHPExcel->getActiveSheet()
			->getComment('C2')
			->getText()->createTextRun('Date format should be: YYYY-DD-MM.Ex:2015-03-31');
		$objPHPExcel->getActiveSheet()
			->getComment('D2')
			->getText()->createTextRun('Date format should be: YYYY-DD-MM.Ex:2015-03-31');
		break;
	   
	    default:
		break;
	}
    }
    
    public function create(){
	return view('excel.download');
    }

}
