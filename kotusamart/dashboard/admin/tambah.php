<!DOCTYPE html>
<html>
<head>
    <title>tambah data admin</title>
    <link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>

<div class="kotak_login">
    <p class="tulisan_login">Tambah Data Admin</p>
 
    <form method="POST" action="tambah_aksi.php">
        <label>ID ADMIN</label>
        <input type="text" name="id_admin" class="form_login" placeholder="id admin">

        <label>USERNAME</label>
        <input type="text" name="username" class="form_login" placeholder="username">
        
        <label>PASSWORD</label>
        <input type="text" name="password" class="form_login" placeholder="password">

        <label>LEVEL</label>
        <select name="level" class="form_login">
               <option value="kasir">Kasir</option>
               <option value="pembeli">Pembeli</option>
        </select>

        <input type="submit" name="submit" class="tombol_login" value="SIMPAN">
        <br/>
        <br/>
        <center>
            
            <a class="link" href="../admin/admin.php">KEMBALI</a>
        </center>
    </form>
    
</div>
</body>
</html>