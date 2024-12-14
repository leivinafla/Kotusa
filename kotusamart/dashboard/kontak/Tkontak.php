<?php
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: ../login");
    exit(); // Terminate script execution after the redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Job Dashboard | By Code Info</title>
  <link rel="stylesheet" href="../css/style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>
    <!-- dari sini -->
  <div class="container">
    <nav>
      <div class="navbar">
        <div class="logo">
          <img src="../img/kupu.jpeg" alt="">
          <h1>TOKO BUNDA</h1>
        </div>
        <ul>
          <li><a href="../dashboard.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Dashboard</span>
          </a>
          </li>
          <li><a href="../produk/Tproduk.php">
            <i class="fas fa-box"></i>
            <span class="nav-item">Produk</span>
          </a>
          </li>
          <li><a href="../karyawan/Tkaryawan.php">
            <i class="fas fa-user"></i>
            <span class="nav-item">Karyawan</span>
          </a>
          </li>
          <li><a href="../kontak/Tkontak.php">
            <i class="fas fa-envelope"></i>
            <span class="nav-item">Contact</span>
          </a>
          </li>
          <li><a href="#" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Logout</span>
          </a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="main">
      <div class="main-top">
        <p>SELAMAT DATANG DI TOKO BUNDA TERCINTA!</p>
      </div>
      <div class="main-body">
        <h1>TOKO BUNDA</h1>
  

      <div class="job_card">
        <div class="">
          <div class="img">
            <i class=""></i>
            <div class="text">
          </div>
        </div>
       
      </div>
      
     <div class="content">
        <div class="jarak">
            <!-- kiri -->
            <div class="kiri">
                <!-- blog -->
                <div class="border">
                    <div class="jarak">
                        <h3>INFORMASI</h3>
                        <table border="1">
                            <td><i class="fas fa-phone"></i></td>
                            <td><p align="justify">082132969051</p></td>
                            <tr>
                            <td><i class="fas fa-home"></i></td>
                            <td><p align="justify">JL. DR. Radjiman 
                            Widyodiningrat.jl kp. Pulo Jahe,
                            Jatinegara, Kec. Cakung, Kota Jakarta
                            Timur, DKI Jakarta</p></td>
                            </tr>
                            <tr>
                            <td><i class="fas fa-globe"></i></td>
                            <td><p align="justify">www.smkn71jakarta</p></td>
                            </tr>
                        </table>
                    </div></div>
                </div>
    </div>
    </div>
    </section>
  </div>

</body>
</html>