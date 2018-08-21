<?php $page = "PENCARIAN"; ?>

<?php include('inc/header.php'); ?>

<!-- BAGIAN ISI -->
<section id="main-content">
	<div class="container">
		<hr>
		<h2>Hasil pencarian untuk <span>"<?php echo $_GET['search']; ?>"</span></h2>
		<hr>

		<?php include('inc/kategori.php'); ?>
		<div id="listings">

			<!-- listings search's result -->
			<?php 
				$query = mysql_query("SELECT * FROM produk WHERE judul LIKE '%$_GET[search]%'");
				if (mysql_num_rows($query)>0) {
					while ($data = mysql_fetch_array($query)) {
						if ($data['stok']== 1) {
							$stok = "<span class='instock'>Stok Tersedia</span>";
						} else {
							$stok = "<span class='outstock'>Stok Habis</span>";
						}
						echo "
							<div class='product'> 
								<a href='product_detail.php?id=$data[id_produk]'><img src='admin/uploads/product/$data[gambar]' alt='$data[judul]' class='feature'></a>
								<h3><a href='product_detail.php?id=$data[id_produk]'>$data[judul]</a></h3>
				                <p>$data[deskripsi]</p>
				                <h5>Ketersediaan: $stok</h5>
								<p>
									<a href='cart.php?id=$data[id_produk]' class='cart-btn'><span class='price'>$".number_format($data['harga'], 0, ',', '.')."</span><img src='img/white-cart.gif'alt='Add to Cart'>BELI SEKARANG</a>
								</p>
							</div>
						";
					}
				} else {
					echo "<h3>Data Tidak Ditemukan<h3/>";
				}
			?>
			
		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>
