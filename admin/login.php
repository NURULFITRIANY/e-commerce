<?php
    // start the session
    session_start();
    
    if(isset($_SESSION['nama']) AND isset($_SESSION['password'])){
        header('location:indexbackend.php');
        //
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>LOGIN ADMIN</title>
		<link rel="icon" href="img/favicon.ico">
		<link href="css/style.css" rel="stylesheet" />
	</head>

	<body>
		<section class="main">
			<h1>Silahkan masukkan nama dan password Anda:</h1>
			<hr class="separator">
			<form name="login" action="verifikasi.php" method="post">
				<p><input type="text" name="nama" placeholder="nama"></p>
				<p><input type="password" name="password" placeholder="password"></p>
				<p><input type="submit" name="login" value="Login" class="btn hijau"></p>
			</form>
		</section>
	</body>
</html>
