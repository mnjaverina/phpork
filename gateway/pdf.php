<?php

	require_once('fpdf.php');


	class PDF extends FPDF
	{
		public function createPDFTable($label, $data)
		{

				// Colors, line width and bold font
		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		    // Header

		    $w = array(40, 35, 40, 45);
		    for($i=0;$i<count($header);$i++)
		        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
		    $this->Ln();
		    // Color and font restoration
		    $this->SetFillColor(212,212,212);
		    $this->SetTextColor(0);
		    $this->SetFont('');
		    // Data
		    
		    $fill = false;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
		        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
		        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'L',$fill);
		        $this->Cell($w[3],6,$row[3],'LR',0,'L',$fill);
		        $this->Cell($w[4],6,date_format($row[4]),'LR',0,'R',$fill);
		        $this->Cell($w[5],6,date_format($row[5]),'LR',0,'R',$fill);
		        $this->Cell($w[6],6,date_format($row[6]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill = !$fill;
		    }
		    // Closing line
		    $this->Cell(array_sum($w),0,'','T');

		}

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