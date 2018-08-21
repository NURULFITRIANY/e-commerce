<?php 

if (isset($_GET['table']) AND $_GET['table'] == 'product') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	
	// $mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf=new mPDF('c','A4-l','','',32,25,27,25,16,13); 
	$mpdf->SetDisplayMode('fullpage');

	$mpdf->writeHTML("
		<h1> Table. Product </h1>
		<br>
		<table style='width: 27cm;' border='1' cellspacing='0'>
			<tbody>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> Judul </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Deskripsi </td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> Isi </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> Harga</td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ID-Harga</td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> Stok </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> Tanggal</td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> Gambar</td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ID-Kategori</td>
			</tr>
			
		");
	$query = mysql_query('SELECT produk.*, kategori_harga.kategori_harga, kategori.kategori 
				FROM `produk` 
				INNER JOIN kategori on produk.id_kategori= kategori.id_kategori 
				INNER JOIN kategori_harga on produk.id_kategori_harga = kategori_harga.id_kategori_harga');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_produk]." </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[judul]." </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[deskripsi]."</td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[isi]." </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[harga]." </td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[kategori_harga]." </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[stok]." </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[tanggal]." </td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[gambar]." </td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[kategori]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
			<tbody>
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'job') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Job</h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'1.29cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'4.92cm' style='border:0.01cm solid black text-align: center;'> Produk </td>
				
				<td width:'5.08cm' style='border:0.01cm solid black text-align: center;'> Job </td>

				<td width:'4.14cm' style='border:0.01cm solid black text-align: center;'> Salary (hours) </td>

				<td width:'2.54cm' style='border:0.01cm solid black text-align: center;'> Job Quantity </td>

				<td width:'8.35cm' style='border:0.01cm solid black text-align: center;'> Job Description</td>
			</tr>
		
		");
	$query = mysql_query('SELECT job.id_job, job.job_name, job.job_cost, job.job_quantity, job.job_description, produk.judul 
									FROM job JOIN produk 
									ON job.id_produk = produk.id_produk');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'1.29cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_job]." </td>
				
				<td width:'4.92cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[judul]." </td>
				
				<td width:'5.08cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[job_name]."</td>

				<td width:'4.14cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[job_cost]." </td>

				<td width:'2.54cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[job_quantity]." </td>

				<td width:'8.35cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[job_description]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'employee') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Employee</h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'2cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Name </td>
				
				<td width:'3.75cm' style='border:0.01cm solid black text-align: center;'> Education </td>

				<td width:'3.75cm' style='border:0.01cm solid black text-align: center;'> Skill </td>

				<td width:'4.49cm' style='border:0.01cm solid black text-align: center;'> Address </td>

				<td width:'3.12cm' style='border:0.01cm solid black text-align: center;'> Phone </td>

				<td width:'4.39cm' style='border:0.01cm solid black text-align: center;'> Email </td>
			</tr>
		
		");
	$query = mysql_query('SELECT * FROM employee');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'2cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_employee]." </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_name]." </td>
				
				<td width:'3.75cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_education]."</td>

				<td width:'3.75cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_skill]." </td>

				<td width:'4.49cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_address]." </td>

				<td width:'3.12cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_phone]." </td>

				<td width:'4.39cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_email]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'workplan') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Workplan </h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'0.99cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'4.87cm' style='border:0.01cm solid black text-align: center;'> Employee's Name </td>
				
				<td width:'2.92cm' style='border:0.01cm solid black text-align: center;'> Job </td>

				<td width:'1.09cm' style='border:0.01cm solid black text-align: center;'> ID Pesanan </td>

				<td width:'6.04cm' style='border:0.01cm solid black text-align: center;'> Note </td>

				<td width:'1.65cm' style='border:0.01cm solid black text-align: center;'> Status </td>

				<td width:'2.97cm' style='border:0.01cm solid black text-align: center;'> Finished </td>

				<td width:'2.87cm' style='border:0.01cm solid black text-align: center;'> Payment Status </td>

				<td width:'2.97cm' style='border:0.01cm solid black text-align: center;'> Payment Due </td>
			</tr>
		
		");
	$query = mysql_query('SELECT * FROM workplan');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'0.99cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_workplan]." </td>
				
				<td width:'4.87cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_name]." </td>
				
				<td width:'2.92cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[job_name]."</td>

				<td width:'1.09cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[id_pesanan]." </td>

				<td width:'6.04cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[employee_note]." </td>

				<td width:'1.65cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[workplan_status]." </td>

				<td width:'2.97cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[finished_date]." </td>

				<td width:'2.87cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[payment_status]." </td>

				<td width:'2.97cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[payment_due]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'partnership') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Product </h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> Nama Produk </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Perusahaan </td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> Alamat </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> Kontak</td>
			</tr>
		
		");
	$query = mysql_query('SELECT partnership.id_partnership, partnership.partnership_name, partnership.alamat_partnership, partnership.telepon_partnership, produk.judul 
									FROM partnership JOIN produk 
									ON partnership.id_produk = produk.id_produk');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_partnership]." </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[judul]." </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[partnership_name]."</td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[alamat_partnership]." </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[telepon_partnership]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'info_pesan') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Product </h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Pemesan </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Alamat </td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> Tanggal </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> Harga </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> Status pesanan </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> Status pembayaran </td>
			</tr>
		
		");
	$query = mysql_query('SELECT pesanan.id_pesanan, member.nama_depan, member.nama_belakang, member.alamat, pesanan.tanggal, pesanan.harga, pesanan.workplan_status, status_pesanan.status_pesanan, status_pembayaran.status_pembayaran 
					FROM pesanan 
					INNER JOIN member ON pesanan.id_member=member.id_member 
					INNER JOIN status_pesanan ON pesanan.id_status_pesanan=status_pesanan.id_status_pesanan 
					INNER JOIN status_pembayaran ON pesanan.id_status_pembayaran=status_pembayaran.id_status_pembayaran');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_pesanan]." </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[nama_depan]." ".$hasil[nama_belakang]." </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[alamat]." </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[tanggal]."</td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[harga]." </td>

				<td width:'0.8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[status_pesanan]." </td>

				<td width:'2.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[status_pembayaran]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} elseif (isset($_GET['table']) AND $_GET['table'] == 'member') {
	// framework untuk mpdf
	require('mpdf/mpdf.php');
	// include database
	require('inc/config.php');
	// variable mpdf untuk konfigurasi aturan awal
	// 18 = dalam milimeter
	$mpdf=new mpdf('utf-8', 'A4-l', '', '', 10,10,10,10);

	$mpdf->writeHTML("
		<h1> Table. Product </h1>
		<br>
		<table style='width: 27cm;' border='1'>
			<tr style='background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;'>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ID </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> Nama </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> Alamat </td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> Email </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> Telepon </td>
			</tr>
		
		");
	$query = mysql_query('SELECT * FROM member');
	while ($hasil=mysql_fetch_array($query)) {
		$mpdf->writeHTML ("
			<tr>
				<td width:'0.8cm' style='border:0.01cm solid black; text-align: center;'> ".$hasil[id_member]." </td>
				
				<td width:'3.5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[nama_depan]." ".$hasil[nama_belakang]." </td>
				
				<td width:'5cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[alamat]."</td>

				<td width:'8cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[email]." </td>

				<td width:'2cm' style='border:0.01cm solid black text-align: center;'> ".$hasil[telepon]." </td>
			</tr>
		");
	}
	// echo sama dengan $mpdf->writeHTML untuk PDF
	$mpdf->writeHTML("
		</table>
		");
	$mpdf->Output();

} 
 ?>
 		