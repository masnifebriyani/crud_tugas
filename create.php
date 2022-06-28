<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php
        //Include File Config , Untuk Koneksi Ke Database
        include "config.php";

        //Fungsi untuk mencegah inputan karakter tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama=input($_POST["nama"]);
            $alamat=input($_POST["alamat"]);
            $jenis_kelamin=input($_POST["jenis_kelamin"]);
            $agama=input($_POST["agama"]);
            $sekolah_asal=input($_POST["sekolah_asal"]);

        //Query input menginput data ke dalam tabel mahasiswa
        $sql="insert into calon_mahasiswa (nama, alamat, jenis_kelamin, agama, sekolah_asal) values('$nama', '$alamat', '$jenis_kelamin', '$agama', '$sekolah_asal')";

        //Mengeksekusi/Menjalankan query diatas
        $hasil=mysqli_query($db,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query di atas
        if ($hasil) {
            header("Location:index.php");

        }

        else{
            echo " <div class='alert alert-danger'> Data Gagal disimpan. </div> ";
        }
    }
    ?>
    <h2>Input Data</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
    </div>

    <div class="form-group">
        <label>Alamat:</label>
        <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat" required />
    </div>

    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <input type="text" name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin" required />
    </div>

    <div class="form-group">
        <label>Agama:</label>
        <input type="text" name="agama" class="form-control" placeholder="Agama" required />
    </div>

    <div class="form-group">
        <label>Sekolah Asal</label>
        <input type="text" name="sekolah_asal" class="form-control" placeholder="Sekolalh Asal" required />
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
    </div>
</body>
</html>