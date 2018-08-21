<?php $page = "AKUN"; ?>

<?php include('inc/header.php'); ?>
<?php
	$query=mysql_query("SELECT * FROM member WHERE id_member='1'");
	$hasil=mysql_fetch_array($query);

	echo $hasil['email'];

?>