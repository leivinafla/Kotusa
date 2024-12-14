<?php
include '../koneksi.php';

// Menggunakan objek $db dari kelas Database
$db = new Database("localhost", "root", "", "kotusa");

$t_kategori = $db->getAll("SELECT * FROM kategori");
$t_admin = $db->getAll("SELECT id_admin, username FROM admin WHERE level = 'kasir'");

// Pengecekan apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  try{
    // Mendapatkan nilai dari form 
    $merek = isset($_POST['merek']) ? $_POST['merek'] : null;
    $harga = isset($_POST['harga']) ? $_POST['harga'] : null;
    $stok = isset($_POST['stok']) ? $_POST['stok'] : null;
    $kategori_id = isset($_POST['kategori']) ? $_POST['kategori'] : null;
    $id_admin = isset($_POST['admin']) ? $_POST['admin'] : null;
    $nama_file = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : null;
    $source = isset($_FILES['gambar']['tmp_name']) ? $_FILES['gambar']['tmp_name'] : null;
    $folder = './gambar/';

    // Pengecekan validitas data
    if (empty($merek) || empty($harga) || empty($stok) || empty($kategori_id) || empty($id_admin) || empty($nama_file) || empty($source)) {
      throw new Exception("Form harus diisi dengan lengkap.");
    }

    // Pindahkan file yang diupload ke folder upload
    if (!move_uploaded_file($source, $folder.$nama_file)) {
      throw new Exception("Gagal mengunggah gambar.");
    }

    // Insert data ke database
    $pdoConnection = $db->getPDOConnection();
    $stmt = $pdoConnection->prepare("INSERT INTO produk (merek, harga, stok, fid_kategori, gambar, id_admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$merek, $harga, $stok, $kategori_id, $nama_file, $id_admin]);

    // Menampilkan pesan hasil
    if ($stmt->rowCount() > 0) {
      echo "Data Berhasil Ditambahkan";
      header("Location: Tproduk.php");
      exit(); // Keluar dari skrip setelah melakukan redirect
    } else {
      echo "Gagal menambahkan data.";
    }

  } catch (PDOException $e) {
    die("Error: " .$e->getMessage());
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Form Menarik</title>
<style type="text/css">
.form-style-3 {
  max-width: 450px;
  font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-3 label {
  display: block;
  margin-bottom: 10px;
}
.form-style-3 label > span {
  float: left;
  width: 100px;
  color: #F072A9;
  font-weight: bold;
  font-size: 13px;
  text-shadow: 1px 1px 1px #fff;
}
.form-style-3 fieldset {
  border-radius: 10px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  margin: 0px 0px 10px 0px;
  border: 1px solid #E0FFFF;
  padding: 20px;
  background: #E0FFFF;
  box-shadow: inset 0px 0px 15px #FFE5E5;
  -moz-box-shadow: inset 0px 0px 15px #FFE5E5;
  -webkit-box-shadow: inset 0px 0px 15px #FFE5E5;
}
.form-style-3 fieldset legend {
  color: #FFA0C9;
  border-top: 1px solid #E0FFFF;
  border-left: 1px solid #E0FFFF;
  border-right: 1px solid #E0FFFF;
  border-radius: 5px 5px 0px 0px;
  -webkit-border-radius: 5px 5px 0px 0px;
  -moz-border-radius: 5px 5px 0px 0px;
  background: #E0FFFF;
  padding: 0px 8px 3px 8px;
  box-shadow: -0px -1px 2px #E0FFFF;
  -moz-box-shadow: -0px -1px 2px #E0FFFF;
  -webkit-box-shadow: -0px -1px 2px #E0FFFF;
  font-weight: normal;
  font-size: 12px;
}
.form-style-3 textarea {
  width: 250px;
  height: 100px;
}
.form-style-3 input[type=text],
.form-style-3 select {
  background: #96E9C6;
  border: 1px solid #E0FFFF;
  padding: 5px 15px 5px 15px;
  color: #000000;
  box-shadow: inset -1px -1px 3px #E0FFFF;
  -moz-box-shadow: inset -1px -1px 3px #E0FFFF;
  -webkit-box-shadow: inset -1px -1px 3px #E0FFFF;
  border-radius: 3px;
  border-radius: 3px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;  
  font-weight: bold;
}
.form-style-3 .required {
  color: green;
  font-weight: normal;
}
.form-style-3 input[type=submit] {
  background-color: #96E9C6;
  color: #fff;
  padding: 5px 145px; /* Sesuaikan panjang tombol */
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.form-style-3 input[type=button] {
  background-color: #96E9C6;
  color: #fff;
  padding: 5px 140px; /* Sesuaikan panjang tombol */
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.center {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  flex: 1 0 100%;
}
</style>
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body style="background-color: #d5f0f3">
  <section class="main">
    <div class="main-top" style="background: #AAD7D9">
      <p>SELAMAT DATANG DI KOTUSA MART!</p>
    </div>
    <div class="center">
      <div class="main-body">
        <br><br><br>
        <div class="job_details">
          <div class="text">
            <div class="form-style-3">
              <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                  <legend><font color="black">Data Produk</legend>
                  <label for="field1">
                    <span><font color="black">Kategori<span class="required">*</span></span>
                    <select class="required" name="kategori">
                      <option value="" disabled selected>Pilih...</option>
                      <?php 
                      foreach ($t_kategori as $kategori) {
                        echo "<option value='" . $kategori['id'] . "'>" . $kategori['kategori'] . "</option>";
                      } ?>
                    </select>
                  </label>
                  <label for="field1">
                    <span><font color="black">Admin<span class="required">*</span></span>
                    <select class="required" name="admin">
                      <option value="" disabled selected>Pilih...</option>
                      <?php 
                      foreach ($t_admin as $admin) {
                        echo "<option value='" . $admin['id_admin'] . "'>" . $admin['username'] . "</option>";
                      } ?>
                    </select>
                  </label>
                  <label for="field1"><span><font color="black">Merk<span class="required">*</span></span><input type="text" class="input-field" name="merek" value="" /></label>
                  <label for="field1"><span><font color="black">Harga<span class="required">*</span></span><input type="text" class="input-field" name="harga" value="" /></label>
                  <label for="field1"><span><font color="black">Stok<span class="required">*</span></span><input type="text" class="input-field" name="stok" value="" /></label>
                  <label for="field1"><span><font color="black">Gambar<span class="required">*</span></span><input type="file" name="gambar" accept="image/*"></label>
                  <br>
                  <label><input type="submit" name="submit" value="Save" style="color: black" /></label>
                  <label><input type="button" value="Kembali" onclick="location.href='Tproduk.php'" style="color: black" /></label>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>