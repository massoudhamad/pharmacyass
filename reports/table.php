<?php
//call the autoload
require 'vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

//styling arrays
//table head style
$tableHead = [
	'font'=>[
		'color'=>[
			'rgb'=>'FFFFFF'
		],
		'bold'=>true,
		'size'=>11
	],
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '538ED5'
		]
	],
];
//even row
$evenRow = [
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '00BDFF'
		]
	]
];
//odd row
$oddRow = [
	'fill'=>[
		'fillType' => Fill::FILL_SOLID,
		'startColor' => [
			'rgb' => '00EAFF'
		]
	]
];

//styling arrays end

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();

//set default font
$spreadsheet->getDefaultStyle()
	->getFont()
	->setName('Arial')
	->setSize(10);

//heading
$spreadsheet->getActiveSheet()
	->setCellValue('A1',"Monthly Diagnosis Report");


//merge heading
$spreadsheet->getActiveSheet()->mergeCells("A1:F1");
$spreadsheet->getActiveSheet()->mergeCells("C2:D2");
//$spreadsheet->getActiveSheet()->mergeCells("C3:D3");
$spreadsheet->getActiveSheet()->mergeCells("E2:F2");
$spreadsheet->getActiveSheet()->mergeCells("E2:F2");


// set font style
$spreadsheet->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$spreadsheet->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(8);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);

//header text
$spreadsheet->getActiveSheet()
	->setCellValue('A2',"No")
	->setCellValue('A3',"")
	->setCellValue('B2',"Dignosis")
	->setCellValue('B3',"")
	->setCellValue('C2',"Under 5yrs")
	->setCellValue('C3',"New case")
	->setCellValue('E2',"5yrs and above")
	->setCellValue('D3',"Repeate case")
	->setCellValue('E3',"New case")
	->setCellValue('F3',"Repeate case");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($tableHead);


//the content
//read the json file
//$file = file_get_contents('student-data.json');
include("../DB.php");
$db=new DBHelper();
$month=$_REQUEST['month'];
$diagnosisReport = $db->getDiagnosisReport($month);
//$studentData = json_decode($file,true);

//loop through the data
//current row
$row=3;
$x = 1;
foreach($diagnosisReport as $student){
	
	$spreadsheet->getActiveSheet()
		->setCellValue('A'.$row , $x++)
		->setCellValue('B'.$row , $student['icdcode'])
		->setCellValue('C'.$row , $student['new_underfive'])
		->setCellValue('D'.$row , $student['repeate_underfive'])
		->setCellValue('E'.$row , $student['new_overfive'])
		->setCellValue('F'.$row , $student['repeate_overfive']);
	
	//set row style
	if( $row % 2 == 0 ){
		//even row
		//$spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($evenRow);
	}else{
		//odd row
		//$spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($oddRow);
	}
	//increment row
	$row++;
}

//autofilter
//define first row and last row
$firstRow=2;
$lastRow=$row-1;
//set the autofilter
//$spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":F".$lastRow);

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename="result.xlsx"');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');
