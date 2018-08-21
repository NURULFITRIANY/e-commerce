<?php $page = "MANAGEMENT OF MARKETING";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Management of Marketing</h1>
	<hr>
	<h2>Promotion</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahpromotion') {
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='tambah' action='?act=proses_tambahpromotion' method='post'>
	                <p><input type='text' name='jenis_promosi' placeholder='Jenis Promosi'></p>
	                <p><textarea name='deskripsi_promosi' cols='50' rows='10' placeholder='Deskripsi'></textarea></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahpromotion') {
			$tambah = mysql_query("INSERT INTO promosi (jenis_promosi, deskripsi_promosi)
                            VALUES ('$_POST[jenis_promosi]',
                            		'$_POST[deskripsi_promosi]'
                            	)") or die(mysql_error());
                            
		    if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='editpromotion') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM promosi 
										WHERE id_promosi = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
	        
		        <form name='edit' action='?act=proses_editpromotion' method='post' >
		            <input type='hidden' name='id' value='$isi[id_promosi]'>
		            <p><input type='text' name='jenis_promosi' value='$isi[jenis_promosi]' placeholder='Jenis Promosi'></p>
	                <p><textarea name='deskripsi_promosi' cols='50' rows='10' placeholder='Deskripsi'>$isi[deskripsi_promosi]</textarea></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editpromotion') {
			$edit = mysql_query("UPDATE promosi 
						SET jenis_promosi = '$_POST[jenis_promosi]',
							deskripsi_promosi = '$_POST[deskripsi_promosi]'
                        WHERE id_promosi = '$_POST[id]'") or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='hapuspromotion') {
			$hapus = mysql_query("DELETE FROM promosi
                        WHERE id_promosi = '$_GET[id]'");                 
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?> 
	<!-- parameter untuk tambah -->
	<a href="?act=tambahpromotion">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Judul</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$query = mysql_query("SELECT * FROM promosi");
				if (mysql_num_rows($query)>0) {
					// ada record
					while ($data = mysql_fetch_array($query)) {
						echo "
							<tr>
								<td>$data[id_promosi]</td>
								<td>$data[jenis_promosi]</td>
								<td>$data[deskripsi_promosi]</td>
								<td>
									<a href='?act=editpromotion&id=$data[id_promosi]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapuspromotion&id=$data[id_promosi]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
								</td>
							</tr>
						";
					}
				} else {
					//tidak ada record
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

<!-- member kategori -->
<section class="main">

	<h2>Member Kategori</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahmemberkategori') {
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='tambah' action='?act=proses_tambahmemberkategori' method='post'> 
	                <p><input type='text' name='kategori_member' placeholder='Kategori Member'></p>
	                <p><textarea name='deskripsi_kategori_member' cols='50' rows='10' placeholder='Deskripsi Kategori'></textarea></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahmemberkategori') {
			$tambah = mysql_query("INSERT INTO kategori_member (kategori_member, deskripsi_kategori_member)
                            VALUES ('$_POST[kategori_member]',
                            		'$_POST[deskripsi_kategori_member]'
                            	)") or die(mysql_error());
                            
		    if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='editmemberkategori') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM kategori_member
										WHERE id_kategori_member = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
	        
		        <form name='edit' action='?act=proses_editmemberkategori' method='post'>
		            <input type='hidden' name='id' value='$isi[id_kategori_member]'>
		            <p><input type='text' name='kategori_member' value='$isi[kategori_member]' placeholder='Kategori Member'></p>
	                <p><textarea name='deskripsi_kategori_member' cols='50' rows='10' placeholder='Nama Kategori'> $isi[deskripsi_kategori_member]</textarea></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editmemberkategori') {
			$edit = mysql_query("UPDATE kategori_member 
						SET kategori_member = '$_POST[kategori_member]',
							deskripsi_kategori_member = '$_POST[deskripsi_kategori_member]'
                        WHERE id_kategori_member = '$_POST[id]'") or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapusmemberkategori') {
			$hapus = mysql_query("DELETE FROM kategori_member
                        WHERE id_kategori_member = '$_GET[id]'");                 
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?> 

	<!-- parameter untuk tambah -->
	<a href="?act=tambahmemberkategori">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategori Member</th>
				<th>Deskripsi Kategori Member</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
				<?php  
				$query = mysql_query("SELECT * FROM kategori_member");
				if (mysql_num_rows($query)>0) {
					while ($data = mysql_fetch_array($query)) {
						echo "
							<tr>	
								<td>$data[id_kategori_member]</td>
								<td>$data[kategori_member]</td>
								<td>$data[deskripsi_kategori_member]</td>
								<td>
									<a href='?act=editmemberkategori&id=$data[id_kategori_member]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapusmemberkategori&id=$data[id_kategori_member]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
								</td>
							</tr>
						";
					}
				} else {
					//tidak ada record
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

<!-- facilities of member -->
<section class="main">
	<h2>Facilities of Member</h2>
	<br>

	<?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambahfasilitasmember') {
			echo "
				<h3>Tambah Data</h3>
	            
	            <form name='tambah' action='?act=proses_tambahfasilitasmember' method='post'>
	                <p><input type='text' name='fasilitas_kategori_member' placeholder='Kategori'></p>
	                <p><textarea name='deskripsi_fasilitas' cols='50' rows='10' placeholder='Deskripsi Kategori'></textarea></p>
	                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	            </form>
	            
	            <hr>
			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahfasilitasmember') {
			$tambah = mysql_query("INSERT INTO fasilitas_kategori_member (fasilitas_kategori_member, deskripsi_fasilitas)
                            VALUES ('$_POST[fasilitas_kategori_member]', '$_POST[deskripsi_fasilitas]')")or die(mysql_error());
                            
		    if($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }
		    
		    echo "<hr>";

		} elseif (isset($_GET['act']) AND $_GET['act']=='editfasilitasmember') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM fasilitas_kategori_member  
										WHERE id_fasilitas_kategori_member = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
	        
		        <form name='edit' action='?act=proses_editfasilitasmember' method='post'>
		            <input type='hidden' name='id' value='$isi[id_fasilitas_kategori_member]'>
		            <p><input type='text' name='fasilitas_kategori_member' value='$isi[fasilitas_kategori_member]' placeholder='Nama Kategori'></p>
		            <p><textarea name='deskripsi_fasilitas' cols='50' rows='10' placeholder='Deskripsi Kategori'>$isi[deskripsi_fasilitas]</textarea></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>

			";
		} elseif (isset($_GET['act']) AND $_GET['act']=='proses_editfasilitasmember') {
			$edit = mysql_query("UPDATE fasilitas_kategori_member 
						SET fasilitas_kategori_member = '$_POST[fasilitas_kategori_member]',
							deskripsi_fasilitas = '$_POST[deskripsi_fasilitas]'
                        WHERE id_fasilitas_kategori_member = '$_POST[id]'")or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapusfasilitasmember') {
			$hapus = mysql_query("DELETE FROM fasilitas_kategori_member 
                        WHERE id_fasilitas_kategori_member = '$_GET[id]'") or die(mysql_error());                 
		    if($hapus) {
		        echo "Data berhasil dihapus!";
		    } else {
		        echo "Data gagal dihapus!";
		    }
		    
		    echo "<hr>";

		}
	?> 

	<!-- parameter untuk tambah -->
	<a href="?act=tambahfasilitasmember">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategori</th>
				<th>Deskripsi</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$query = mysql_query("SELECT * FROM fasilitas_kategori_member");
				if (mysql_num_rows($query)>0) {
					while ($data = mysql_fetch_array($query)) {
						echo "
							<tr>
								<td>$data[id_fasilitas_kategori_member]</td>
								<td>$data[fasilitas_kategori_member]</td>
								<td>$data[deskripsi_fasilitas]</td>
								<td>
									<a href='?act=editfasilitasmember&id=$data[id_fasilitas_kategori_member]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapusfasilitasmember&id=$data[id_fasilitas_kategori_member]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
								</td>
							</tr>
						";
					}
				} else {
					//tidak ada record
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

<?php include('inc/footerbackend.php');?>