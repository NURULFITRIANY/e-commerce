<?php $page = "BLOG"; ?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Manajemen Blog</h1>
	<hr>

	<?php 
	// php untuk menampilkan form tambah untuk blog dan proses tambah pada halaman blog (front-end)
	// proses menambah record blog part 1
	// untuk upload "file" berupa gambar, pdf, docs etc (enctype='multipart/form-data')
		if (isset($_GET['act']) AND $_GET['act']=='tambah') {
			echo "
				<h3>Tambah Data</h3>

				<form name='tambah' action='?act=proses_tambah' method='post' enctype='multipart/form-data'>
					<p><input type='text' name='judul' placeholder='Judul'></p>
			        <p><input type='text' name='deskripsi' placeholder='Deskripsi'></p>
			        <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'></textarea></p>
			        <p><input type='file' name='gambar'></p>
			        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
				</form>

				<hr>
			";
		} 
		// proses menambah record blog part 2
		elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambah') {
			// tidak ad file yg diupload
			if ($_FILES['gambar']['error'] !=0) {
				$tambah = mysql_query
							("INSERT INTO blog (judul, deskripsi, isi, tanggal)
							VALUES ('$_POST[judul]',
								'$_POST[deskripsi]', 
								'$_POST[isi]', 
								NOW())");
			} else {
				$tmp_file = $_FILES['gambar']['tmp_name'];
		        $filename = $_FILES['gambar']['name'];
		        $filetype = $_FILES['gambar']['type'];
		        $filesize = $_FILES['gambar']['size'];
		        
		        $destination = 'uploads/blog/' . $filename;

		        if (move_uploaded_file($tmp_file, $destination)) {
		        	$gambar = $filename;
		        }

		        $tambah = mysql_query
		        			("INSERT INTO blog (judul, deskripsi, isi, tanggal, gambar)
		        			VALUES ('$_POST[judul]',
		        				'$_POST[deskripsi]', 
		        				'$_POST[isi]', 
		        				NOW(), 
		        				'$gambar')");
			}
		    if ($tambah) {
		        echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
		    }   
			echo "<hr>";
		} 
		// proses mengubah record blog part 1
		elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
			$isi = mysql_fetch_array(mysql_query("SELECT * FROM blog WHERE id_blog = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
				<form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
					<input type='hidden' name='id' value='$isi[id_blog]'>
						<p><input type='text' name='judul' value='$isi[judul]' placeholder='Judul'></p>
			            <p><input type='text' name='deskripsi' value='$isi[deskripsi]' placeholder='Deskripsi'></p>
			            <p><textarea name='isi' cols='50' rows='10' placeholder='Isi'>$isi[isi]</textarea></p>
			            <p>
			                <img src='uploads/blog/$isi[gambar]' alt='$isi[judul]'><br>                     
			                <input type='file' name='gambar'>
			            </p>
			            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
				</form>
				<hr>
			";
		}
		// proses mengubah record blog part 2 (proses editing)
		elseif (isset($_GET['act']) AND $_GET['act']=='proses_edit') {
			if ($_FILES['gambar']['error'] !=0) {
				$edit = mysql_query
						("UPDATE blog 
							SET judul =  '$_POST[judul]', 
							deskripsi = '$_POST[deskripsi]', 
							isi = '$_POST[isi]'");
			} else {
				$tmp_file = $_FILES['gambar']['tmp_name'];
		        $filename = $_FILES['gambar']['name'];
		        $filetype = $_FILES['gambar']['type'];
		        $filesize = $_FILES['gambar']['size'];
		        
		        $destination = 'uploads/blog/' . $filename;

		        if (move_uploaded_file($tmp_file, $destination)) {
		        	$gambar = $filename;
		        }

		        $edit = mysql_query
		        		("UPDATE blog 
		        			SET judul = '$_POST[judul]',
		        			deskripsi = '$_POST[deskripsi]', 
		        			isi = '$_POST[isi]', 
		        			gambar = '$gambar'
		        			WHERE id_blog = '$_POST[id]'");
			}
			if ($edit) {
				echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
			}

			echo "<hr>";
			
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapus') {
			$hapus = mysql_query
					("DELETE FROM blog
                        WHERE id_blog = '$_GET[id]'");         
			    if($hapus) {
			        echo "Data berhasil dihapus!";
			    } else {
			        echo "Data gagal dihapus!";
			    }
			    
			    echo "<hr>";
		}
	?>
	
	<a href="?act=tambah">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
    	<thead>
    		<tr>
    			<th>ID</th>
    			<th>Judul</th>
    			<th>Deskripsi</th>
    			<th>Tanggal</th>
    			<th>Aksi</th>
    		</tr>
    	</thead>
    	<?php  
    		$query = mysql_query("SELECT * FROM blog");
    		if (mysql_num_rows($query) > 0) {
    			while ($data = mysql_fetch_array($query)) {
    				echo "
    					<tbody>
				    		<tr>
				    			<td>$data[id_blog]</td>
				                <td>$data[judul]</td>
				                <td>$data[deskripsi]</td>
				                <td>$data[tanggal]</td>
				                <td>
				                	<a href='?act=edit&id=$data[id_blog]'>
				                    	<button type='button' class='btn kuning'>Edit</button>
				                    </a>
				                    <a href='?act=hapus&id=$data[id_blog]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
				                    	<button type='button' class='btn merah'>Hapus</button>
				                	</a>
				                </td>	
				    		</tr>
    				";
    			}
    		} else {
    			echo "
                    <tr>
                        <td colspan='5'>Tidak ada data.</td>
                    </tr>
                ";
    		}
    	?>

    	</tbody>
    </table>
</section>

<?php include('inc/footerbackend.php');?>