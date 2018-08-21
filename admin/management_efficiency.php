<?php $page = "MANAGEMENT OF EFFICIENCY";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Management of Efficiency</h1>
	<hr>
	<h2> Partnership</h2>
	<br>

		<?php  
			if (isset($_GET['act']) AND $_GET['act']=='tambah') {
				echo "
					<h3>Tambah Data</h3>
	            
		            <form name='tambah' action='?act=proses_tambah' method='post'>
		                <p><input type='text' name='partnership_name' placeholder='Company Name'></p>
		                <p><input type='text' name='alamat_partnership' placeholder='Alamat'></p>
		                <p><input type='text' name='telepon_partnership' placeholder='Telepon'></p>
		                <p>
		                	Kategori: <select name='id_produk'>
		                ";
		        $produk = mysql_query("SELECT * FROM produk");
		        while ($opsi=mysql_fetch_array($produk)) {
		        	echo "
		        		<option value='$opsi[id_produk]'>$opsi[judul]</option>
		        	";
		        }
		        echo "
		                	</select>
		                </p>
		                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		            </form>
		            
		            <hr>
				";
			} elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambah') {
				$tambah = mysql_query("INSERT INTO partnership (id_produk, partnership_name, alamat_partnership, telepon_partnership, )
                            VALUES ('$_POST[id_produk]', '$_POST[partnership_name]', '$_POST[alamat_partnership]'), '$_POST[telepon_partnership]'") or die(mysql_error());
                            
			    if($tambah) {
			        echo "Data berhasil ditambahkan!";
			    } else {
			        echo "Data gagal ditambahkan!";
			    }
			    
			    echo "<hr>";

			} elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
				$isi = mysql_fetch_array(mysql_query("SELECT * FROM partnership 
										WHERE id_partnership = '$_GET[id]'"));
			echo "
				<h3>Edit Data</h3>
	        
		        <form name='edit' action='?act=proses_edit' method='post' enctype='multipart/form-data'>
		            <input type='hidden' name='id' value='$isi[id_partnership]'>
		            <p><input type='text' name='partnership_name' value='$isi[partnership_name]' placeholder='Company Name'></p>
	               	<p><input type='text' name='alamat_partnership' value='$isi[alamat_partnership]' placeholder='Alamat'></p>
		            <p><input type='text' name='telepon_partnership' value='$isi[telepon_partnership]' placeholder='Telepon'></p>
		            <p>
		                	Kategori: <select name='id_produk'>
		                ";
		        $produk = mysql_query("SELECT * FROM produk");
		        while ($opsi=mysql_fetch_array($produk)) {
		        	echo "
		        		<option value='$opsi[id_produk]'>$opsi[judul]</option>
		        	";
		        }
		        echo "
		                	</select>
		                </p>
		                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		         </form>
		        
		        <hr>

			";
			} elseif (isset($_GET['act']) AND $_GET['act']=='proses_edit') {
				$edit = mysql_query("UPDATE partnership 
						SET partnership_name = '$_POST[partnership_name]',
							alamat_partnership = '$_POST[alamat_partnership]',
							telepon_partnership = '$_POST[telepon_partnership]'
                        WHERE id_partnership = '$_POST[id]'") or die(mysql_error());
                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
			} elseif (isset($_GET['act']) AND $_GET['act']=='hapus') {
				$hapus = mysql_query("DELETE FROM partnership
	                        WHERE id_partnership = '$_GET[id]'")or die(mysql_error());       
			    if($hapus) {
			        echo "Data berhasil dihapus!";
			    } else {
			        echo "Data gagal dihapus!";
			    }
			    
			    echo "<hr>";

			}
		?> 

<!-- parameter untuk tambah -->
	<a href="?act=tambah">
		<button type="button" class="btn hijau">Add</button>
	</a>

<!-- tabel untuk menampilkan produk -->
	<table class="tabel">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Produk</th>
				<th>Perusahaan</th>
				<th>Alamat</th>
				<th>Kontak</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php  
				$query = mysql_query("SELECT partnership.id_partnership, partnership.partnership_name, partnership.alamat_partnership, partnership.telepon_partnership, produk.judul 
									FROM partnership JOIN produk 
									ON partnership.id_produk = produk.id_produk");
				if (mysql_num_rows($query)>0) {
					while ($data = mysql_fetch_array($query)) {
						echo "
							<tr>
								<td>$data[id_partnership]</td>
								<td>$data[judul]</td>
								<td>$data[partnership_name]</td>
								<td>$data[alamat_partnership]</td>
								<td>$data[telepon_partnership]</td>
								<td>
									<a href='?act=edit&id=$data[id_partnership]'>
			                            <button type='button' class='btn kuning'>Edit</button>
			                        </a>
			                        <a href='?act=hapus&id=$data[id_partnership]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
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

	<br>
	
	<a href='print.php?table=partnership'><button type='button'>Print</button></a>

	<hr>
</section>

<?php include('inc/footerbackend.php');?>