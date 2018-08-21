<?php $page = "PESANAN"; ?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<!-- Manajemen Status Pesanan -->
<section class="main">
	<h1>Manajemen Pesanan</h1>
	<hr>

	<h2> Status Pesanan</h2>
	<br>

	<?php 
		if (isset($_GET['act']) AND $_GET['act']=='tambahstatuspesanan') {
			echo "
				<h3>Tambah Data</h3>
            
	            <form name='tambah' action='?act=proses_tambahstatuspesanan' method='post'>
	                <p><input type='text' name='status_pesanan' placeholder='Status Pesanan'></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahstatuspesanan') {
			$tambah = mysql_query("INSERT INTO status_pesanan (status_pesanan)
                            VALUES ('$_POST[status_pesanan]')");
			if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
    
   			 echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='editstatuspesanan') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM status_pesanan WHERE id_status_pesanan = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
        
		        <form name='edit' action='?act=proses_editstatuspesanan' method='post'>
		            <input type='hidden' name='id' value='$isi[id_status_pesanan]'>
		            <p><input type='text' name='status_pesanan' value='$isi[status_pesanan]' placeholder='Status Pesanan'></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editstatuspesanan') {
			$edit = mysql_query("UPDATE status_pesanan 
							SET status_pesanan = '$_POST[status_pesanan]' 
							WHERE id_status_pesanan = '$_POST[id]'");
			if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		} elseif(isset($_GET['act']) AND $_GET['act']=='hapusstatuspesanan') {
		    $hapus = mysql_query("DELETE FROM status_pesanan
		                        WHERE id_status_pesanan = '$_GET[id]'");
		                            
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";
		}

	?>
	<a href="?act=tambahstatuspesanan">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$query = mysql_query("SELECT * FROM status_pesanan"); 
			if (mysql_num_rows($query) > 0) {
				// ada record
				while ($data = mysql_fetch_array($query)) {
					echo "
						<tr>
							<td>$data[id_status_pesanan]</td>
							<td>$data[status_pesanan]</td>
							<td>
								<a href='?act=editstatuspesanan&id=$data[id_status_pesanan]'>
		                            <button type='button' class='btn kuning'>Edit</button>
		                        </a>
		                        <a href='?act=hapusstatuspesanan&id=$data[id_status_pesanan]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
		                            <button type='button' class='btn merah'>Hapus</button>
		                        </a>
							</td>
						</tr>
					";
				}
			} else {
				// tidak ada record
				echo "
			            <tr>
			                <td colspan='3'>Tidak ada data.</td>
			            </tr>
			        ";
			}
			?>	
		</tbody>
	</table>
</section>


<!-- Manajemen Status Pembayaran -->
<section class="main">
	<h2>Status Pembayaran</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahstatuspembayaran') {
			echo "
				<h3>Tambah Data</h3>
            
	            <form name='tambah' action='?act=proses_tambahstatuspembayaran' method='post'>
	                <p><input type='text' name='status_pembayaran' placeholder='Status Pembayaran'></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahstatuspembayaran') {
			$tambah = mysql_query("INSERT INTO status_pembayaran (status_pembayaran)
                            VALUES ('$_POST[status_pembayaran]')");
			if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
    
   			echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='editstatuspembayaran') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM status_pembayaran WHERE id_status_pembayaran = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
        
		        <form name='edit' action='?act=proses_editstatuspembayaran' method='post'>
		            <input type='hidden' name='id' value='$isi[id_status_pembayaran]'>
		            <p><input type='text' name='status_pembayaran' value='$isi[status_pembayaran]' placeholder='Status Pembayaran'></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editstatuspembayaran') {
			$edit = mysql_query("UPDATE status_pembayaran 
							SET status_pembayaran = '$_POST[status_pembayaran]' 
							WHERE id_status_pembayaran = '$_POST[id]'");
			if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		} elseif(isset($_GET['act']) AND $_GET['act']=='hapusstatuspembayaran') {
		    $hapus = mysql_query("DELETE FROM status_pembayaran
		                        WHERE id_status_pembayaran = '$_GET[id]'");
		                            
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";
		}
	?>
	<a href="?act=tambahstatuspembayaran">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$query = mysql_query("SELECT * FROM status_pembayaran");
				if (mysql_num_rows($query) > 0) {
				 	while ($data = mysql_fetch_array($query)) {
				 		echo "
				 			<tr>
								<td>$data[id_status_pembayaran]</td>
								<td>$data[status_pembayaran]</td>
								<td>
									<a href='?act=editstatuspembayaran&id=$data[id_status_pembayaran]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapusstatuspembayaran&id=$data[id_status_pembayaran]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
								</td>
							</tr>
				 		";
				 	}
				 } else {
			        // tidak ada record
			        echo "
			            <tr>
			                <td colspan='3'>Tidak ada data.</td>
			            </tr>
			        ";
			    }
			?>
			
		</tbody>
	</table>
</section>

<section class="main">
	<h2>Informasi Pesanan</h2>
	<hr>

	<?php 
		if (isset($_GET['act']) AND $_GET['act']=='editinfopesanan') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM pesanan WHERE id_pesanan = id_pesanan"));
			// klo textarea tidak pakai value utk retrieve previous data
			// <input type='text' name='id' value='$isi[id_job]' style='visibility:hidden;'> --> input dummy untuk buat nangkap $_post[id]
			echo "
				<h3>Edit Status</h3>
	            <form name='edit' action='?act=proses_editinfopesanan' method='post'>
	               <input type='text' name='id' value='$isi[id_pesanan]' style='visibility:hidden;'>
	                <p>
	                    Status Pesanan: <select name='id_status_pesanan'>
	            ";
	                        $statuspesanan = mysql_query("SELECT * FROM status_pesanan");
	                        while($opsi=mysql_fetch_array($statuspesanan)){
	                            echo "<option value='$opsi[status_pesanan]'>$opsi[status_pesanan]</option>";
	                        }
	        echo "
	                    </select>
	                </p>
	                <p>
	                    Status Pembayaran: <select name='id_status_pembayaran'>
	            ";
	                        $statuspembayaran = mysql_query("SELECT * FROM status_pembayaran");
	                        while($opsi=mysql_fetch_array($statuspembayaran)){
	                            echo "<option value='$opsi[status_pembayaran]'>$opsi[status_pembayaran]</option>";
	                        }
	        echo "
	                    </select>
	                </p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editinfopesanan') {
			$edit = mysql_query("UPDATE pesanan
						SET id_status_pesanan = '$_POST[id_status_pesanan]',
						id_status_pembayaran = '$_POST[id_status_pembayaran]'
                        WHERE id_pesanan = '$_POST[id]'") or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		}
	
		// php untuk mengubah status pesanan
		elseif (isset($_GET['act']) AND $_GET['act'] =='finalized') {
			$status = mysql_query
					("UPDATE pesanan 
						SET workplan_status = 1 
						WHERE id_pesanan ='$_GET[id]'") or die(mysql_error());
			if ($status) {
				echo "Data berhasil disimpan!";
	        } else {
	            echo "Data gagal disimpan!";
	        }
	} elseif (isset($_GET['act']) AND $_GET['act']=='pending') {
			$status = mysql_query
					("UPDATE pesanan 
						SET workplan_status = 2 
						WHERE id_pesanan = '$_GET[id]'");
			if ($status) {
				echo "Data berhasil disimpan!";
	        } else {
	            echo "Data gagal disimpan!";
	        }
	} elseif (isset($_GET['act']) AND $_GET['act']=='aborted') {
			$status = mysql_query
					("UPDATE pesanan 
						SET workplan_status = 3 
						WHERE id_pesanan = '$_GET[id]'");
			if ($status) {
				echo "Data berhasil disimpan!";
	        } else {
	            echo "Data gagal disimpan!";
	        }
		
		echo "<hr>";
	}
	?>

	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Pemesan</th>
				<th>Alamat</th>
				<th>Tanggal</th>
				<th>Harga</th>
				<th>Status</th>
				<th>Aksi</th>
				<th>Status pesanan</th>
				<th>Status pembayaran</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php
			 	// retrieve all data from table of pesanan 
				$query = mysql_query("SELECT * FROM pesanan ORDER BY id_pesanan DESC");

				if(mysql_num_rows($query) > 0) {
					while ($data = mysql_fetch_array($query)) {
						$member = mysql_fetch_array(mysql_query ("SELECT nama_depan, nama_belakang, alamat 
															FROM member 
															WHERE id_member = '$data[id_member]' ")
														);
						// buat keadan untuk status pesanan
						if ($data ['workplan_status']==1) {
							$status = "<span style='color:green'>Finalized</span>";
						} elseif ($data ['workplan_status']==2) {
							$status = "<span style='color:orange'>Pending</span>";
						} else {
							$status = "<span style='color:red'>Aborted</span>";
						}
					echo "
					<tr>
						<td>$data[id_pesanan]</td>
		                <td>$member[nama_depan] $member[nama_belakang]</td>
		                <td>$member[alamat]</td>
		                <td>$data[tanggal]</td>
		                <td>$data[harga]</td>
		                <td>$status</td>
		                <td>
		                	<a href='?act=finalized&id=$data[id_pesanan]'>
                              	<button type='button' class='btn hijau'>F</button>
                            </a>
                            <a href='?act=pending&id=$data[id_pesanan]'>
                                <button type='button' class='btn kuning'>P</button>
                            </a>
                            <a href='?act=aborted&id=$data[id_pesanan]'>
                                <button type='button' class='btn merah'>P</button>
                            </a>
		                </td>
		                <td>$data[id_status_pesanan]</td>
		                <td>$data[id_status_pembayaran]</td>
						<td> 
							<a href='?act=editinfopesanan&id=$data[id_member]'>
			                    <button type='button' class='btn kuning'>Edit</button>
			                </a>
			                <a href='?act=hapusinfopesanan&id=$data[id_member]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
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
	
	<a href='print.php?table=info_pesan'><button type='button'>Print</button></a>

	<hr>
</section>

<?php include('inc/footerbackend.php');?>