<?php 
session_start();

$id_produk = $_GET['id_produk'];

if (isset($_SESSION['pesanan'][$id_produk]))
{
	$_SESSION['pesanan'][$id_produk]+=1;
}

else 
{
	$_SESSION['pesanan'][$id_produk]=1;
}

echo "<script>alert('Produk telah masuk ke pesanan anda');</script>";
echo "<script>location= 'pesanan_pembeli.php'</script>";

 ?>