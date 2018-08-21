<?php 
	//
	session_start();
	// 
	session_destroy();
	// balik ke halaman utama ketikan sign out
	header('location:index.php');
 ?>