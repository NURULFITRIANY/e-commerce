<?php $page = "KERANJANG BELANJA"; ?>

<?php include('inc/header.php'); ?>

<?php 
    //penambahan keranjang belanja - apakah variabel get[id] telah di set
    // $_GET[‘id’] merupakan ID PRODUK
    // echo $_SESSION['id'];
    if (isset($_GET['id'])) {
        // Fungsi intval() digunakan untuk mengkonversi value ke tipe data integer
        $id = intval($_GET['id']);

        //penambahan kuantitas barang pada barang belanja - apakah variabel get[qty] telah di set
        // $_GET[‘id’] merupakan JUMLAH 
        if (isset($_GET['qty'])) {
            $qty = intval($_GET['qty']);
            // Jika isset bernilai 'benar' , maka akan membuat variabel session berupa array indeks ke $id dengan value $qty.
            $_SESSION['cart'][$id] = $qty;
        } else {
            // Jika opsi sebelumnya bernilai false, maka akan mengecek apakah variabel qty dan id = 1 (kosong atau tidak)
            // jika kosong , maka akan membuat variabel qty dan id bernilai 1
            // selanjutnya jika menambah qty berdasarkan $id (id_produk), maka akan menambah value sebanyak 1
            if (!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = 1;
            } else {
                $_SESSION['cart'][$id] = $_SESSION['cart'][$id] += 1;
            }
        }
        // untuk mengecek variabel session cart
        // var_dump($_SESSION['cart']); 
        
    } elseif(isset($_GET['act']) AND $_GET['act']=='hapus') {
        unset($_SESSION['cart'][$_GET['produk']]);
    } elseif (isset($_GET['act']) AND $_GET['act']=='checkout') {
        if (isset($_SESSION['id']) AND isset($_SESSION['email']) AND isset($_SESSION['password'])) {
            // mendapatkan id_member berdasarkan email , id member, password login
            //echo $_SESSION['id'];

            $query_member = mysql_query
                        ("SELECT * FROM member 
                        WHERE id_member ='$_SESSION[id]' 
                        AND email = '$_SESSION[email]' 
                        AND password = '$_SESSION[password]' ");
            $data_member = mysql_fetch_array($query_member);


            // mendapatkan data produk
            // Fungsi join() adalah fungsi yang digunakan untuk mengumpulkan komponen-komponen array menjadi suatu string
            // array yang dikumpulkan merupakan key-nya saja dengan separator berupa tanda koma (,)
            $produk = join(',', array_keys($_SESSION['cart']));
            $harga = 0;
            // perintah IN yang digunakan untuk 
            // memilih semua record yang ada di dalam variabel $produk
            $query_harga = mysql_query
                        ("SELECT id_produk, harga FROM produk 
                        WHERE id_produk IN ($produk)");
            while ($data_harga = mysql_fetch_array($query_harga)) {
                // Total harga didapatkan dari 
                // menghitung harga satuan produk dikalikan dengan jumlah barang yang akan dibeli 
                $harga = $harga + ($data_harga['harga'] * $_SESSION['cart'][$data_harga['id_produk']]);
            }
            // Memasukkan data pesanan berupa: id_member, tanggal, harga, dan status
            $pesanan = mysql_query
                    ("INSERT INTO pesanan (id_member, tanggal, harga, workplan_status)
                        VALUES ('$_SESSION[id]', now(), '$harga', 'workplan_status')") or die(mysql_error());
            // '$data_member[id_member]' diganti session[id_member]
            // Mendapatkan id yang terakhir dimasukkan dari tabel pesanan 
            // dan disimpan dalam variabel @pesanan.
        
            $id_pesanan = mysql_query
                    ("SELECT LAST_INSERT_ID() INTO @pesanan");
            //
            $detail_pesanan = mysql_query
                    ("SELECT * FROM produk 
                        WHERE id_produk IN ($produk)");

            while ($data_pesanan = mysql_fetch_array($detail_pesanan)) {
                // Memasukkan data detail pesanan berupa: 
                // @pesanan, ID produk, dan jumlah barang.
                $jumlah_barang = $_SESSION['cart'][$data_pesanan['id_produk']];
                mysql_query("INSERT INTO pesanan_detail (id_pesanan, id_produk, jumlah)
                            VALUES (@pesanan, '$data_pesanan[id_produk]', '$jumlah_barang') ") or die(mysql_error());
                $stokakhir = $data_pesanan['stok'] - $jumlah_barang;
                $kurangistok = mysql_query("UPDATE produk SET stok = $stokakhir WHERE id_produk = $data_pesanan[id_produk]") or die(mysql_error());
            }
            // Pengecekan jika data pesanan berhasil disimpan.
            if ($pesanan) {
                unset($_SESSION['cart']);
                echo "<h3 style='color: #f00;'>Data pesanan telah masuk. Silakan lakukan konfirmasi pembayaran.</h3>";
            } else {
                echo "<h3 style='color: #f00;'>Data pesanan gagal disimpan.";
            }
        } else {
            // member is directed to sign in page 
            header('location:sign_in.php');
        }
    }
?>

<!-- BAGIAN ISI -->
<section id="main-content" class="clearfix">
	<div class="container">
		<hr>

		<div id="shopping-cart">
			<h2>Keranjang Belanja</h2>

			<form action="cart.php" method="post">
				<table border="1">
					<tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php 
                        if (!empty($_SESSION['cart'])) {
                            //
                            $produk = join('.', array_keys($_SESSION['cart']));
                            $i = 0;
                            $total = 0;
                            $query = mysql_query("SELECT * FROM produk WHERE  id_produk IN ($produk)");

                            while ($data = mysql_fetch_array($query)) {
                                $i++;
                                $jumlah_barang = $_SESSION['cart'][$data['id_produk']];
                                $subtotal = $jumlah_barang * $data['harga'];

                                // iMac - productlist
                                echo "
                                    <tr>
                                        <td>$i</td>
                                        <td><a href='product_detail.php?id=$data[id_produk]'><img src='admin/uploads/produk/$data[gambar]' alt='$data[judul]'>$data[judul]</a></td>
                                        <td>$ ".number_format($data['harga'], 0, ',', '.')."</td>
                                        <td>$jumlah_barang</td>
                                        <td>
                                            $ ".number_format($data['harga'], 0, ',', '.')."
                                            <a href='cart.php?act=hapus&produk=$data[id_produk]'>
                                                <img src='img/remove.gif' class='remove' alt='hapus'>
                                            </a>
                                        </td>
                                    </tr>
                                ";
                                $total = $total + $subtotal;
                            }
                                echo "
                                    <tr class='total'>
                                        <td colspan='5'>
                                            <span>Total: $ ".number_format($total, 2, ',', '.')."</span>

                                            <br>

                                            <a href='product.php' class='tertiary-btn'>KEMBALI BELANJA</a>
                                            <a href='cart.php?act=checkout' class='secondary-cart-btn'>LAKUKAN PEMBAYARAN</a>
                                        </td>
                                    </tr>
                                ";
                        } else {
                            echo "
                                <tr class='total'>
                                    <td colspan='5'>
                                        <span>Keranjang belanja Anda kosong</span>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
				</table>
			</form>
		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>

