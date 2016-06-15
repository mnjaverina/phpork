<?php
	require_once ('../functions.php');
	require_once('pdf.php');
	
	class reports

	{
		/*
			generate report functions for feeds
		*/
		public function generatePDFReport($pig)
		{
			$pdf = new PDF();
			PDF_open_file($pdf, "Feed-Intake-Report.pdf");
			PDF_begin_page($pdf, (72*8.5), (72*11));
			$fontstyle = PDF_findfont($pdf, "Arial", "host", 1);
			PDF_setfont($pdf, $fontstyle, 12);

			//text area
			PDF_show($pdf, "Feed Intake Report");
			PDF_show($pdf, "Location: ");


			$label = array("Feed Name", "Feed Type", "Quantity", "Unit", "Date Given", "Time Given","Production Date");
			$data = ddl_feedRecord($pig);

			$pdf->AddPage();
			$pdf->createPDFTable($label, $data);
			$pdf->Output();
		}
		
			

	}

?>