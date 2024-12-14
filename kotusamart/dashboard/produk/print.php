
<?php 
include('../koneksi.php');
session_start();

if(!isset($_SESSION['login_user'])) {
    header("location: ../admin/index.php");
    exit;
} else {

    // Check if id is set in the URL
    if (isset($_GET['id'])) {
        $id_pemesanan = $_GET['id'];
    } else {
        // If not set, redirect or handle the error
        echo "ID pemesanan tidak ditemukan.";
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
          <?php $nomor=1; ?>
          <?php $totalbelanja = 0; ?>
          <?php 
               $ambil = $koneksi->query("SELECT * FROM pembelian JOIN produk ON pembelian.id_produk = produk.id_produk WHERE pembelian.id_pemesanan='$id_pemesanan'");
           ?>
           <?php while ($pecah = $ambil->fetch_assoc()) { ?>
           <?php $subharga1 = $pecah['harga'] * $pecah['jumlah']; ?>
          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $pecah['id_pemesanan']; ?></td>
            <td><?php echo $pecah['merek']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>Rp. <?php echo number_format($subharga1); ?></td>
          </tr>
          <?php $nomor++; ?>
          <?php $totalbelanja += $subharga1; ?>
          <?php } ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="5">Total Bayar</th>
            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
    </div>
    <!-- Akhir Menu -->
    <script>
        window.print();
    </script>
</body>
</html>
<?php } ?>