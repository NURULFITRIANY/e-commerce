<aside id="categories-menu">
	<h3>Kategori</h3>
	<ul>
		<?php  
			$query = mysql_query("SELECT * FROM kategori");
			while ($data = mysql_fetch_array($query)) {
				echo "
						<li><a href='product.php?kategori=$data[id_kategori]'>$data[kategori]</a></li>
				";			
			}
		?>
	</ul>
</aside>