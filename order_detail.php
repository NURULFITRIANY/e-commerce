<?php $page = "DETAIL PESANAN"; ?>

<?php include('inc/header.php'); ?>

<?php 
    // tambahkan operasi kondisi untuk mengecek apakah member telah login. 
    if (!isset($_SESSION['email']) AND !isset($_SESSION['password'])) {
        header('location:sign_in.php'); 
    }
?>


<!-- BAGIAN ISI -->
<section id="main-content">
    <div class="container">
		<hr>

		<h2>Pembelian Produk</h2>

		<hr>

		<?php include ('inc/kategori.php'); ?>

		<div id="order-details">
            <?php 
            //mendapatkan id_member
            $query = mysql_query
                ("SELECT * FROM member 
                    WHERE email = '$_SESSION[email]' 
                    AND password = '$_SESSION[password]'
                ");
            $data = mysql_fetch_array($query);

            //retrieving data pesanan dari table 'pesanan'
            $order = mysql_query
                    ("SELECT * FROM pesanan 
                        WHERE  id_pesanan = '$_GET[id]' 
                    ");
            $hasil = mysql_fetch_array($order);
        ?>

			<h1>Detail Pemesanan</h1>
			<h2>Order #<?php  echo $hasil['id_pesanan'];?></h2>
			<p>Tanggal: <?php echo date("d/m/Y", strtotime($hasil['tanggal'])); ?></p>

			<h2>Informasi Pembeli</h2>
			<p>
				Nama: <?php echo $data['nama_depan']." ".$data['nama_belakang']; ?><br>
                Telepon: <?php echo $data['telepon']; ?><br>
                Email: <?php echo $data['email']; ?>
			</p>

			<h2>Produk</h2>

			<table border="1">
				<tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
                <!-- Product list -->
                <?php 
                    // 
                    $i = 0;
                    //
                    $subtotal = 0;
                    //
                    $total = 0;
                    //
                    // still error
                    $detail = mysql_query("SELECT * FROM pesanan_detail WHERE id_pesanan = '$_GET[id]'");
                    // variable list will run while looping data from table pesanan_detail
                    while ($list = mysql_fetch_array($detail)) {
                        $i++;
                        $produk = mysql_query
                                ("SELECT * FROM produk 
                                    WHERE id_produk = '$list[id_produk]'");
                        $hasil_produk = mysql_fetch_array($produk);
                        $subtotal = $hasil_produk['harga'] * $list['jumlah'];

                    echo "
                        <tr>
                            <td>$i</td>
                            <td>$hasil_produk</td>
                            <td>$ ".number_format($hasil_produk['harga'], 0, ',', '.')."</td>
                            <td>$list[jumlah]</td>
                            <td>$ ".number_format($subtotal, 0, ',', '.')."</td>
                        </tr>
                    ";

                        $total = $total + $subtotal;
                    }
                ?>

                <!-- total -->
                <tr class="total">
                    <td colspan="5">
                        Subtotal: <?php echo "$. ".number_format($total, 0, ',', '.'); ?> <br />
                        <span>TOTAL: $<?php echo "$. ".number_format($total, 0, ',', '.'); ?></span>
                    </td>
                </tr>
			</table>
            <a href="#" class="secondary-cart-btn" onclick="window.print();">CETAK</a>
		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>
