<?php 
session_start();

session_destroy();
//ended all active session

header('location:login.php');
//redirect to login entry page
 ?>