<?php
    include('inc/config.php');
    
    session_start();
    
    if(!isset($_SESSION['nama']) AND !isset($_SESSION['password'])){
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- variable of $page to add various title per page -->
        <title><?php echo $page; ?> - ADMIN</title>
        <link rel="icon" href="img/favicon.ico">
        <link href="css/style.css" rel="stylesheet" />
        <script src="tcal.js"></script>
        <link href="tcal.css" rel="stylesheet" >
        <script type="text/javascript" src="fusioncharts.js"></script>
        <script type="text/javascript" src="fusioncharts.theme.fint.js"></script>
    </head>

    <body>
