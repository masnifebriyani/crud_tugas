<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <h4>\UAS CRUD By Masni</h4>
<?php

    include "config.php";

    //Cek apakah ada nilai dari method GET dengan nama id
    if (isset($_GET['id'])) {
        $id=htmlspecialchars($_GET["id"]);

        $sql="DELETE FROM calon_mahasiswa WHERE id='$id' ";
        $hasil=mysqli_query($db,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


    <table class="table table-primary table-striped">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Agama</th>
            <th>Sekolah Asal</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>
        <?php
        include "config.php";
        $sql="select * from calon_mahasiswa order by id desc";

        $hasil=mysqli_query($db,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["nama"]; ?></td>
                <td><?php echo $data["alamat"];   ?></td>
                <td><?php echo $data["jenis_kelamin"];   ?></td>
                <td><?php echo $data["agama"];   ?></td>
                <td><?php echo $data["sekolah_asal"];   ?></td>
                <td>
                    <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Update</a>
                    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-success" role="button">Tambah Data</a>

</div>
</body>
</html>