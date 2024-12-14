
<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data id yang di kirim dari url
$id_produk = $_GET['id_produk'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"delete from produk where id_produk='$id_produk'");
 
// mengalihkan halaman kembali ke index.php
header("location:Tproduk.php");
 
?>