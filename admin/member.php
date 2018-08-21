<?php $page = "MEMBER"; ?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Manajemen Member</h1>
    
    <hr>
    
    <?php
    // tambah data member 
    if (isset($_GET['act']) AND $_GET['act']=='tambah') {
        echo "
            <h3>Tambah Data</h3>
            <form name='tambah' action='?act=proses_tambah' method='post'>
                <p><input type='text' name='nama_depan' placeholder='Nama Depan'></p>
                <p><input type='text' name='nama_belakang' placeholder='Nama Belakang'></p>
                <p><input type='text' name='alamat' placeholder='Alamat'></p>
                <p><input type='text' name='email' placeholder='Email'></p>
                <p><input type='text' name='telepon' placeholder='Telepon'></p>
                <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
            </form>
            <hr>
        ";
    }
    // proses tambah data member (part 2) 
    elseif(isset($_GET['act']) AND $_GET['act']=='proses_tambah') {
        $tambah = mysql_query
                    ("INSERT INTO member (nama_depan, nama_belakang, alamat, email, telepon)
                    VALUES ('$_POST[nama_depan]', 
                        '$_POST[nama_belakang]', 
                        '$_POST[alamat]', 
                        '$_POST[email]', 
                        '$_POST[telepon]')");
        if ($tambah) {
            echo "Data berhasil ditambahkan!";
        } else {
            echo "Data gagal ditambahkan!";
        }
        echo "<hr>";
    }
    // proses edit (part 1 - menampilkan form edit)
    elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
        $isi = mysql_fetch_array(mysql_query("SELECT * FROM member WHERE id_member = '$_GET[id]'"));
        echo "
            <h3>Edit Data</h3>
            <form name='edit' action='?act=proses_edit' method='post'>
                <input type='hidden' name='id' value='$isi[id_member]'>
                    <p><input type='text' name='nama_depan' value='$isi[nama_depan]' placeholder='Nama Depan'></p>
                    <p><input type='text' name='nama_belakang' value='$isi[nama_belakang]' placeholder='Nama Belakang'></p>
                    <p><input type='text' name='alamat' value='$isi[alamat]' placeholder='Alamat'></p>
                    <p><input type='text' name='email' value='$isi[email]' placeholder='Email'></p>
                    <p><input type='text' name='telepon' value='$isi[telepon]' placeholder='Telepon'></p>
                    <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
            </form>
            <hr>
        ";
    }
    // proses edit (part 2 - memproses form edit)
    elseif (isset($_GET['act']) AND $_GET['act'] == 'proses_edit') {
        $edit =mysql_query
                ("UPDATE member 
                    SET nama_depan = '$_POST[nama_depan]', 
                    nama_belakang = '$_POST[nama_belakang]', 
                    alamat = '$_POST[alamat]',
                    email = '$_POST[email]',
                    telepon = '$_POST[telepon]'
                    WHERE id_member = '$_POST[id]'");
        if ($edit) {
           echo "Data berhasil diperbaharui!";
        } else {
            echo "Data gagal diperbaharui!";
        }
        echo "<hr>";
    } // menghapus data 
    elseif(isset($_GET['act']) AND $_GET['act']=='hapus') {
    $hapus = mysql_query("DELETE FROM member
                        WHERE id_member = '$_GET[id]'");               
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
    			<th>Alamat</th>
    			<th>Email</th>
    			<th>Telepon</th>
    			<th>Aksi</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php 
             // password - undefined in database (karna memang nga ada column d table)!!!
    			$query = mysql_query("SELECT * FROM member");
    			if (mysql_num_rows($query) > 0) {
    				while ($data = mysql_fetch_array($query)) {
    					echo "
    					<tr>
			    			<td>$data[id_member]</td>
			                <td>$data[nama_depan] $data[nama_belakang]</td>
			                <td>$data[alamat]</td>
			                <td>$data[email]</td>
			                <td>$data[telepon]</td>
			                <td>
			                	<a href='?act=edit&id=$data[id_member]'>
			                        <button type='button' class='btn kuning'>Edit</button>
			                    </a>
			                    <a href='?act=hapus&id=$data[id_member]' OnClick=\"return confirm('Anda yakin menghapus data?');\")>
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
    
    <a href='print.php?table=member'><button type='button'>Print</button></a>

    <hr>
</section>

<?php include('inc/footerbackend.php');?>