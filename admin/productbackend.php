<?php $page = "PRODUCT";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>


<!-- Manajemen Kategori Produk -->
<section class="main">
    <h1>Manajemen Kategori Produk</h1>
    <hr>
    
    <?php 
    	// variabel $_GET[‘act’] telah di-set dan memiliki value tambah
    	// product_category.php?act=tambah menjadi product_category.php?act=proses_tambah
    	//menangkap parameter $_GET['act']
    	if (isset($_GET['act']) AND $_GET['act'] =='tambahkategoriproduk') {
    		echo "
    			<h3>Tambah Data</h3>
    			<form name='tambah' action='?act=proses_tambahkategoriproduk' method='post'>
    				<p><input type='text' name='kategori' placeholder='kategori'></p>
    				<p><input type='submit' name='proses' value='simpan' class='btn biru'></p>
    			</form>

    			<hr>
    		";
	    	} 
	    	// test jika variabel $_GET[‘act’] memiliki value proses_tambah - insert data to database with 'INSERT INTO' query
	    	elseif (isset($_GET['act']) AND $_GET['act'] =='proses_tambahkategoriproduk') {
	    		$tambah = mysql_query("INSERT INTO kategori (kategori) VALUES ('$_POST[kategori]')");
	    	
	    	// test if variable $tambah is(not) work 
	    	if ($tambah) {
	    		echo "Data berhasil ditambahkan";
	    	} else {
	    		echo "Data gagal ditambahkan";
	    	}

	    	echo "<hr>";
    		} 
    		//proses edit part 1
    		elseif(isset($_GET['act']) AND $_GET['act']=='editkategoriproduk') {
			    	$isi =mysql_fetch_array(mysql_query("SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'"));
			    	//untuk menampilkan form edit
			    	echo "
			    		<h3>Edit Data</h3>
			    		<form name='edit' action='?act=proses_editkategoriproduk' method='post'>
			    			<input type='hidden' name='id' value='$isi[id_kategori]'>
			    			<p><input type='text' name='kategori' value='$isi[kategori]' placeholder='kategori'></p>
			    			<p><input type='submit' name='proses' value='simpan' class='btn biru'></p>
			    		</form>
			    		<hr>
			    	";
			}
			//proses edit 2
			//string harus ada single quote !!!!!!
			elseif (isset($_GET['act']) AND $_GET['act']=='proses_editkategoriproduk') {
				$edit = mysql_query("UPDATE kategori SET kategori = '$_POST[kategori]' WHERE id_kategori = '$_POST[id]'");	
				// $cek=mysql_query($edit);
				// echo $edit;
				if ($edit) {
					echo "Data berhasil diperbarui";
				} else {
					echo "Data gagal diperbarui";
				}
				echo "<hr>";
			}
			//proses menghapus record
			elseif (isset($_GET['act']) AND $_GET['act']=='hapuskategoriproduk') {
				$hapus = mysql_query("DELETE FROM kategori WHERE id_kategori = '$_GET[id]'");
				if ($hapus) {
						echo "Data berhasil dihapus!";
					}	else {
						echo "Data gagal dihapus!";
					}
				echo "<hr>";
			}
    ?>
  
    <!-- tambah kategori produk - a href link that will act like a button -->
    <!-- ketika tombol di klik, halaman akan membuka halamannya sendiri dengan tambahan parameter act -->
    <a href="?act=tambahkategoriproduk">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
        <thead>
            <tr>
            	<th>ID</th>
            	<th>Kategori</th>
            	<th>Aksi</th>
        </thead>
        <tbody>
            <?php
            // record dari tabel kategori - menampilkan record yang ada pada tabel kategori. 
            // $query = mysql_query(query);
            $query = mysql_query("SELECT * FROM kategori");
            ?>

            <?php
			    // cek apakah terdapat record pada tabel dengan menggunakan fungsi 
			    $query = mysql_query("SELECT * FROM kategori");
			    if(mysql_num_rows($query) > 0) {
			        // ada record - Fetch a result row as an associative array, a numeric array, or both
			        while ($data = mysql_fetch_array($query)) {
			        	// code or echo the string
			        	echo "
			        		<tr>
			                    <td>$data[id_kategori]</td>
			                    <td>$data[kategori]</td>
			                    <td>
			                        <a href='?act=editkategoriproduk&id=$data[id_kategori]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapuskategoriproduk&id=$data[id_kategori]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
			                    </td>
			                </tr>
			        	";
			        }

			    } 

			?>

        </tbody>
    </table>
    
</section>

<!-- Manajemen [Kategori] Harga -->
<section class="main">
	<h1>Manajemen Harga</h1>
	
	<hr>

<?php  
	if (isset($_GET['act']) AND $_GET['act'] == 'tambahharga') {
		echo "
			<h3>Tambah Data</h3>
			<form name='tambah' action='?act=proses_tambahharga'>
				<p><input type='text' name='kategori_harga' placeholder='post'></p>
				<p><input type='submit' name='proses' value='simpan' class='btn biru'></p>
			</form>
		";
	} elseif (isset($_GET['act']) AND $_GET['act'] == 'proses_tambahharga') {
		$tambah = mysql_query("INSERT INTO kategori_harga (kategori_harga) VALUES ('$_POST[kategori_harga]')")
		or die ("query failed:".mysql_error());

		if ($tambah) {
			echo "Data berhasil ditambahkan";
		} else {
			echo "Data gagal ditambahkan";
		} 
		echo "<hr>";
	} elseif(isset($_GET['act']) AND $_GET['act']=='editharga') {
	    $isi = mysql_fetch_array(mysql_query("SELECT * FROM kategori_harga WHERE id_kategori_harga = '$_GET[id]'"));
	    
	    echo "
	        <h3>Edit Data</h3>
	        
	        <form name='edit' action='?act=proses_editharga' method='post'>
	            <input type='hidden' name='id_kategori_harga' value='$isi[id_kategori_harga]'>
	            <p><input type='text' name='kategori_harga' value='$isi[kategori_harga]' placeholder='Kategori'></p>
	            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	        </form>
	        
	        <hr>
	    ";
	} elseif (isset($_GET['act']) AND $_GET['act'] == 'proses_editharga') {
		$edit = mysql_query("UPDATE kategori_harga 
						SET kategori_harga = '$_POST[kategori_harga]'
						WHERE id_kategori_harga = '$_POST[id_kategori_harga]' ");
		if ($edit) {
			echo "Data berhasil diperbarui!";
		} else {
			echo "Data gagal diperbarui!";
		}
		echo "<hr>";
	} elseif (isset($_GET['act']) AND $_GET['act']=='hapusharga') {
		$hapus = mysql_query("DELETE FROM kategori_harga 
							WHERE id_kategori_harga = '$_GET[id]' ");
		if ($hapus) {
			echo "Data berhasil dihapus";
		} else {
			echo "Data gagal dihapus";
		}
		echo "<hr>";
	}

?>

<!-- parameter untuk tambah -->
	<a href="?act=tambahharga">
		<button type="button" class="btn hijau">Tambah</button>
	</a>


<!-- tabel untuk menampilkan produk -->
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
				// record dari tabel kategori harga
				$query = mysql_query("SELECT * FROM kategori_harga");
			?>

			<?php 
				// record dari tabel kategori harga 
				$query = mysql_query("SELECT * FROM kategori_harga");
				if(mysql_num_rows($query) > 0) {
					// ada record
					while ($data = mysql_fetch_array($query)) {
						echo "
							<tr>
								<th>$data[id_kategori_harga]</th>
								<th>$data[kategori_harga]</th>
								<th>
									<a href='?act=editharga&id=$data[id_kategori_harga]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapusharga&id=$data[id_kategori_harga]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                            <button type='button' class='btn merah'>Hapus</button>
			                        </a>
								</th>
							</tr>
						";
					}
				} else {
					// tidak ad record
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


<!-- Manajemen Produk -->
<section class="main">
	<h1>Manajemen Produk</h1>
	<hr>

	<?php 
	// Menambah record produk part 1
	if (isset($_GET['act']) AND $_GET['act']=='tambahproduk') {
		echo "
			<h3>Tambah Data</h3>
			<form name='tambah' action='?act=proses_tambahproduk' method='post' enctype='multipart/form-data'> 
				<p><input type='text' name='judul' placeholder='Judul'></p>
                <p><input type='text' name='deskripsi' placeholder='Deskripsi'></p>
                <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'></textarea></p>
                <p><input type='text' name='harga' placeholder='Harga'></p>
				<p>
					Kategori:
					<select name='id_kategori'>
		";
				// querying to retrieve data from database
					$kategori =mysql_query("SELECT * FROM kategori");
					while ($opsi=mysql_fetch_array($kategori)) {
						echo "
							<option value='$opsi[id_kategori]'>$opsi[kategori]</option>
						";
					}
		echo "		</select>
				</p>
				<p>
					Kategori Harga:
					<select name='id_kategori_harga'>
		";
				// querying to retrieve data from database
					$kategori =mysql_query("SELECT * FROM kategori_harga");
					while ($opsi=mysql_fetch_array($kategori)) {
						echo "
							<option value='$opsi[id_kategori_harga]'>$opsi[kategori_harga]</option>
						";
					}
		echo "		</select>
				</p>
				<p>Stok: 
					<input type='radio' name='stok' value='1'>Ada 
					<input type='radio' name='stok' value='0'>Kosong
				</p>
				<p><input type='file' name='gambar'></p>
				<p><input type='file' name='gambar1'></p>
                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
			</form>
			<hr>
			
		";
	} 
	// Menambah record produk part 2
	elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambahproduk') {
		// digunakan untuk mengecek apakah terdapat file yang diupload
		// Jika kondisi if bernilai benar, berarti tidak ada gambar yang diupload. 
		// Jika false, maka ada gambar yang diupload. 'gambar' pada kode di atas adalah atribut name pada form dengan input type berupa file.
		if ($_FILES['gambar']['error'] !=0  && $_FILES['gambar1']['error'] !=0) {
			$tambah = 
				mysql_query
				("INSERT INTO produk (judul, deskripsi, isi, harga, id_kategori_harga, stok, tanggal, id_kategori)
				VALUES ('$_POST[judul]', 
					'$_POST[deskripsi]', 
					'$_POST[isi]', 
					'$_POST[harga]',
					'$_POST[id_kategori_harga]', 
					'$_POST[stok]', 
					NOW(), 
					'$_POST[id_kategori]')");
		} elseif ($_FILES['gambar']['error'] !=1 && $_FILES['gambar1']['error'] !=0) {
			$tmp_file = $_FILES['gambar']['tmp_name'];
			$filename = $_FILES['gambar']['name'];
			$filetype = $_FILES['gambar']['type'];
			$filesize = $_FILES['gambar']['size'];
			// file uploads and productbackend.php within admin file
			$destination = 'uploads/product/' . $filename;

			if (move_uploaded_file($tmp_file, $destination)) {
					$gambar = $filename;
			}
			$tambah = mysql_query("INSERT INTO produk (judul, deskripsi, isi, harga, id_kategori_harga, stok, tanggal, gambar, id_kategori)
								VALUES ('$_POST[judul]', '$_POST[deskripsi]', '$_POST[isi]', '$_POST[harga]', '$_POST[id_kategori_harga]', '$_POST[stok]', NOW(), '$gambar', '$_POST[id_kategori]')");
			$cariidproduk = mysql_insert_id();
			$tambahtablegambar = mysql_query("INSERT INTO gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar' ");

		} elseif ($_FILES['gambar']['error'] !=0 && $_FILES['gambar1']['error'] !=1) {
			$tmp_file = $_FILES['gambar1']['tmp_name'];
			$filename = $_FILES['gambar1']['name'];
			$filetype = $_FILES['gambar1']['type'];
			$filesize = $_FILES['gambar1']['size'];
			// file uploads and productbackend.php within admin file
			$destination = 'uploads/product/' . $filename;

			if (move_uploaded_file($tmp_file, $destination)) {
					$gambar = $filename;
			}
			$tambah = mysql_query("INSERT INTO produk (judul, deskripsi, isi, harga, id_kategori_harga, stok, tanggal, gambar, id_kategori)
								VALUES ('$_POST[judul]', '$_POST[deskripsi]', '$_POST[isi]', '$_POST[harga]', '$_POST[id_kategori_harga]', '$_POST[stok]', NOW(), '$gambar', '$_POST[id_kategori]')");
			$cariidproduk = mysql_insert_id();
			$tambahtablegambar = mysql_query("INSERT INTO gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar' ");
		} else {
			$tmp_file = $_FILES['gambar']['tmp_name'];
			$filename = $_FILES['gambar']['name'];
			$filetype = $_FILES['gambar']['type'];
			$filesize = $_FILES['gambar']['size'];

			$tmp_file1 = $_FILES['gambar1']['tmp_name'];
			$filename1 = $_FILES['gambar1']['name'];
			$filetype1 = $_FILES['gambar1']['type'];
			$filesize1 = $_FILES['gambar1']['size'];
			// file uploads and productbackend.php within admin file
			$destination = 'uploads/product/' . $filename;
			$destination1 = 'uploads/product/' . $filename1;

			if (move_uploaded_file($tmp_file, $destination)) {
					$gambar = $filename;
			}
			if (move_uploaded_file($tmp_file1, $destination1)) {
					$gambar1 = $filename1;
			}
			$tambah = mysql_query("INSERT INTO produk (judul, deskripsi, isi, harga, id_kategori_harga, stok, tanggal, gambar, id_kategori)
								VALUES ('$_POST[judul]', '$_POST[deskripsi]', '$_POST[isi]', '$_POST[harga]', '$_POST[id_kategori_harga]', '$_POST[stok]', NOW(), '$gambar;$gambar1', '$_POST[id_kategori]')");
		
		$cariidproduk = mysql_insert_id();
		$tambahtablegambar = mysql_query("INSERT INTO gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar' ");
		$tambahtablegambar1 = mysql_query("INSERT INTO gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar1' ");
		}
		// information if process successed or not successed
			if ($tambah) {
				echo " Data berhasil ditambahkan ";
			} else {
				echo "Data gagal ditambahkan";
			}
			echo "<hr>";
	}
	// proses untuk mengubah record (edit part 1)
	elseif (isset($_GET['act']) AND $_GET['act']=='editproduk') {
		$isi = mysql_fetch_array(mysql_query("SELECT * FROM produk WHERE id_produk = '$_GET[id]'"));
		if ($isi['stok']==1) {
			$ada = 'checked';
			$kosong = '';
		} else {
			$ada = '';
			$kosong = 'checked';
		}
			echo "

			<h3>Edit Data</h3>
			<form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
				<input type='hidden' name='id' value='$isi[id_produk]'>
				<p><input type='text' name='judul' value='$isi[judul]' placeholder='Judul'></p>
	            <p><input type='text' name='deskripsi' value='$isi[deskripsi]' placeholder='Deskripsi'></p>
	            <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'>$isi[isi]</textarea></p>
	            <p>
					kategori: 
					<select name='id_kategori_harga'>
			";
				// querying to retrieve data from database
					$kategori_harga =mysql_query("SELECT * FROM kategori harga");
					while ($opsi=mysql_fetch_array($kategori_harga)) {
						echo "
							<option value='$opsi[id_kategori_harga]'>$opsi[kategori_harga]</option>
						";
						}
			echo "
					</select>
				</p>
	            <p><input type='text' name='harga' value='$isi[harga]' placeholder='Harga'></p>
				<p>
					kategori: 
					<select name='id_kategori'>
			";
				// querying to retrieve data from database
					$kategori =mysql_query("SELECT * FROM kategori");
					while ($opsi=mysql_fetch_array($kategori)) {
						echo "
							<option value='$opsi[id_kategori]'>$opsi[kategori]</option>
						";
						}
			echo "
					</select>
				</p>
				<p>Stok: <input type='radio' name='stok' value='1' $ada>Ada <input type='radio' name='stok' value='0' $kosong>Kosong</p>
				<p>
                	<img src='uploads/product/$isi[gambar]' alt='$isi[judul]'><br>                      
                	<p><input type='file' name='gambar'></p>
					<p><input type='file' name='gambar1'></p>
            	</p>
				<p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
			</form>

			<hr>

			";
	} 
	// proses untuk mengubah record (edit part 2)
	elseif (isset($_GET['act']) AND $_GET['act']=='proses_editproduk') {
		if ($_FILES['gambar']['error'] !=0  && $_FILES['gambar1']['error'] !=0) {
			$edit = 
			mysql_query
				("UPDATE produk 
				SET judul = '$_POST[judul]', 
				deskripsi = '$_POST[deskripsi]', 
				isi = '$_POST[isi]',
				harga = '$_POST[harga]',
				id_kategori_harga = '$_POST[id_kategori_harga]',
				stok = '$_POST[stok]',
				id_kategori = '$_POST[id_kategori]'
				WHERE id_produk = '$_POST[id]'");
		} elseif ($_FILES['gambar']['error'] !=1 && $_FILES['gambar1']['error'] !=0) {
			$tmp_file = $_FILES['gambar']['tmp_name'];
		    $filename = $_FILES['gambar']['name'];
		    $filetype = $_FILES['gambar']['type'];
		    $filesize = $_FILES['gambar']['size'];
		    
		    $destination = 'uploads/product/' . $filename;

		    if (move_uploaded_file($tmp_file, $destination)) {
		     	$gambar = $filename;
		    }

			$edit = mysql_query("UPDATE produk 
		        			SET judul = '$_POST[judul]',
		        			deskripsi = '$_POST[deskripsi]', 
							isi = '$_POST[isi]',
							harga = '$_POST[harga]',
							id_kategori_harga = '$_POST[id_kategori_harga]',
							stok = '$_POST[stok]',
							gambar = '$gambar',
							id_kategori = '$_POST[id]',
							WHERE id_produk = '$_POST[id]'");

			$cariidproduk = mysql_insert_id();
			$updatetablegambar = mysql_query("UPDATE gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar' ");

		} elseif ($_FILES['gambar']['error'] !=0 && $_FILES['gambar1']['error'] !=1) {
			$tmp_file = $_FILES['gambar1']['tmp_name'];
			$filename = $_FILES['gambar1']['name'];
			$filetype = $_FILES['gambar1']['type'];
			$filesize = $_FILES['gambar1']['size'];
			// file uploads and productbackend.php within admin file
			$destination = 'uploads/product/' . $filename;

			if (move_uploaded_file($tmp_file, $destination)) {
					$gambar = $filename;
			}
			$edit = mysql_query("UPDATE produk 
		        			SET judul = '$_POST[judul]',
		        			deskripsi = '$_POST[deskripsi]', 
							isi = '$_POST[isi]',
							harga = '$_POST[harga]',
							id_kategori_harga = '$_POST[id_kategori_harga]',
							stok = '$_POST[stok]',
							gambar = '$gambar',
							id_kategori = '$_POST[id]',
							WHERE id_produk = '$_POST[id]'");

			$cariidproduk = mysql_insert_id();
			$tambahtablegambar = mysql_query("UPDATE gambar (id_produk, link)
												VALUES '$cariidproduk', '$gambar' ");
		} else {
			$tmp_file = $_FILES['gambar']['tmp_name'];
			$filename = $_FILES['gambar']['name'];
			$filetype = $_FILES['gambar']['type'];
			$filesize = $_FILES['gambar']['size'];

			$tmp_file1 = $_FILES['gambar1']['tmp_name'];
			$filename1 = $_FILES['gambar1']['name'];
			$filetype1 = $_FILES['gambar1']['type'];
			$filesize1 = $_FILES['gambar1']['size'];
			// file uploads and productbackend.php within admin file
			$destination = 'uploads/product/' . $filename;
			$destination1 = 'uploads/product/' . $filename1;

			if (move_uploaded_file($tmp_file, $destination)) {
					$gambar = $filename;
			}
			if (move_uploaded_file($tmp_file1, $destination1)) {
					$gambar1 = $filename1;
			}
			$edit = mysql_query("UPDATE produk 
		        			SET judul = '$_POST[judul]',
		        			deskripsi = '$_POST[deskripsi]', 
							isi = '$_POST[isi]',
							harga = '$_POST[harga]',
							id_kategori_harga = '$_POST[id_kategori_harga]',
							stok = '$_POST[stok]',
							gambar = '$gambar',
							id_kategori = '$_POST[id]',
							WHERE id_produk = '$_POST[id]'");
		
			$cariidproduk = mysql_insert_id();
			$tambahtablegambar = mysql_query("UPDATE gambar (id_produk, link)
													VALUES '$cariidproduk', '$gambar' ");
			$tambahtablegambar1 = mysql_query("UPDATE gambar (id_produk, link)
													VALUES '$cariidproduk', '$gambar1' ");
			
	}
			// information if process successed or not successed
			if ($edit) {
				echo "Data berhasil diperbaharui";
			} else {
				echo "Data gagal diperbaharui";
			}
			echo "<hr>";
	} //proses menghapus record
	elseif (isset($_GET['act']) AND $_GET['act'] == 'hapusproduk') {
		$hapus = mysql_query("DELETE FROM produk WHERE id_produk = '$_GET[id]'");
			if ($hapus) {
				echo "Data berhasil dihapus!";
			}	else {
				echo "Data gagal dihapus!";
			}
				echo "<hr>";
	}
	?>

	<!-- parameter untuk tambah -->
	<a href="?act=tambahproduk">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

	<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Judul</th>
				<th>Deskripsi</th>
				<th>Isi</th>
				<th>Harga</th>
				<th>Kategori harga</th>
				<th>Stok</th>
				<th>Kategori</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$query = mysql_query("SELECT produk.*, kategori_harga.kategori_harga, kategori.kategori 
				FROM `produk` 
				INNER JOIN kategori on produk.id_kategori= kategori.id_kategori 
				INNER JOIN kategori_harga on produk.id_kategori_harga = kategori_harga.id_kategori_harga");
			if (mysql_num_rows($query) > 0) {
				while ($data = mysql_fetch_array($query)) {
					if ($data['stok']== 0) {
						$stok = "kosong";
					} else {
						$stok = "ada";
					}
					echo "
						<tr>
							<td>$data[id_produk]</td>
                            <td>$data[judul]</td>
                            <td>$data[deskripsi]</td>
                            <td>$data[isi]</td>
                            <td>$data[harga]</td>
                            <td>$data[kategori_harga]</td>
                            <td>$stok</td>
                            <td>$data[kategori]</td>
                            <td>
                            	<a href='?act=editproduk&id=$data[id_produk]'>
                                    <button type='button' class='btn kuning'>Edit</button>
                                </a>
                                <a href='?act=hapusproduk&id=$data[id_produk]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
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
	
	<a href='print.php?table=product'><button type='button'>Print</button></a>

	<hr>
</section>

<!-- Manajemen Gambar Produk -->
<section class="main">
	<h1>Manajemen Gambar Produk</h1>
	
	<hr>

	
	<?php  
		// enctype='multipart/form-data' ditambahkan jika form ada feature upload gambar
		if (isset($_GET['act']) AND $_GET['act']=='tambahgambarproduk') {
			echo "
				<h3>Tambah Data</h3>
            
	            <form name='tambah' action='?act=proses_tambahgambarproduk' method='post' enctype='multipart/form-data'>
		          	<p>
				       	Produk: <select name='id_produk'>
				";
				        $gambar_specification = mysql_query("SELECT * FROM produk");
				        while ($opsi=mysql_fetch_array($gambar_specification)) {
				            echo "<option value='$opsi[id_produk]'>$opsi[judul]</option>";
				        }
			echo "
						</select>  
				    </p>
				    <p><input type='file' name='link'></p>
				    <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
	          	</form>

	          	<hr>  
            ";
		} elseif(isset($_GET['act']) AND $_GET['act']=='proses_tambahgambarproduk') {
			if ($_FILES['link']['error'] != 0) {

				$tambah = mysql_query("INSERT INTO gambar (id_produk)
										VALUES ('$_POST[id_produk]')
										");
			} else {
				$tmp_file = $_FILES['link']['tmp_name'];
		        $filename = $_FILES['link']['name'];
		        $filetype = $_FILES['link']['type'];
		        $filesize = $_FILES['link']['size'];
		        
		        $destination = 'uploads/product/' . $filename;

		        if (move_uploaded_file($tmp_file, $destination)) {
		        	$gambar = $filename;
		        }

		        $tambah = mysql_query("INSERT INTO gambar (id_produk, link)
										VALUES ('$_POST[id_produk]', '$gambar')
										");
			}
			if ($tambah) {
					echo "Data berhasil ditambahkan!";
	    		} else {
	        		echo "Data gagal ditambahkan!";
				}
			echo "<hr>";
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapusgambarproduk') {
			    $hapus = mysql_query("DELETE FROM gambar
                        WHERE id_gambar = '$_GET[id]'");
                            
			    if($hapus) {
			        echo "Data berhasil dihapus!";
			    } else {
			        echo "Data gagal dihapus!";
			    }
			    
			    echo "<hr>";
		} 
	?>
<!-- parameter untuk tambah -->
	<a href="?act=tambahgambarproduk">
		<button type="button" class="btn hijau">Tambah</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Produk</th>
				<th>Nama Gambar</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				$query = mysql_query("SELECT * FROM gambar");
				if (mysql_num_rows($query) > 0) {
					while ($data = mysql_fetch_array($query)) {
						$id_produk = $data['id_produk'];
						echo "
									<tr>
										<td>$data[id_gambar]</td>
						";
					}

				;
						$carijudulproduk = mysql_query('SELECT * FROM produk WHERE id_produk = "14"')
						or die (mysql_error());
							while ($fetchjudulproduk = mysql_fetch_array($carijudulproduk)) {
						echo "			
									<td>$fetchjudulproduk[judul]</td>
						";
							}
				$query = mysql_query("SELECT * FROM gambar");
				if (mysql_num_rows($query) > 0) {
					while ($data = mysql_fetch_array($query)) {
						echo "
											
									<td>$data[link]</td>
										<td>
											<a href='?act=hapusgambarproduk&id=$data[id_gambar]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
			                                   	<button type='button' class='btn merah'>Hapus</button>
			                               	</a>
										</td>
									</tr>
							";
						}
					}
				} else {
						echo "<tr>
				                <td colspan='3'>Tidak ada data.</td>
				            </tr>
	            		";
					}
			?>
			
		</tbody>
	</table>
</section>

<?php include('inc/footerbackend.php');?>