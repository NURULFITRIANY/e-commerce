<?php $page = "DAFTAR PESANAN"; ?>

<?php include('inc/header.php'); ?>

<?php 
    // tambahkan operasi kondisi untuk mengecek apakah member telah login. 
    if (!isset($_SESSION['email']) AND !isset($_SESSION['password'])) {
        header('location:sign_in.php'); 
    }
?>

<!-- BAGIAN ISI -->
<section id="main-content">
    <div class="container">
		<hr>

		<h2>Pembelian Produk</h2>

		<hr>

		<?php include ('inc/kategori.php'); ?>

		<div id="order-history">
        	
			<h1>Daftar Pesanan</h1>

			<table border="1">
				<tr>
					<th>#</th>
                    <th>ID Pemesanan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Status</th>
				</tr>
				<!-- list order 1 -->
                <?php  
                    // mendapatkan id_member dengan selecting member based on session login of user
                    $query = mysql_query
                            ("SELECT * FROM member 
                            WHERE email = '$_SESSION[email]'
                            AND password = '$_SESSION[password]'
                            ");
                            $data = mysql_fetch_array($query);
                            $id_member = $data['id_member'];
                    // manajemen data pesanan
                    // 
                    $i=0;
                    // menampilkan hasil querying variable dari table pesanan
                    $order=mysql_query
                            ("SELECT * FROM pesanan 
                                WHERE id_member = '$id_member'
                                ORDER BY id_pesanan DESC 
                            ");
                    while($hasil = mysql_fetch_array($order)) {
                        $i++;
                        //buat conditional statement untuk buat variable status finalized , pending , and aborted
                        if ($hasil['status']==1)  {
                            $status = "<td class='finalized'>Finalized</td>";
                        } elseif ($hasil['status']==1) {
                            $status = "<td class='pending'>Finalized</td>";
                        } else {
                            $status = "<td class='finalized'>Finalized</td>";
                        }

                        echo "
                            <tr>
                                <td>1.</td>
                                <td><a href='order_detail.php?id=$hasil[id_pesanan]'>$hasil[id_pesanan]</a></td>
                                <td>>".date("d F Y", strtotime($hasil['tanggal']))."</td>
                                <td>".number_format($hasil['harga'], 0, ',', '.')."</td>
                                <td class='finalized'>$status</td>
                            </tr>
                        ";
                    }       
                ?>
				
			</table>
		</div>
	</div>
</section>
<!-- BAGIAN ISI -->

<?php include('inc/footer.php'); ?>
