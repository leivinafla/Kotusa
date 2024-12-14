
<?php
session_start();
include '../koneksi.php';
 


$id = $_GET['id'];
$data = mysqli_query($koneksi,"select * from kategori where id='$id'");

$result = [];


while($d = mysqli_fetch_assoc($data))
{
	$result[] = $d;
}

$result= $result[0];



?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP dan MySQLi</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
		<div class="kotak_login">
	<p class="tulisan_login">Edit Data Category</p>
 

	<form method="POST" action="update.php">


		
		<input type="hidden" name="id" class="form_login" placeholder="id.." value="<?php echo $result['id'] ?>">
		<label>Category</label>
		<input type="text" name="kategori" class="form_login" placeholder="kategori.." value="<?php echo $result['kategori'] ?>">
 		<input type="submit" name="submit" class="tombol_login" value="SIMPAN">
		<br/>
		<br/>
		<center>
			<a class="link" href="../category/Tcategory.php">KEMBALI</a>
		</center>
	</form>
	
</div>
 
</body>
</html>