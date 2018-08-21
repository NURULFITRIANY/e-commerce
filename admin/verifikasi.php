<?php

    include('inc/config.php');

    $nama = $_POST['nama'];
    $password = $_POST['password'];
    
    // sebuah teknik hacking dimana seorang penyerang dapat memasukkan perintah SQL melalui URL untuk dieksekusi oleh database --> mysql_real_escape_string
    $nama	= mysql_real_escape_string($nama);
    $password = mysql_real_escape_string($password);
 
    //adjustment from database
    $query = mysql_query("SELECT * FROM user WHERE nama = '$nama' AND password = '$password'");

    //Get number of rows in result from SQL query --> mysql_num_rows
   if(mysql_num_rows($query) == 1) {
   		// session_start() - Start new or resume existing session
    	session_start();
    	// set the session variables to store information (in variables)
    	$_SESSION['nama'] = $nama;
    	$_SESSION['password'] = $password;

    	header('location:indexbackend.php');
    	//if statement is true, redirect function send http address with $name, $password back to home page (admin)
    }else {
    	header('location:login.php');
    	//if statement is true, redirect function send http address without $name, $password back to home page (frontend page)
    }

    // if(mysql_num_rows($query) == 1) {
    // echo "Anda berhasil login";
	// } else {
	    // echo "Anda gagal login";
	// }

?>
