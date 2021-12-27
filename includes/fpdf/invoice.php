<?php
require_once('./includes/fpdf/fpdf.php');

class PDF extends FPDF
{
	// Page header
	function Header()
	{
		$this->AddFont('great_vibes','','great_vibes.php');
		// Arial bold 15
		$this->SetFont('great_vibes','',25);
		$this->SetTextColor(200, 0, 0);
		$this->Cell(60,10,'Hillside Hotel',0,0,'L');
		$this->Cell(75);
		$this->SetFont('Arial','',11);
		$this->SetTextColor(150, 150, 150);
		$this->Cell(60,10,'INVOICE',0,0,'L');
		// Line break
		$this->Ln(12);
		$this->SetTextColor(80, 80, 80);
		$this->Cell(60,10,'23 53rd Street',0,0,'L');
		$this->Cell(75);
		$this->Cell(60,10,'Phone: 555-2231-322',0,0,'L');
		$this->Ln(5);
		$this->Cell(60,10,'San Francisco, CA 42122',0,0,'L');
		$this->Cell(75);
		$this->SetTextColor(0, 170, 209);
		$this->Cell(60,10,'daw.proiect.2021@gmail.com',0,0,'L');
	}
}

function getPDF($room_type, $checkin, $checkout, $res_id, $room_no, $payment_date, $payment_total, $client){
	$pdf = new PDF();
	$pdf->AddPage('L','A5');

	$pdf->Ln(25);

	$pdf->SetFont('Arial','',18);
	$pdf->Cell(30,10,'Booking Details',0,0,'L');
	$pdf->Cell(70,10);
	$pdf->Cell(30,10,'Invoice',0,0,'L');
	$pdf->Ln(15);

	$data = [
		[
			'Accommodation' => $room_type,	
			'Payment Date' => $payment_date
		],
		[
			'Check In' => $checkin,
			'Reservation ID' => $res_id
		],
		[
			'Room No. ' => $room_no
		],
		[
			'Check Out' => $checkout,
			'Total' => $payment_total
		]
	];

	foreach ($data as $row) {
		foreach($row as $k => $v){
			if($k == 'Total'){
				$v = '$ ' . $v;
			}
			$k_fsize = $k != 'Total' ? 12 : 18;
			$v_fsize = $k != 'Total' ? 12 : 18;

			$pdf->SetFont('Arial','B',$k_fsize);
			$pdf->SetTextColor(100, 100, 100);
			$pdf->Cell(3);
			$pdf->Cell(30,10,$k,0,0,'L');
			$pdf->Cell(5);
			$pdf->SetFont('Arial','',$v_fsize);
			$pdf->Cell(45,10,$v,0,0,$k == 'Total' ? 'L' : 'R');
			$pdf->Cell(17);
		}	
		$pdf->Ln(8);	
	}

	$x = $pdf->GetX();
	$y = $pdf->Gety();

	$pdf->SetXY(8, 50);

	$pdf->SetDrawColor(180, 180, 180);
	$pdf->Cell(95, 78, '', 1, 0);
	$pdf->Cell(5);
	$pdf->Cell(95, 55, '', 1, 0);

	$pdf->SetXY($x, $y);
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(90, 8, 'CLIENT', 0, 0, 'C');
	$pdf->Ln(8);
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(90, 10, "$client", 0, 0, 'C');
	$pdf->Output();
}

?>
