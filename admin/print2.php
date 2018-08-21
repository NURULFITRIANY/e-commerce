<?php 
	// framework untuk mpdf
	require('fpdf/fpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$pdf=new FPDF();
	$pdf->AddPage();

	$pdf->SetFont('arial', 'B', 16);
	$pdf->Cell(0,5, 'Name of Company', '0', '1', 'C', false);
	$pdf->SetFont('arial', 'i', 8);
	$pdf->Cell(0,5, 'Address example: Edward Andrew Neary 1807 Glenwood St NE Palm Bay FL 32907', '0', '1', 'C', false);
	$pdf->Cell(0,2, 'nurulekafitriany@ymail.com', '0', '1', 'C', false);
	$pdf->Ln(3);
	$pdf->Cell(190,0.6, '', '0', '1', 'C', true);
	$pdf->Ln(5);

	$pdf->SetFont('Arial', 'B', 9);
	$pdf->Cell(50,5, 'Salary Report', '0', '1', 'L', false);
	$pdf->Ln(3);

	
	$sql = mysql_query("SELECT * 
		FROM employee
		WHERE id_employee = $_GET[id_employees] 
		") or die(mysql_error());
	while ($data = mysql_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50,5, 'Employee Name:', $data['employee_name'], '0', '1', 'L', false);
		$pdf->Cell(50,5, 'Start Date:', $_GET['startdate'] , '0', '1', 'L', false);
		$pdf->Cell(50,5, 'End Date:', $_GET['enddate'], '0', '1', 'L', false);
		$pdf->Ln(3);
	}

	$pdf->SetFont('arial', 'B', 7);
	$pdf->Cell(20,6, 'ID workplan',1,0, 'C');
	$pdf->Cell(32,6, 'Tanggal',1,0, 'C');
	$pdf->Cell(32,6, 'Job name',1,0, 'C');
	$pdf->Cell(32,6, 'Cost',1,0, 'C');
	$pdf->Cell(32,6, 'Q/H',1,0, 'C');
	$pdf->Cell(32,6, 'Salary',1,0, 'C');
	$pdf->Ln(2);

	$no = 0;

	// 
	$sql = mysql_query("SELECT job.*, workplan.finished_date AS 'End Date', 
						job_quantity*job_cost AS 'Salary'
						FROM job JOIN workplan ON job.id_job = workplan.id_job 
						WHERE workplan.finished_date BETWEEN '$_GET[startdate]' AND '$_GET[enddate]'
						AND workplan.id_employee = '$_GET[id_employees]'
						");
	while ($data = mysql_fetch_array($sql)) {
		$no++;
		$pdf->Ln(4);
		$pdf->SetFont('arial', '', 7);
		$pdf->Cell(20,4, $data['id_job'],1,0, 'C');
		$pdf->Cell(32,4, $data['End Date'],1,0, 'C');
		$pdf->Cell(32,4, $data['job_name'],1,0, 'C');
		$pdf->Cell(32,4, $data['job_cost'],1,0, 'C');
		$pdf->Cell(32,4, $data['job_quantity'],1,0, 'C');
		$pdf->Cell(32,4, $data['Salary'],1,0, 'C');
	}

	// 
	$sql = mysql_query("SELECT job.*, workplan.finished_date AS 'End Date', 
						job_quantity*job_cost AS 'Salary',
						SUM(job_quantity*job_cost) AS 'Total Salary' 
						FROM job 
						JOIN workplan ON job.id_job = workplan.id_job 
						WHERE workplan.finished_date BETWEEN '$_GET[startdate]' AND '$_GET[enddate]'
						AND workplan.id_employee = '$_GET[id_employees]'
						");
	while ($data = mysql_fetch_array($sql)) {
		$no++;
		$pdf->Ln(4);
		$pdf->SetFont('arial', 'B', 7);
		$pdf->Cell(148,4, 'Total Salary',1,0, 'C');
		$pdf->Cell(32,4, $data['Total Salary'],1,0, 'C');
	}

	$pdf->Output();


?>



