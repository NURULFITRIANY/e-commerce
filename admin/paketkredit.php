<?php $page = "KREDIT";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>


<!-- Manajemen Kategori Produk -->
<section class="main">
    <h1>PAKET KREDIT</h1>
    <hr>
    
    <?php  
		if (isset($_GET['act']) AND $_GET['act']=='tambah') {

		} elseif (isset($_GET['act']) AND $_GET['act']=='prosestambah') {
			
		} elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
			# code...
		} elseif (isset($_GET['act']) AND $_GET['act']=='prosesedit') {
			# code...
		} elseif (isset($_GET['act']) AND $_GET['act']=='hapus') {
			# code...
		}
	?>
    <a href="?act=tambah">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
        <thead>
            <tr>
            	<th>ID</th>
            	<th>Produk</th>
            	<th>Kode Paket</th>
            	<th>Jumlah Cicilan</th>
            	<th>Bunga</th>
            	<th>Uang Muka</th>
            	<th>Harga Paket</th>
            	<th>Nilai Cicilan</th>
            	<th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        	<?php 
        	$query = mysql_query("");
        	if (mysql_num_rows($query) > 0) {
        		while ($data = mysql_fetch_array($query)) {
        			echo "


        			";
        		} else {
        			echo "
	                    <tr>
	                        <td colspan='7'>Tidak ada data.</td>
	                    </tr>
                	";
        		}
        	}
        	 ?>
            <tr>
            	<td>ID</td>
            	<td>Produk</td>
            	<td>Kode Paket</td>
            	<td>Jumlah Cicilan</td>
            	<td>Bunga</td>
            	<td>Uang Muka</td>
            	<td>Harga Paket</td>
            	<td>Nilai Cicilan</td>
            	<td>Aksi</td>
            </tr>
        </tbody>
    </table>
    
</section>

<?php include('inc/footerbackend.php');?>