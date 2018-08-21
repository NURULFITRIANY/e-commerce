<?php

include ('../inc/config.php');

$blog	=
"CREATE TABLE blog (
id_blog INT(4) NOT NULL AUTO_INCREMENT,
judul VARCHAR(50) NOT NULL,
deskripsi VARCHAR(255) NOT NULL,
isi TEXT NOT NULL,
tanggal DATE NOT NULL,
gambar VARCHAR(255) NOT NULL,
PRIMARY KEY (id_blog)
) ENGINE=MyISAM;";
// Each MyISAM table is stored on disk in three files
// engine : transaction (CRUD) relasi (ERD)

$kategori =
"CREATE TABLE kategori (
id_kategori INT(4) NOT NULL AUTO_INCREMENT,
kategori VARCHAR(20) NOT NULL,
PRIMARY KEY (id_kategori)
) ENGINE=MyISAM;";


$member =
"CREATE TABLE member (
id_member INT(4) NOT NULL AUTO_INCREMENT,
nama_depan VARCHAR(50) NOT NULL,
nama_belakang VARCHAR(50) NOT NULL,
alamat VARCHAR(100) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(10) NOT NULL,
telepon VARCHAR(20) NOT NULL,
PRIMARY KEY (id_member)
) ENGINE=MyISAM;";

$pesanan =
"CREATE TABLE pesanan (
id_pesanan INT(4) NOT NULL AUTO_INCREMENT,
id_member INT(4) NOT NULL,
tanggal DATE NOT NULL,
harga INT(2) NOT NULL,
status INT(2) NOT NULL,
PRIMARY KEY (id_pesanan)
) ENGINE=MyISAM;";

$pesanan_detail =
"CREATE TABLE pesanan (
id_pesanan_detail INT(4) NOT NULL AUTO_INCREMENT,
id_pesanan INT(4) NOT NULL,
id_produk INT(4) NOT NULL,
jumlah INT(4) NOT NULL,
PRIMARY KEY (id_pesanan)
) ENGINE=MyISAM;";

$produk =
"CREATE TABLE produk (
id_produk INT(4) NOT NULL AUTO_INCREMENT,
judul VARCHAR(50) NOT NULL,
deskripsi VARCHAR(255) NOT NULL,
isi TEXT NOT NULL,
harga INT(10) NOT NULL,
stok INT(1) NOT NULL,
tanggal DATE NOT NULL,
gambar VARCHAR(255) NOT NULL,
id_kategori INT(4),
PRIMARY KEY (id_produk)
) ENGINE=MyISAM;";

$user =
"CREATE TABLE user (
id_user INT(4) NOT NULL AUTO_INCREMENT,
nama VARCHAR(100) NOT NULL,
password VARCHAR(50) NOT NULL,
PRIMARY KEY (id_user)
) ENGINE=MyISAM;";

$data_user  =
"INSERT INTO user(nama, password)
VALUES('admin', 'admin')";


// variable paramater to run CRUD function that query "CREATE" we made
mysql_query($blog);
mysql_query($kategori);
mysql_query($member);
mysql_query($pesanan);
mysql_query($pesanan_detail);
mysql_query($produk);
mysql_query($user);
mysql_query($data_user);
?>
