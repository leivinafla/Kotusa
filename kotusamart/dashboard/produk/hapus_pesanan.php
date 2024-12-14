<?php 
session_start();
 
$id_produk = $_GET["id_produk"];

unset($_SESSION["pesanan"][$id_produk]);

echo "<script>alert('Produk telah dihapus');</script>"; 
echo "<script>location= 'pesanan_pembeli.php'</script>";


?>