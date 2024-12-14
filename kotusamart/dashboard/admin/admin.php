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
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>LEVEL</th>
                       <th colspan="2">Opsi</th>

        </tr>
    <?php
        include '../koneksi.php'; 
        $batas = 6;
        $halaman = isset($_GET['halaman'])?(int)$_GET['halaman'] : 1;
        $halaman_awal = ($halaman>1) ? ($halaman * $batas) - $batas : 0;    
 
        $previous = $halaman - 1;
        $next = $halaman + 1;
        
        $data = mysqli_query($koneksi,"select * from admin where level IN('kasir','pembeli')");
        $jumlah_data = mysqli_num_rows($data);
        $total_halaman = ceil($jumlah_data / $batas);
        $data = mysqli_query($koneksi,"select * from admin where level IN('kasir','pembeli') limit $halaman_awal, $batas");
        $nomor = $halaman_awal+1;
        while($d = mysqli_fetch_array($data)){  
    
        // $data = mysqli_query($koneksi,"select * from karyawan");
        // while($d = mysqli_fetch_array($data)){
    ?>
            <tr>
                <td><?php echo $d['username']; ?></td>
                <td><?php echo str_repeat('*', strlen($d['password'])); ?></td>
                <td><?php echo $d['level']; ?></td>
                <td>
                    <a href="edit.php?id_admin=<?php echo $d['id_admin']; ?>" onclick="return confirm ('yakin mau diedit bang?');" class="btn btn-outline-success">
                    <i class="fas fa-pen"></i> </a></td>
                    <td><a href="hapus.php?id_admin=<?php echo $d['id_admin']; ?>" onclick="return confirm ('serius mau dihapus?');" class="btn btn-outline-danger">
                        <i class="fas fa-eraser"></i></a>
                    </td>
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