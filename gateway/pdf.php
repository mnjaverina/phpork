<?php

	require_once('fpdf.php');


	class PDF extends FPDF
	{
		public function createPDFTable($label, $data)
		{

		    $this->SetFillColor(255,0,0);
		    $this->SetTextColor(255);
		    $this->SetDrawColor(128,0,0);
		    $this->SetLineWidth(.3);
		    $this->SetFont('','B');
		  

		    $width = array(45, 45, 40, 35, 45, 45, 45);
		    for($i=0;$i<count($label);$i++)
		        $this->Cell($width[$i],7,$label[$i],1,0,'C',true);
		    $this->Ln();
		   
		    $this->SetFillColor(212,212,212);
		    $this->SetTextColor(0);
		    $this->SetFont('');
		    
		    
		    $fill = false;
		    foreach($data as $row)
		    {
		        $this->Cell($width[0],6,$row[0],'LR',0,'L',$fill);
		        $this->Cell($width[1],6,$row[1],'LR',0,'L',$fill);
		        $this->Cell($width[2],6,number_format($row[2]),'LR',0,'L',$fill);
		        $this->Cell($width[3],6,$row[3],'LR',0,'L',$fill);
		        $this->Cell($width[4],6,date_format($row[4]),'LR',0,'R',$fill);
		        $this->Cell($width[5],6,date_format($row[5]),'LR',0,'R',$fill);
		        $this->Cell($width[6],6,date_format($row[6]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill = !$fill;
		    }
		  
		    $this->Cell(array_sum($w),0,'','T');

		}


	}


?>