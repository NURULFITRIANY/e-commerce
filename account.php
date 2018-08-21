<?php $page = "AKUN"; ?>

<?php include('inc/header.php');?>

<?php
if (!isset($_SESSION['email']) AND !isset($_SESSION['password'])) {
    header('location:sign_in.php');
}
?>
<!-- BAGIAN ISI -->
<section id="main-content">
    <div class="container">
		<hr>

		<h2>Akun</h2>

		<hr>

		<?php include ('inc/kategori.php'); ?>

		<div id="personal-details">
            <?php
            // mengecek apakah tombol SIMPAN telah d klik
            // id --> dapat dari name= id
            if (isset($_POST['id'])) {
                $_SESSION['email'] = $_POST['email'];
                // querying updating 1 row from database based on session login of users
                // use 'name' untuk value
                $query = mysql_query("UPDATE member
                    SET nama_depan = '$_POST[nama_depan]',
                    nama_belakang = '$_POST[nama_belakang]',
                    alamat = '$_POST[alamat]',
                    email = '$_POST[email]',
                    telepon = '$_POST[telepon]'
                    WHERE id_member = '$_POST[id]'
                    ");
            }
            ?>

			<h1>Data Pribadi</h1>

            <?php
                // $query =mysql_query("SELECT * FROM member
                //         WHERE email = '$_SESSION[email]'
                //         AND password = '$_SESSION[password]'
                //         ");

            // selecting existing information berdasarkan session login user
                $query=mysql_query("SELECT * FROM member WHERE id_member='".$_SESSION['id']."'");
                $data = mysql_fetch_array($query);

            ?>

			<form action="account.php" method="post">
				<p>
                    <label for="firstname">
                        <span class="required-field">*</span> NAMA DEPAN:
                    </label>
                    <input type="text" id="firstname" name="nama_depan" value="<?php echo $data['nama_depan']; ?>" required>
                </p>
                <p>
                    <label for="lastname">
                        <span class="required-field">*</span> NAMA BELAKANG:
                    </label>
                    <input type="text" id="lastname" name="nama_belakang" value="<?php echo $data['nama_belakang']; ?>" required>
                </p>
                <p>
                    <label for="address">
                        <span class="required-field">*</span> ALAMAT:
                    </label>
                    <input type="text" id="address" name="alamat" value="<?php echo $data['alamat']; ?>" required>
                </p>
                <p>
                    <label for="email">
                        <span class="required-field">*</span> EMAIL:
                    </label>
                    <input type="email" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                </p>
                <p>
                    <label for="telephone">
                        <span class="required-field">*</span> TELEPON:
                    </label>
                    <input type="text" id="telephone" name="telepon" value="<?php echo $data['telepon']; ?>" required>
                </p>

                <p><span class="required-field">*</span> wajib diisi.</p>

                <hr>

                <input type="hidden" name="id" value="<?php echo $data['id_member']; ?>">
                <input type="submit" value="SIMPAN" class="secondary-cart-btn">
			</form>
		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>

