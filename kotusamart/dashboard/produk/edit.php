<?php
include '../koneksi.php';

if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk'];
    $sql = "SELECT * FROM produk WHERE id_produk=$id";
    $row = $db->getITEM($sql);
}

if (isset($_POST['simpan'])){
    //inisialisasi
    $kategori = $_POST['kategori'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

//update data
    $sql = "UPDATE produk SET fid_kategori='$kategori', merek='$merek', harga='$harga', stok='$stok' WHERE id_produk=$id";
    $db->runSQL($sql);
    // Mengalihkan halaman kembali ke p_select.php
    header("location:Tproduk.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PRODUK</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #343a40;
        }

        hr {
            border: 1px solid #ced4da;
            margin: 20px 0;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        .form-group.w-50 {
            width: 50%;
            display: inline-block;
        }

        select.form-control {
            height: 38px;
        }

        .btn-cancel {
        background-color: #6c757d;
        color: #fff;
        padding: 10px 280px; /* Sesuaikan panjang tombol */
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
    }
    .btn-simpan {
        background-color: #6c757d;
        color: #fff;
        padding: 10px 285px; /* Sesuaikan panjang tombol */
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-simpan:hover {
        background-color: #5a6268;
    }
    </style>
</head>

<div class="mt-3">
    <div class="container">
        <h3 style="font-family:Georgia, 'Times New Roman', Times, serif;">Edit Produk</h3>
        <hr>
        <?php
        $t_kategori = $db->getALL("SELECT * FROM kategori");
        ?>
        <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group w-50 mt-3">
                    <label for="">Kategori</label>
                    <select class="form-control" name="kategori">
                        <?php foreach ($t_kategori as $isi) : ?>
                            <option reqired value="<?php echo $isi['id'] ?>"><?php echo $isi['kategori'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Merek</label>
                    <input type="text" name="merek" required value="<?php echo $row['merek'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Harga</label>
                    <input type="text" name="harga" required value="<?php echo $row['harga'] ?>" class=" form-control">
                </div>

                <div class="form-group w-50 mt-3">
                    <label for="">Stok</label>
                    <input type="text" name="stok" required value="<?php echo $row['stok'] ?>" class=" form-control">
                </div>
                <label for="gambar">Foto Menu</label>
                <input type="file" class="form-control-file border" id="gambar" name="gambar"></div>
<div class="form-group w-50 mt-3">
    <button type="submit" name="simpan" value="simpan" class="btn btn-simpan">Save</button>
</div>

<div class="form-group w-50 mt-3">
    <button type="button" onclick="location.href='../produk/Tproduk.php';" class="btn btn-cancel">Cancel</button>
</div>
            </form>
        </div>
    </div>
</div>
</html>

<?php
if (isset($_POST['simpan'])) {
    //Inisialisasi
    $kategori = $_POST['kategori'];
    $merek = $_POST['merek'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    

    //Periksa apakah ada file gambar yang diunggah
    if($_FILES['gambar']['name'] !=''){
        $nama_file = $_FILES['gambar']['name'];
        $nama_file_tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($nama_file_tmp, "./gambar/" . $nama_file);
}else{
    //gunakan nama file gambar lama jjika tidak ada gambar yang diunggah
    $nama_file = $_POST['gambar_lama'];
}
    //update data
    $sql = "UPDATE produk SET fid_kategori='$kategori', merek='$merek', harga='$harga', stok='$stok', gambar='$nama_file' WHERE id_produk=$id";
    $db->runSQL($sql);
    // Mengalihkan halaman kembali ke p_select.php
    header("location:Tproduk.php");
}
?>


