<?php $page = "SIGN IN"; ?>

<?php include('inc/header.php'); ?>

<?php
    if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
        header('location:account.php');
    }
?>
<?php 
    if (isset($_GET['act']) AND $_GET['act']=='sign_in') {
        $query = mysql_query("SELECT * FROM member WHERE email = '$_POST[email]'  and password = '$_POST[password]'");
        if(mysql_num_rows($query) == 1) {
            session_start();
            $data=mysql_fetch_array($query);
            // untuk retrieve buat session baru berdasarkkan id_member yang login
            $_SESSION['id']=$data['id_member'];
            // hanya session email dan password
            $_SESSION['email'] = '$_POST[email]';
            $_SESSION['password'] = '$_POST[password]';

            // if sucessed users goes to header location
            header('location:account.php');
        } else {
            //jika login gagal
            echo "<h1>Gagal login!</h1>";
        }
    }
?>

<!-- BAGIAN ISI -->
<section id="signin-form">
	<div class="container">
		<hr>
		<h1>Sign In</h1>
		<form action="sign_in.php?act=sign_in" method="post">
			<p>
                <img src="img/email.gif" alt="Email Address">
                <input type="email" name="email" placeholder="Email Address">
            </p>
            <p>
                <img src="img/password.gif" alt="Password">
                <input type="password" name="password" placeholder="password">
            </p>
            <button type="submit" class="secondary-cart-btn">SIGN IN</button>
		</form>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>
