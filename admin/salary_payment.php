<?php $page = "SALARY PAYMENT";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Management of Salary Payment Method</h1>
	<hr>
	<h2> Management of Job</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahsalarypayment') {
		echo "
            <h3>Tambah Data</h3>
            
            <form name='tambah' action='?act=proses_tambahsalarypayment' method='post' enctype='multipart/form-data'>
                <p><input type='text' name='job_name' placeholder='Job'></p>
                <p><input type='text' name='job_cost' placeholder='Job Cost'></p>
                <p><input type='text' name='job_quantity' placeholder='Job Quantity'></p>
                <p><textarea name='job_description' cols='50' rows='10' placeholder='Job Description'></textarea></p>
                
                <p>
                    Produk: <select name='id_produk'>
            ";
                        $produk = mysql_query("SELECT * FROM produk");
                        while($opsi=mysql_fetch_array($produk)){
                            echo "<option value='$opsi[id_produk]'>$opsi[judul]</option>";
                        }
        echo "
                    </select>
                </p>
                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
            </form>
            
            <hr>
        ";

		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahsalarypayment') {
			$tambah = mysql_query("INSERT INTO job (id_produk, job_name, job_cost, job_quantity, job_description)
                            VALUES ('$_POST[id_produk]',
                            '$_POST[job_name]',
                            '$_POST[job_cost]',
                            '$_POST[job_quantity]',
                            '$_POST[job_description]')") or die(mysql_error());
                            
		    if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='editsalarypayment') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM job WHERE id_job = '$_GET[id]'"));
			// klo textarea tidak pakai value utk retrieve previous data
			// <input type='text' name='id' value='$isi[id_job]' style='visibility:hidden;'> --> input dummy untuk buat nangkap $_post[id]
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='edit' action='?act=proses_editsalarypayment' method='post'>
	               <input type='text' name='id' value='$isi[id_job]' style='visibility:hidden;'>
	                <p><input type='text' name='job_name' value='$isi[job_name]' placeholder='Job'></p>
	                <p><input type='text' name='job_cost' value='$isi[job_cost]' placeholder='Job Cost'></p>
	                <p><input type='text' name='job_quantity' value='$isi[job_quantity]' placeholder='Job Quantity'></p>
	                <p><textarea name='job_description' cols='50' rows='10' placeholder='Job Description'> $isi[job_description]</textarea></p>
	                
	                <p>
	                    Produk: <select name='id_produk'>
	            ";
	                        $produk = mysql_query("SELECT * FROM produk");
	                        while($opsi=mysql_fetch_array($produk)){
	                            echo "<option value='$opsi[id_produk]'>$opsi[judul]</option>";
	                        }
	        echo "
	                    </select>
	                </p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editsalarypayment') {
			$edit = mysql_query("UPDATE job
						SET job_name = '$_POST[job_name]',
						job_cost = '$_POST[job_cost]',
						job_quantity = '$_POST[job_quantity]',
						job_description = '$_POST[job_description]',
						id_produk = '$_POST[id_produk]'
                        WHERE id_job = '$_POST[id]'");
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapussalarypayment') {
			$hapus = mysql_query("DELETE FROM job
                        WHERE id_job = '$_GET[id]'");
                            
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?>

<!-- parameter untuk tambah -->
	<a href="?act=tambahsalarypayment">
		<button type="button" class="btn hijau">Add</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Produk</th>
				<th>Job</th>
				<th>Salary per 1qty/hour</th>
				<th>Qty/Hours</th>
				<th>Job Description</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				$query = mysql_query("SELECT job.id_job, job.job_name, job.job_cost, job.job_quantity, job.job_description, produk.judul 
									FROM job JOIN produk 
									ON job.id_produk = produk.id_produk");
				if (mysql_num_rows($query) > 0) {
					while ($data = mysql_fetch_array($query)) {
					
					echo "
						<tr>
							<td>$data[id_job]</td>
							<td>$data[judul]</td>
							<td>$data[job_name]</td>
							<td>$data[job_cost]</td>
							<td>$data[job_quantity]</td>
							<td>$data[job_description]</td>
							<td>
								<a href='?act=editsalarypayment&id=$data[id_job]'>
                                    <button type='button' class='btn kuning'>Edit</button>
                                </a>
                                <a href='?act=hapussalarypayment&id=$data[id_job]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
                                    <button type='button' class='btn merah'>Hapus</button>
                                </a>

							</td>
						</tr>
					";
					}
				} else {
					echo "
	                    <tr>
	                        <td colspan='7'>Tidak ada data.</td>
	                    </tr>
                	";

				}
			?>
			
		</tbody>
	</table>
	<br>
	
	<a href='print.php?table=job'><button type='button'>Print</button></a>

	<hr>
</section>

<section class="main">
	<h2> Management of Employee</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahemployee') {
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='tambah' action='?act=proses_tambahemployee' method='post'>
	                <p><input type='text' name='employee_name' placeholder='Nama'></p>
	                <p><input type='text' name='employee_education' placeholder='Education'></p>
	                <p><input type='text' name='employee_skill' placeholder='Skill'></p>
	                <p><input type='text' name='employee_address' placeholder='Address'></p>
	                <p><input type='text' name='employee_phone' placeholder='Phone'></p>
	                <p><input type='text' name='employee_email' placeholder='Email'></p>
	                <p><input type='file' name='employee_picture'></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahemployee') {
			$tambah = mysql_query("INSERT INTO employee (employee_name, employee_education, employee_skill, employee_address, employee_phone, employee_email, employee_picture)
                            VALUES ('$_POST[employee_name]',
                            '$_POST[employee_education]',
                            '$_POST[employee_skill]',
                            '$_POST[employee_address]',
                            '$_POST[employee_phone]',
                            '$_POST[employee_email]',
                            '$_POST[employee_picture]'
                            )") or die(mysql_error());
                            
		    if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
		    
		    echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='editemployee') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM employee WHERE id_employee = '$_GET[id]'"));
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='edit' action='?act=proses_editemployee' method='post'>
	                <input type='text' name='id' value='$isi[id_employee]' style='visibility:hidden;'>
	                <p><input type='text' name='employee_name' value='$isi[employee_name]' placeholder='Nama'></p>
	                <p><input type='text' name='employee_education' value='$isi[employee_education]' placeholder='Education'></p>
	                <p><input type='text' name='employee_skill' value='$isi[employee_skill]' placeholder='Skill'></p>
	                <p><input type='text' name='employee_address' value='$isi[employee_address]' placeholder='Address'></p>
	                <p><input type='text' name='employee_phone' value='$isi[employee_phone]' placeholder='Phone'></p>
	                <p><input type='text' name='employee_email' value='$isi[employee_email]' placeholder='Email'></p>
	                <p>
		                <img src='uploads/employee/$isi[employee_picture]' alt='$isi[employee_name]'><br>
		                <input type='file' name='employee_picture'>
	                </p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editemployee') {

			$edit = mysql_query("UPDATE employee 
						SET employee_name = '$_POST[employee_name]',
						employee_education = '$_POST[employee_education]',
						employee_skill = '$_POST[employee_skill]',
						employee_address = '$_POST[employee_address]',
						employee_phone = '$_POST[employee_phone]',
						employee_email = '$_POST[employee_email]',
						employee_picture = '$_POST[employee_picture]'
                        WHERE id_employee = '$_POST[id]'") or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='hapusemployee') {
			$hapus = mysql_query("DELETE FROM employee
                        WHERE id_employee = '$_GET[id]'");
                            
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?>

<!-- parameter untuk tambah -->
	<a href="?act=tambahemployee">
		<button type="button" class="btn hijau">Add</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Education</th>
				<th>Skill</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
				<th>Picture</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				$query = mysql_query("SELECT * FROM employee");
				
				if(mysql_num_rows($query) > 0) {
					while ($data = mysql_fetch_array($query)) {
					 echo "
						<tr>
							<td>$data[id_employee]</td>
							<td>$data[employee_name]</td>
							<td>$data[employee_education]</td>
							<td>$data[employee_skill]</td>
							<td>$data[employee_address]</td>
							<td>$data[employee_phone]</td>
							<td>$data[employee_email]</td>
							<td>$data[employee_picture]</td>
							<td>
								<a href='?act=editemployee&id=$data[id_employee]'>
			                        <button type='button' class='btn kuning'>Edit</button>
			                    </a>
			                    <a href='?act=hapusemployee&id=$data[id_employee]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                        <button type='button' class='btn merah'>Hapus</button>
			                    </a>

							</td>
						</tr>
					";
					}
				} else {
					echo "
	                    <tr>
	                        <td colspan='7'>Tidak ada data.</td>
	                    </tr>
                	";
				}
			?>
			
		</tbody>
	</table>
	<br>
	
	<a href='print.php?table=employee'><button type='button'>Print</button></a>

	<hr>
</section>


<section class="main">
	<h2> Management of Workplan</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahworkplan') {
			if ($data ['id_workplan']==1) {
				$workplanstatus = "<span style='color:green'>Selesai</span>";
			} elseif ($data ['id_workplan']==2) {
				$workplanstatus = "<span style='color:orange'>Proses</span>";
			} else {
				$workplanstatus = "<span style='color:red'>Menunggu</span>";
			}

			echo "
            <h3>Tambah Data</h3>
            
            <form name='tambah' action='?act=proses_tambahworkplan' method='post' enctype='multipart/form-data'>
                <p>
                    Employee 1: <select name='id_employee'>
            ";
                        $namaquery = mysql_query("SELECT * FROM employee");
                        while($opsi=mysql_fetch_array($namaquery)){

                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Employee 2: <select name='id_employee'>
            ";
                        $namaquery = mysql_query("SELECT * FROM employee");
                        while($opsi=mysql_fetch_array($namaquery)){

                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Employee 3: <select name='id_employee'>
            ";
                        $namaquery = mysql_query("SELECT * FROM employee");
                        while($opsi=mysql_fetch_array($namaquery)){

                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Employee 4: <select name='id_employee'>
            ";
                        $namaquery = mysql_query("SELECT * FROM employee");
                        while($opsi=mysql_fetch_array($namaquery)){

                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Employee 5: <select name='id_employee'>
            ";
                        $namaquery = mysql_query("SELECT * FROM employee");
                        while($opsi=mysql_fetch_array($namaquery)){

                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Job: <select name='id_job'>
            ";
                        $job = mysql_query("SELECT * FROM job");
                        while($opsi=mysql_fetch_array($job)){

                            echo "<option value='$opsi[id_job]'>$opsi[job_name]</option>";
                        }
        echo "
                    </select>
                </p>
                <p>
                    Pesanan: <select name='id_pesanan'>
            ";
                        $pesanan = mysql_query("SELECT * FROM pesanan");
                        	while($opsi=mysql_fetch_array($pesanan)){

                        	$querymember = mysql_query("SELECT * FROM member WHERE id_member =  $opsi[id_member]");
	                        	while($member=mysql_fetch_array($querymember)){
									$nama_depan = $member[nama_depan];
	                        	}
	                            echo "<option value='$opsi[id_member]'>$nama_depan</option>";
                        }
        echo "
                    </select>
                </p>
                <p><textarea name='employee_note' cols='50' rows='10' placeholder='Employee Note'></textarea></p>
                <p> Workplan Status :
                	<a href='?act=selesai&id=$data[id_workplan]'>
                        <button type='button' class='btn hijau'>Finished</button>
                    </a>
                    <a href='?act=proses&id=$data[id_workplan]'>
                        <button type='button' class='btn kuning'>On Progress</button>
                    </a>
                    <a href='?act=menunggu&id=$data[id_workplan]'>
                        <button type='button' class='btn merah'>Pending</button>
                    </a>
                </p>
                <p>
                	Finished Date: <input type='text' name='finished_date' class='tcal' />
                </p>
                <p> Payment Status : <select name='id_status_pembayaran'>
        ";
	        			$status_pembayaran = mysql_query("SELECT * FROM status_pembayaran");
					        while ($opsi=mysql_fetch_array($status_pembayaran)) {
					            echo "<option value='$opsi[id_status_pembayaran]'>$opsi[status_pembayaran]</option>";
					    }
        echo "
               		</select>  
                </p>

                <p>
                	Payment Due: <input type='text' name='payment_due' class='tcal' />
                </p>
                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
            </form>
            
            <hr>
        ";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahworkplan') {
			$tambah = mysql_query("INSERT INTO workplan (id_employee, id_job, employee_note, finished_date, id_status_pembayaran, payment_due) 
								VALUES ('$_POST[id_employee]', '$_POST[id_job]', '$_POST[employee_note]', '$_POST[finished_date]', '$_POST[id_status_pembayaran]', '$_POST[payment_due]')");
	    	
	    	// test if variable $tambah is(not) work 
	    	if ($tambah) {
	    		echo "Data berhasil ditambahkan";
	    	} else {
	    		echo "Data gagal ditambahkan";
	    	}

	    	echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='editworkplan') {
			$isi =mysql_fetch_array(mysql_query("SELECT * FROM workplan WHERE id_workplan = '$_GET[id]'"));

			//untuk menampilkan form edit
			    echo "
			    		<h3>Tambah Data</h3>
            
			            <form name='tambah' action='?act=proses_tambahworkplan' method='post' enctype='multipart/form-data'>
			                <p>
			                    Employee 1: <select name='id_employee'>
			            ";
			                        $namaquery = mysql_query("SELECT * FROM employee");
			                        while($opsi=mysql_fetch_array($namaquery)){

			                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Employee 2: <select name='id_employee'>
			            ";
			                        $namaquery = mysql_query("SELECT * FROM employee");
			                        while($opsi=mysql_fetch_array($namaquery)){

			                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Employee 3: <select name='id_employee'>
			            ";
			                        $namaquery = mysql_query("SELECT * FROM employee");
			                        while($opsi=mysql_fetch_array($namaquery)){

			                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Employee 4: <select name='id_employee'>
			            ";
			                        $namaquery = mysql_query("SELECT * FROM employee");
			                        while($opsi=mysql_fetch_array($namaquery)){

			                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Employee 5: <select name='id_employee'>
			            ";
			                        $namaquery = mysql_query("SELECT * FROM employee");
			                        while($opsi=mysql_fetch_array($namaquery)){

			                            echo "<option value='$opsi[employee_name]'>$opsi[employee_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Job: <select name='id_job'>
			            ";
			                        $job = mysql_query("SELECT * FROM job");
			                        while($opsi=mysql_fetch_array($job)){

			                            echo "<option value='$opsi[id_job]'>$opsi[job_name]</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p>
			                    Pesanan: <select name='id_pesanan'>
			            ";
			                        $pesanan = mysql_query("SELECT * FROM pesanan");
			                        	while($opsi=mysql_fetch_array($pesanan)){

			                        $querymember = mysql_query("SELECT * FROM member WHERE id_member =  $opsi[id_member]");
			                        	while($member=mysql_fetch_array($querymember)){
										$nama_depan = $member[nama_depan];
			                        	}
			                            echo "<option value='$opsi[id_member]'>$nama_depan</option>";
			                        }
			        echo "
			                    </select>
			                </p>
			                <p><textarea name='employee_note' cols='50' rows='10' value='$isi[employee_note]' placeholder='Employee Note'></textarea></p>
			                <p> Workplan Status :
			                	<a href='?act=selesai&id=$data[id_workplan]'>
			                        <button type='button' class='btn hijau'>Selesai</button>
			                    </a>
			                    <a href='?act=proses&id=$data[id_workplan]'>
			                        <button type='button' class='btn kuning'>Proses</button>
			                    </a>
			                    <a href='?act=menunggu&id=$data[id_workplan]'>
			                        <button type='button' class='btn merah'>Menunggu</button>
			                    </a>
			                </p>
			                <p>
			                	Finished Date: <input type='text' name='finished_date' value='$isi[finished_date]' class='tcal' />
			                </p>
			                <p> Payment Status :
			                	<a href='?act=cash&id=$data[id_workplan]'>
			                        <button type='button' class='btn hijau'>Cash</button>
			                    </a>
			                    <a href='?act=downpayment&id=$data[id_workplan]'>
			                        <button type='button' class='btn kuning'>Down Payment</button>
			                    </a>
			                    <a href='?act=credit&id=$data[id_workplan]'>
			                        <button type='button' class='btn merah'>Credit</button>
			                    </a>
			                </p>
			                <p>
			                	Payment Due: <input type='text' name='payment_due' value='$isi[payment_due]' class='tcal' />
			                </p>
			                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
			            </form>
			            
			            <hr>
			    	";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editworkplan') {
			$edit = mysql_query("UPDATE workplan 
								SET id_employee = '$_POST[id_employee]',
								  id_job = '$_POST[id_job]',
								  employee_note ='$_POST[employee_note]',
								  finished_date = '$_POST[finished_date]',
								  id_status_pembayaran = '$_POST[id_status_pembayaran]',
								  payment_due = '$_POST[payment_due]'
								WHERE id_workplan = '$_POST[Workplan]'");	
				// $cek=mysql_query($edit);
				// echo $edit;
				if ($edit) {
					echo "Data berhasil diperbarui";
				} else {
					echo "Data gagal diperbarui";
				}
				echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapusworkplan') {
			$hapus = mysql_query("DELETE FROM workplan
                        WHERE id_workplan = '$_GET[id]'");
                            
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?>
<!-- parameter untuk tambah -->
	<a href="?act=tambahworkplan">
		<button type="button" class="btn hijau">Add</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Employee's Name</th>
				<th>Job</th>
				<th>ID Pesanan</th>
				<th>Note</th>
				<th>Status</th>
				<th>Finished</th>
				<th>Payment Status</th>
				<th>Payment Due</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$query = mysql_query("SELECT * FROM workplan");
				if (mysql_num_rows($query) > 0) {
					if ($data['stok'] == 0) {
						$stok = "Kosong";
					} else {
						$stok = "Ada";
					}
					echo "
						<tr>
							<td>$data[id_workplan]</td>
							<td>$data[employee_name]</td>
							<td>$data[job_name]</td>
							<td>$data[id_pesanan]</td>
							<td>$data[employee_note]</td>
							<td>$data[workplan_status]</td>
							<td>$data[finished_date]</td>
							<td>$data[payment_status]</td>
							<td>$data[payment_due]</td>
							<td>
								<a href='?act=editworkplan&id=$data[id_workplan]'>
						            <button type='button' class='btn kuning'>Edit</button>
						        </a>
						        <a href='?act=hapusworkplan&id=$data[id_workplan]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
						            <button type='button' class='btn merah'>Hapus</button>
						        </a>
							</td>
						</tr>
					";				
				} else {
					echo "
	                    <tr>
	                        <td colspan='7'>Tidak ada data.</td>
	                    </tr>
                	";
				}
			?>
			
		</tbody>
	</table>
	<br>
	
	<a href='print.php?table=workplan'><button type='button'>Print</button></a>

	<hr>
</section>


<?php include('inc/footerbackend.php');?>