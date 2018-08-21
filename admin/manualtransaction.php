<?php $page = "TRANSACTION";?>

<?php include('inc/headerbackend.php'); ?>

<?php include('inc/sidebarbackend.php'); ?>


<section class="main">
    <h1>TRANSACTION</h1>
    <hr>
    <h2>Cash</h2>
    </br>

     <?php  
        if (isset($_GET['act']) AND $_GET['act']=='tambahmanualtransaction') {
            echo "
                <h3>Tambah Data</h3>
                
                <form name='tambah' action='?act=proses_tambahmanualtransaction' method='post' enctype='multipart/form-data'>
                    <p><input type='text' name='job_name' placeholder='Job'></p>
                    <p><input type='text' name='job_cost' placeholder='Job Cost'></p>
                    <p><input type='text' name='job_quantity' placeholder='Job Quantity'></p>
                    <p><textarea name='job_description' cols='50' rows='10' placeholder='Job Description'></textarea></p>
                    <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
                </form>
                
                <hr>
            ";
        } elseif (isset($_GET['act']) AND $_GET['act']=='prosestambahmanualtransaction') {
            
        } elseif (isset($_GET['act']) AND $_GET['act']=='editmanualtransactio') {
            $isi = mysql_fetch_array(mysql_query("SELECT * FROM job WHERE id_job = '$_GET[id]'"));
            echo "
                <h3>Tambah Data</h3>
                
                <form name='tambah' action='?act=proses_tambahmanualtransaction' method='post' enctype='multipart/form-data'>
                    <p><input type='text' name='job_name' placeholder='Job'></p>
                    <p><input type='text' name='job_cost' placeholder='Job Cost'></p>
                    <p><input type='text' name='job_quantity' placeholder='Job Quantity'></p>
                    <p><textarea name='job_description' cols='50' rows='10' placeholder='Job Description'></textarea></p>
                    <p><input type='submit' name='proses' value='Simpan' class='btn biru'></p>
                </form>
                
                <hr>
            ";
        } elseif (isset($_GET['act']) AND $_GET['act']=='proseseditmanualtransaction') {
            # code...
        } elseif (isset($_GET['act']) AND $_GET['act']=='hapusmanualtransaction') {
            $hapus = mysql_query("DELETE FROM job
                        WHERE id_job = '$_GET[id]'");
                            
            if($hapus) {
                echo "Data berhasil dihapus!";
            } else {
                echo "Data gagal dihapus!";
            }
            
            echo "<hr>";

        }
    ?>
    
    <a href="?act=tambahmanualtransaction">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
        <thead>
            <tr>
            	<th>ID</th>
            	<th>Pembeli</th>
            	<th>Produk</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysql_query("");
            if (mysql_num_rows($query) > 0) {
                while ($data = mysql_fetch_array($query)) {
                    echo "


                    ";
                } else {
                    echo "
                        <tr>
                            <td colspan='7'>Tidak ada data.</td>
                        </tr>
                    ";
                }
            }
             ?>
            <tr>
            	<td>ID</td>
            	<td>Pembeli</td>
                <td>Produk</td>
                <td>Tanggal</td>
                <td>Harga</td>
            	<td>Aksi</td>
            </tr>
        </tbody>
    </table>
    
</section>

<section class="main">
    <h2>Credit</h2>
    </br>
    
     <?php  
        if (isset($_GET['act']) AND $_GET['act']=='tambah') {

        } elseif (isset($_GET['act']) AND $_GET['act']=='prosestambah') {
            
        } elseif (isset($_GET['act']) AND $_GET['act']=='edit') {
            # code...
        } elseif (isset($_GET['act']) AND $_GET['act']=='prosesedit') {
            # code...
        } elseif (isset($_GET['act']) AND $_GET['act']=='hapus') {
            # code...
        }
    ?>

    <a href="?act=tambah">
        <button type="button" class="btn hijau">Tambah</button>
    </a>

    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pembeli</th>
                <th>Produk</th>
                <th>Paket</th>
                <th>Biaya Tambahan</th>
                <th>Tanggal</th>
                <th>KTP</th>
                <th>KK</th>
                <th>Slip Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysql_query("");
            if (mysql_num_rows($query) > 0) {
                while ($data = mysql_fetch_array($query)) {
                    echo "


                    ";
                } else {
                    echo "
                        <tr>
                            <td colspan='7'>Tidak ada data.</td>
                        </tr>
                    ";
                }
            }
             ?>
            <tr>
                <td>ID</td>
                <td>Pembeli</td>
                <td>Produk</td>
                <td>Paket</td>
                <td>Biaya Tambahan</td>
                <td>Tanggal</td>
                <td>KTP</td>
                <td>KK</td>
                <td>Slip Gaji</td>
                <td>Aksi</td>
            </tr>
        </tbody>
    </table>
    
</section>


<section class="main">
    <h2>Installment</h2>
    <hr>


    <!-- 
    #1 search engine to select based on code of installment package
    #2 menu used for paying the installment 
    #3 display the facility to pay the installment
    #4 display the residual debt
    -->


    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $query = mysql_query("");
            if (mysql_num_rows($query) > 0) {
                while ($data = mysql_fetch_array($query)) {
                    echo "


                    ";
                } else {
                    echo "
                        <tr>
                            <td colspan='7'>Tidak ada data.</td>
                        </tr>
                    ";
                }
            }
             ?>
            <tr>
                <td>ID</td>
                <td>Kategori</td>
                <td>Aksi</td>
            </tr>
        </tbody>
    </table>
    
</section>



<?php include('inc/footerbackend.php');?>