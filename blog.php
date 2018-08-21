<?php $page ="BLOG"; ?>
<?php include ('inc/header.php'); ?>

<!-- BAGIAN ISI -->
<section id="main-content" class="clearfix">
	<div>
		<hr>
		<h2>Blog</h2>
		<hr>
		<aside id="categories-menu">
			<h3>Blog Terbaru</h3>
			<ul>
				<?php  
					$query = mysql_query("SELECT * FROM blog ORDER BY id_blog DESC LIMIT 0,5 ");
					while ($data = mysql_fetch_array($query)) {
						echo "
							<li><a href='blog_detail.php?id=$data[id_blog]'>$data[judul]</a></li>
						";
					}
				?>
			</ul>
		</aside>

		<!-- php untuk menampilkan list blog yang dibuat dihalaman admin -->
		<div id="listings">
			<?php  
				$start = 0; //nilai awal dari pagination
				$limit = 6; //jumlah record yang akan ditampilkan
				// mengecek apakah terdapat variabel $_GET['page']
				if (isset($_GET['page'])) {
					// 
					$page = $_GET['page'];
					// 
					$start = ($page-1) * $limit;
				}
				// query yang dijalankan
				$query = mysql_query("SELECT * FROM blog ORDER BY id_blog DESC LIMIT $start, $limit");
				while ($data = mysql_fetch_array($query)) {
					echo "
						<div class='product'>
							<a href='blog_detail.php?id=$data[id_blog]'><img src='admin/uploads/blog/$data[gambar]' alt='$data[judul]' class='feature'></a>
							<h3><a href='blog_detail.php?id=$data[id_blog]'></a>$data[judul]</h3>
							<p>$data[deskripsi]</p>
							<p><a href='blog_detail.php?id=$data[id_blog]' class='blog-btn'>Selengkapnya</a></p>
						</div>
					";
				}
			?>

		</div>
	</div>
</section>

<!-- BAGIAN ISI -->

<!-- Pagination -->
<section id="pagination">
    <p>
    	<?php 
    		// 
    		$query = mysql_query("SELECT * FROM blog");
    		// 
    		$rows = mysql_num_rows($query);
    		// 
    		$total = ceil($rows/$limit);
    		echo "
    			Halaman:
    		";
    		// Variable ($i) untuk page
    		for ($i=1; $i <= $total; $i++) { 
    			if ($i == $page OR (!isset($_GET['page']) AND $i == 1)) {
    				echo "<span class='current'>$i</span>";
    			} else {
    				echo "<a href='blog.php?page=$i'>$i</a>";
    			}
    			if ($i !=$total) {
    				echo "/";
    			}
    		}

    	?>
    </p>
</section>
<!-- Pagination -->

<?php include ('inc/footer.php'); ?>


