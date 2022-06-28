<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php

    //Include file Config, untuk koneksikan ke database
    include "config.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from calon_mahasiswa where id=$id";
        $hasil=mysqli_query($db,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $nama=input($_POST["nama"]);
        $alamat=input($_POST["alamat"]);
        $jenis_kelamin=input($_POST["jenis_kelamin"]);
        $agama=input($_POST["agama"]);
        $sekolah_asal=input($_POST["sekolah_asal"]);

        //Query update data pada tabel Calon_mahasiswa
        $sql="update calon_mahasiswa set
        nama='$nama',
        alamat='$alamat',
        jenis_kelamin='$jenis_kelamin',
        agama='$agama',
        sekolah_asal='$sekolah_asal'
        where id=$id";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($db,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Masukan Nama" required/>
            
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required><?php echo $data['alamat']; ?></textarea>
            
        </div>
        <div class="form-group">
            <label>Jenis Kelamin:</label>
            <input type="text" name="jenis_kelamin" class="form-control" value="<?php echo $data['jenis_kelamin']; ?>" placeholder="Jenis Kelamin" required />

        </div>
        <div class="form-group">
            <label>Agama:</label>
            <input type="text" name="agama" class="form-control" value="<?php echo $data['agama']; ?>" placeholder="Agama" required/>
        </div>
        <div class="form-group">
            <label>Asal Sekolah:</label>
            <input type="text" name="sekolah_asal" class="form-control" value="<?php echo $data['sekolah_asal']; ?>" placeholder="Asal Sekolah" required/>
        </div>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>