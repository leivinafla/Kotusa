<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Login</title>
        <style>
            *{
                margin: 0;
                padding: 0;
                outline: 0;
                font-family: 'Open Sans', sans-serif;
            }
            body{
                height: 100vh;
                background-image: url(../img/login.jpeg);
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            .container{
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                padding: 20px 25px;
                width: 300px;

                background-color: rgba(0,0,0,.7);
                box-shadow: 0 0 10px rgba(255,255,255,.3);
            }
            .container h1{
                text-align: left;
                color: #fafafa;
                margin-bottom: 30px;
                text-transform: uppercase;
                border-bottom: 4px solid #2979ff;
            }
            .container label{
                text-align: left;
                color: #90caf9;
            }
            .container form input{
                width: calc(100% - 20px);
                padding: 8px 10px;
                margin-bottom: 15px;
                border: none;
                background-color: transparent;
                border-bottom: 2px solid #2979ff;
                color: #fff;
                font-size: 20px;
            }
            .container form button{
                width: 100%;
                padding: 5px 0;
                border: none;
                background-color:#2979ff;
                font-size: 18px;
                color: #fafafa;
            }
        </style>
    </head>
   
    <body>
        <div class="container">
            <h1>Login</h1>
            <form method="POST" action="index.php">
                <label>Username</label><br>
                <input type="text" name="username" required><br>
                <label>Password</label><br>
                <input type="password" name="password" required><br>
                <button type="submit" name="proses">Log in</button>
            </form>
        </div>     
    </body>
</html>

<?php
if(isset($_POST['proses'])) {
    require '../koneksi.php'; // Memuat file konfigurasi database

    $username = $_POST['username'];
    $password = $_POST['password'];

    $cek_data = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
    $hasil = mysqli_fetch_array($cek_data);
    $level = $hasil['level'];
    $row = mysqli_num_rows($cek_data);

    if ($row > 0) {
        session_start();   
        $_SESSION['login_user'] = $username;
        $_SESSION['level'] = $level;

        if ($level == 'kasir') { 
            header('location: ../dashboard/halaman_kasir.php');
        } elseif ($level == 'pembeli') { 
            header('location: ../dashboard/halaman_pembeli.php'); 
        }
        exit; // Tambahkan exit untuk mencegah eksekusi lebih lanjut
    } else {
        header("location: ../admin/index.php");
        exit; // Tambahkan exit untuk mencegah eksekusi lebih lanjut
    }
}
?>