<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Dashboard | By Code Info</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/style3.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="container">
    

    <section class="main">
        <div class="main-top">
            <p>SELAMAT DATANG DI KOTUSA MART!</p>
        </div>
        <div class="main-body">

            <div class="job_card">
                <div class="">
                    <div class="img">
                        <i class=""></i>
                    </div>

                    <a href="tambah.php" class="icon-button">
                        <i class="fas fa-plus" herf="tambah.php"> TAMBAH DATA</i>
                    </a>

                    <a href="../dashboard/halaman_kasir.php" class="icon-button">
                    <i class="fas fa-backward" herf="tambah.php"> BACK</i>
                    </a>
                    <br/>
                    <br/>
                    <table class="table1">
                        <tr>
                            <th>NO</th>
                            <th>KATEGORI</th>
                            <th>MEREK</th>
                            <th>HARGA</th>
                            <th>STOK</th>
                            <th>GAMBAR</th>
                            <th colspan="4">OPSI</th>
                        </tr>
                        <?php
                        include '../koneksi.php';

                        $batas = 5;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
                        $previous = $halaman - 1;
                        $next = $halaman + 1;
                        $no = 1;

                        $query = "SELECT produk.*, kategori.kategori
                            FROM produk
                            INNER JOIN kategori ON produk.fid_kategori = kategori.id
                            ORDER BY produk.id_produk ASC LIMIT $halaman_awal, $batas";
                        
                        $data = mysqli_query($koneksi, $query);
                        
                        if (!$data) {
                            die("Query Eror: " . mysqli_error($koneksi));
                        }

                        $data_page = mysqli_query($koneksi, "SELECT * from produk");
                        $jumlah_data = mysqli_num_rows($data_page);
                        $total_halaman = ceil($jumlah_data / $batas);
                    

                        
while ($d = mysqli_fetch_array($data)) {
?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $d['kategori']; ?></td>
    <td><?php echo $d['merek']; ?></td>
    <td><?php echo $d['harga']; ?></td>
    <td><?php echo $d['stok']; ?></td>
    <td><img src="./gambar/<?php echo $d['gambar']; ?>" alt="produk" width="70" height="60"></td>
    <td><input type="hidden" name="gambar_lama" value="<?php echo $row['gambar']; ?>"></td>
    <td>
            </ul>
        </nav>
    </td>
    <td>
        <a href="edit.php?id_produk=<?php echo $d['id_produk']; ?>" onclick="return confirm('yakin mau edit ?');" class="btn btn-outline-success">
            <i class="fas fa-pen"></i>
            edit
        </a>
    </td>
    <td>
        <a href="hapus.php?id_produk=<?php echo $d['id_produk']; ?>" onclick="return confirm('yakin mau hapus ?');" class="btn btn-outline-danger">
            <i class="fas fa-eraser"></i>
            delete
        </a>
    </td>
</tr>
<?php
}
?>
                    </table>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" <?php if ($halaman > 1) {
                                echo "href='?halaman=$previous'";
                            } ?>>Previous</a>
                        </li>
                        <?php
                        for ($x = 1; $x <= $total_halaman; $x++) {
                            ?>
                            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" <?php if ($halaman < $total_halaman) {
                                echo "href='?halaman=$next'";
                            } ?>>Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

</body>
</html>