
<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form


$id = $_POST['id'];
$kategori = $_POST['kategori'];

 
// update data ke database
mysqli_query($koneksi,"update kategori set kategori='$kategori' where id='$id'");
 
// mengalihkan halaman kembali ke index.php
header("location:../category/Tcategory.php");
 
?>

