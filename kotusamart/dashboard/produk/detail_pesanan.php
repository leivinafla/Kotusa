<?php 
include('../koneksi.php');
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: ../admin/index.php");
    exit;
} 
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <title>Kotusa Mart</title>
</head>
<body>
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
        <h1 class="display-4"><span class="font-weight-bold">KOTUSA MART</span></h1>
        <hr>
        <p class="lead font-weight-bold">Silahkan Pesan Menu Sesuai Keinginan Anda <br> Enjoy Your Meal</p>
    </div>
</div>
<!-- Akhir Jumbotron -->

<!-- Navbar -->
<nav class="navbar navbar-expand-lg  bg-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="a../dashboard/halaman_kasir.php"><strong>KOTUSA</strong> MART</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link mr-4" href="../dashboard/halaman_kasir.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-4" href="daftar_menu.php">DAFTAR MENU</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-4" href="pesanan_kasir.php">PESANAN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Akhir Navbar -->

<!-- Menu -->
<div class="container">
    <div class="judul-pesanan mt-5">
        <h3 class="text-center font-weight-bold">DATA PESANAN PELANGGAN</h3>
    </div>
    <table class="table table-bordered" id="example">
        <thead class="thead-light">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">ID Pemesanan</th>
                <th scope="col">Nama Pesanan</th>
                <th scope="col">Harga</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Subharga</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1; 
            $totalbelanja = 0;
            $id_pemesanan = $_GET['id']; // Pastikan bahwa 'id' diambil dari URL
            $ambil = $koneksi->query("SELECT pembelian.id_pembelian AS id, produk.merek, produk.harga, pembelian.jumlah
                                      FROM pembelian 
                                      JOIN produk ON pembelian.id_produk = produk.id_produk
                                      WHERE pembelian.id_pemesanan='$id_pemesanan'");
            
            if ($ambil === false) {
                echo "Error: " . $koneksi->error;
            } else {
                while ($pecah = $ambil->fetch_assoc()) {
                    $subharga1 = $pecah['harga'] * $pecah['jumlah'];
            ?>
            <tr>
                <th scope="row"><?php echo $nomor; ?></th>
                <td><?php echo $pecah['id']; ?></td>
                <td><?php echo $pecah['merek']; ?></td>
                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                <td><?php echo $pecah['jumlah']; ?></td>
                <td>Rp. <?php echo number_format($subharga1); ?></td>
            </tr>
            <?php 
                    $nomor++; 
                    $totalbelanja += $subharga1;
                }
            } 
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total Bayar</th>
                <th>Rp. <?php echo number_format($totalbelanja) ?></th>
            </tr>
        </tfoot>
    </table><br>
    
    <form method="POST" action="">
        <a href="pesanan_kasir.php" class="btn btn-success btn-sm">Kembali</a>
        <a href="print.php?id=<?php echo $_GET['id']; ?>" class="btn btn-success btn-sm">Invoice</a>        
        <button class="btn btn-primary btn-sm" name="bayar">Konfirmasi Pembayaran</button>
    </form>  
    <?php 
    if (isset($_POST["bayar"])) {
        $koneksi->query("UPDATE pembelian SET status='sudah bayar' WHERE id_pemesanan='$id_pemesanan'");
        echo "<script>alert('Pesanan Telah Dibayar !');</script>";
        echo "<script>location='pesanan_kasir.php'</script>";
    }
    ?>
</div>
<!-- Akhir Menu -->

<!-- Awal Footer -->
<hr class="footer">
<div class="container">
    <div class="row footer-body">
        <div class="col-md-6">
        <div class="copyright">
            <strong>Copyright</strong> <i class="far fa-copyright"></i> 2020 -  Designed by Alfirdaus&Rinaldo</p>
        </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
        <div class="icon-contact">
        <label class="font-weight-bold">Follow Us </label>
        <a href="#"><img src="images/icon/fb.png" class="mr-3 ml-4" data-toggle="tooltip" title="Facebook"></a>
        <a href="#"><img src="images/icon/ig.png" class="mr-3" data-toggle="tooltip" title="Instagram"></a>
        <a href="#"><img src="images/icon/twitter.png" class="" data-toggle="tooltip" title="Twitter"></a>
    </div>
        </div>
    </div>
</div>
<!-- Akhir Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldvP8rIdj0QGRH7ClJk5nB2UjFM9BLF8RBXPzMC" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOUenIrok4Pb2Ewo7cmDA6t6ECu6I9gT1G5MDA6DLew6j3A" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="admin.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</body>
</html>
