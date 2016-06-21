<?php
	require_once ('../inc/functions.php');
	require_once('pdf.php');

	class phpork_reports
	{
		/*
			generate report functions for feeds
		*/
		
		public function generatePDFReport($pig)
		{
			$pdf = new PDF('P', 'in', array(8.5,11));
			$label = array("Feed Name", "Feed Type", "Quantity", "Unit", "Date Given", "Time Given","Production Date");
			$data = ddl_feedRecord($pig);

			$pdf->AddPage();
			$pdf->setFont("Arial", 12);
			$pdf->Cell("Feed Intake Report", 0, 1, 'C');
			$pdf->Cell("Current Location:");
			$pdf->Cell("Pig ID:");

			$pdf->createPDFTable($label, $data);
			$pdf->Output('I', "Feed-Intake-Report.pdf", true);
		}

		public function generateExcelReport($pig){

			$excel = new PHPExcel();
			$excel->getProperties()
				  ->setCreator(&username)
				  ->setLastModifiedBy(&username)
				  ->setDescription('An excel file about feed-intake-report')
				  ->setSubject('Feed-Intake-Report')
				  ->setKeywords('feed quantity production')
				  ->setCategory('programming');

			$excelWorkSheet = $excel->getSheet(0);
			$excelWorkSheet->setTitle(Feed-Intake-Report);

			$excelWorkSheet->setCellValue('a1', 'Feed Name'); 
			$excelWorkSheet->setCellValue('b1', 'Feed Type');
			$excelWorkSheet->setCellValue('c1', 'Quantity'); 
			$excelWorkSheet->setCellValue('d1', 'Unit');
			$excelWorkSheet->setCellValue('e1', 'Date Given'); 
			$excelWorkSheet->setCellValue('f1', 'Time Given');
			$excelWorkSheet->setCellValue('g1', 'Production Date');

		   	$data = ddl_feedRecord($pig);
		    $excelWorkSheet->fromArray($data, ' ', 'A2');

		    $writer = \PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
			$writer->save('Feed-Intake-Report.xlsx');
		}


		
			

	}

?>