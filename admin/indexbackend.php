<?php $page = "BERANDA"; ?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>

<section class="main">
	<h1>Selamat Datang, <?php echo $_SESSION['nama']; ?> </h1>
	
	<?php 
		$query_pesanan = mysql_num_rows(mysql_query("SELECT id_pesanan FROM pesanan WHERE workplan_status = '2'"))or die(mysql_error());
		// $query_pesanan =mysql_num_rows(result(query));
	?>
	<p>Hari ini ada <a href="order.php"><?php echo $query_pesanan; ?></a> pesanan yang belum diproses.</p>
</section>

<?php include('inc/footerbackend.php');?>