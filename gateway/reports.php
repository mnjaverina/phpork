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


		
			

	}

?>