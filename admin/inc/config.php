

 <?php 
	$host	= "localhost";
	$user	= "root";
	$pass	= "";
	$db		= "karisma_ecommerce";
	$connect	= mysql_connect($host, $user, $pass) or die("koneksi database gagal!");
 
	$select_db = mysql_select_db($db, $connect) or die ("Database $db tidak ditemukan");

 ?>