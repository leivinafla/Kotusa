<?php 

include('../koneksi.php');

$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM detail_pembelian WHERE id='$id'");

if($hapus)
    header('location: pesanan_kasir.php');
else
    echo "Hapus data gagal";

?>
