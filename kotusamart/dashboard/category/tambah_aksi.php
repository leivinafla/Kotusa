<?php
// koneksi database
include '../koneksi.php';

// Menangkap data yang dikirim dari formulir
$kategori = $_POST['kategori'];

// Menghindari penambahan kategori yang sudah ada
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategori = '$kategori'");
if ($query === false) {
	// Jika terjadi kesalahan dalam eksekusi query
	echo "Error: " . mysqli_error($koneksi);
} else {
	// Jika query berhasil dieksekusi
	if (mysqli_num_rows($query) > 0) {
		// Jika kategori belum ada, tambahkan ke database
		header("location:Tcategory.php");
		exit; // Keluar dari skrip setelah pengalihan halaman
	} else {
		// Redirect ke halaman kategori.php
		$insert = mysqli_query($koneksi, "INSERT INTO kategori (kategori) VALUES ('$kategori')");

		if ($insert) {
			//
			header("location:Tcategory.php");
			exit; // Keluar dari skrip setelah pengalihan halaman
		} else {
			// Jika terjadi kesalahan dalam eksekusi query INSERT
			echo "Gagal menambahkan kategori: " . mysqli_error($koneksi);
		}
	}
}
?>