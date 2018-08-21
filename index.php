<?php $page = "BERANDA"; ?>

<?php include ('inc/header.php'); ?>
<!--BAGIAN ISI-->
<section id="promo">
	<div class="container">
		<div id="promo-details">
			<h1>Penawaran Hari Ini</h1>
			<p>Lihat bagian produk kami<br> dengan harga diskon</p>
			<a href="#" class="default-btn">Belanja Sekarang</a>
		</div>
		<img src="img/promo.png" alt="Promotional Ad">
	</div>
</section>

<section id="main-content">
	<div class="container">
		<h2>Produk Pilihan</h2>
		<hr>

		<div id="products">
			<?php  
				$query = mysql_query("SELECT * FROM produk LIMIT 0,4");
				if (mysql_num_rows($query)>0) {
					while ($data = mysql_fetch_array($query)) {
						if ($data['stok']== 1) {
							$stok = "<span class='instock'>Stok Tersedia</span>";
						} else {
							$stok = "<span class='instock'>Stok Habis</span>";
						}
						echo " 
							<div class='product'> 
								<a href='product_detail.php'><img src='admin/uploads/product/$data[gambar]' alt='$data[judul]' class='feature'></a>
								<h3><a href='product_detail.php?id=$data[id_produk]'>$data[judul]</a></h3>
				                <p>$data[deskripsi]</p>
				                <h5>Ketersediaan: $stok</h5>
								<p>
									<a href='cart.php?id=$data[id_produk]' class='cart-btn'>
									<span class='price'>$ ".number_format($data['harga'], 0, ',', '.')."</span>
									<img src='img/white-cart.gif' alt='Add to Cart'>BELI SEKARANG</a>
								</p>
							</div>
						";
					}
				} else {
					echo "<h3>Tidak ada data</h3>";
				}
			?>
			
		</div>
	</div>
</section>
<!--BAGIAN ISI-->
<?php include ('inc/footer.php'); ?>