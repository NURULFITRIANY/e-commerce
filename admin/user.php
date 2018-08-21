<?php $page = "USER"; ?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
<h1>Manajemen User</h1>
    <hr>
    
    <?php
    // php untuk menampilkan form tambah user (part 1) 
    	if (isset($_GET['act']) AND $_GET['act']=='tambah') {
    		echo "
    			<h3>Tambah Data</h3>
			    <form>
			    	<p><input type='text' name='nama' placeholder='Nama'></p>
			        <p><input type='password' name='password' placeholder='Password'></p>
			        <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
			    </form>
			    <hr>
    		";
    	}
    	// php untuk memproses tambah user
    	elseif (isset($_GET['act']) AND $_GET['act']=='proses_tambah') {
    		$tambah = mysql_query("INSERT INTO user (nama, password)
    				VALUES ('$_POST[nama]', '$_POST[password]')");
    		if ($tambah) {
    			echo "Data berhasil ditambahkan!";
		    } else {
		        echo "Data gagal ditambahkan!";
    		}
    		echo "<hr>";
    	}
    	elseif(isset($_GET['act']) AND $_GET['act']=='edit') {
		    $isi = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user = '$_GET[id]'"));
		    
		    echo "
		        <h3>Edit Data</h3>
		        
		        <form name='edit' action='?act=proses_edit' method='post'>
		            <input type='hidden' name='id' value='$isi[id_user]'>
		            <p><input type='text' name='nama' value='$isi[nama]' placeholder='Nama'></p>
		            <p><input type='password' name='password' value='$isi[password]' placeholder='Password'></p>
		            <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
		        </form>
		        
		        <hr>
		    ";
		}
		elseif(isset($_GET['act']) AND $_GET['act']=='proses_edit') {
		    $edit = mysql_query("UPDATE user SET nama = '$_POST[nama]', password = '$_POST[password]'
		                        WHERE id_user = '$_POST[id]'");
		                            
		    if($edit) {
		        echo "Data berhasil diperbaharui!";
		    } else {
		        echo "Data gagal diperbaharui!";
		    }
		    
		    echo "<hr>";
		}
		elseif(isset($_GET['act']) AND $_GET['act']=='hapus') {
		    $hapus = mysql_query("DELETE FROM user
		                        WHERE id_user = '$_GET[id]'");
		                            
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
    			<th>Nama</th>
    			<th>Password</th>
    			<th>Aksi</th>
    		</tr>
    	</thead>
    	<tbody>

    		<?php  
    			$query = mysql_query("SELECT * FROM user");
    			if (mysql_num_rows($query)>0) {
    				while ($data = mysql_fetch_array($query)) {
    					echo "
    						<tr>
				    			<td>$data[id_user]</td>
				                <td>$data[nama]</td>
				                <td>$data[password]</td>
				                <td>
				                    <a href='?act=edit&id=$data[id_user]'>
				                    <button type='button' class='btn kuning'>Edit</button>
				                    </a>
				                    
				                    <a href='?act=hapus&id=$data[id_user]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
				                    <button type='button' class='btn merah'>Hapus</button>
				                    </a>
				                </td>
				    		</tr>
    					";
    				}
    			} else {
    				echo "
	                    <tr>
	                        <td colspan='4'>Tidak ada data.</td>
	                    </tr>
	                ";
    			}
    		?>
    	</tbody>
    </table>

</section>

<?php include('inc/footerbackend.php');?>