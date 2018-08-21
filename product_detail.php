<?php $page = "PRODUK DETAIL" ?>

<?php include('inc/header.php'); ?>	

<!-- BAGIAN ISI -->
<section id="main-content" class="clearfix">
	<div class="container">
		<hr>

		<?php  
			$query = mysql_query("SELECT * FROM produk WHERE id_produk = $_GET[id]");
			while ($data= mysql_fetch_array($query)) {
				if ($data['stok']==1) {
					$stok = "<span class='instock'>Stok Tersedia</span>";
				} else {
					$stok = "<span class='outstock'>Stok Habis</span>";
				}
				echo "
					<div id='product-image'>
						<img src='admin/uploads/product/$data[id_gambar]' alt='Product'>
					</div>

					<div id='product-details'>
						<h1>$data[judul]</h1>
			            <p class='code'>Kode Produk: <span>$data[id_produk]</span></p>
			            <p>$data[isi]</p>
			            
			            <hr>

			            <form action='cart.php' method='get'>
			            	<input type='hidden' name='id' value='$data[id_produk]'>
			                <label for='qty'>Qty:</label>
			                <input type='text' id='qty' name='qty' value='1' maxlength='2'>

			                <button type='submit' class='secondary-cart-btn'>
			                    <img src='img/white-cart.gif' alt='Add to Cart' /> BELI SEKARANG
			                </button>
			            </form>
					</div>
				";
			}
		?>

		
		
		
		

		<!-- price -->
		<div id="product-info">
			<p class="price">$499</p>
            <h5>Ketersediaan: </h5>
		</div>

	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>