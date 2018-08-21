<?php $page = "SIGN UP"; ?>

<?php include('inc/header.php'); ?>

<?php
    // untuk mengecek apakah member telah login.
    // Jika telah login, maka akan me-redirect ke halaman account.php
    if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
        header('location:account.php');
    }

?>
<!-- tidak berfungsi -->
<?php
    if(isset($_GET['act']) AND $_GET['act']=='sign_up') {
        // coloumn password masih kosong : error!!!!
        if($_POST['password'] == $_POST['password_confirmation']){
          $tambah = mysql_query("INSERT INTO member (nama_depan, nama_belakang, alamat, email, password, telepon) VALUES ('$_POST[firstname]', '$_POST[lastname]', '$_POST[address]', '$_POST[email]','$_POST[password]', '$_POST[telephone]')");
          if ($tambah) {
            echo "
              <h4>Data berhasil disimpan.</h4>
            ";
          } else {
            echo "
              <h4>Data gagal disimpan.</h4>
            ";
          }
        } else {
                echo "
                    <h4>Password harus sama!</h4>
                ";
            }
    }
?>

<!-- BAGIAN ISI -->
<section id="main-content">
	<div class="container">
		<hr>
		<div id="new-account">

			<h1>Buat Akun Baru</h1>

			<form action="sign_up.php?act=sign_up" method="post">
				<!-- nama depan -->
				<p>
                    <label for="firstname">
                        <span class="required-field">*</span> NAMA DEPAN:
                    </label>
                    <input type="text" id="firstname" name="firstname" required>
                </p>
                <!-- nama belakang -->
                <p>
                    <label for="lastname">
                        <span class="required-field">*</span> NAMA BELAKANG:
                    </label>
                    <input type="text" id="lastname" name="lastname" required>
                </p>
                <!-- address -->
                <p>
                    <label for="lastname">
                        <span class="required-field">*</span> ALAMAT:
                    </label>
                    <input type="text" id="address" name="address" required>
                </p>
                <!-- email -->
                <p>
                    <label for="email">
                        <span class="required-field">*</span> EMAIL:
                    </label>
                    <input type="email" id="email" name="email" required>
                </p>
                <!-- password -->
                <p>
                    <label for="password">
                        <span class="required-field">*</span> PASSWORD:
                    </label>
                    <input type="password" id="password" name="password" required>
                </p>
                <!-- konfirmasi password -->
                <!-- password_confirmation - to make sure password insert is written like previous input -->
                <p>
                    <label for="password_confirmation">
                        <span class="required-field">*</span> KONFIRMASI PASSWORD:
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </p>
                <!-- telephone -->
                <p>
                    <label for="telephone">
                        <span class="required-field">*</span> TELEPON:
                    </label>
                    <input type="text" id="telephone" name="telephone" required>
                </p>
                <!-- note -->
                <p><span class="required-field">*</span> wajib diisi.</p>
                <hr>

                <input type="submit" value="BUAT AKUN" class="secondary-cart-btn">
			</form>

		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>
