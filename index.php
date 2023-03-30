<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;}


    include 'controler.php';
    $mahasiswa= query("SELECT * FROM student order by id asc");
    if(isset($_POST['submit'])){
        tambah($_POST);
    }

        if(isset($_POST['cari'])){
            $mahasiswa= cari($_POST['cari']);
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="logout.php" onclick="return confirm('APAKAH YAKIN INGIN LOGOUT')">logout</a>
    <h1 class="text-3xl font-bold">DATA MAHASISWA</h1>
    <a href="tambah.php"><button>TAMBAHKAN DATA</button></a>
    <!-- menampilkan data dalam tabel -->
    <form action="" method="post">
    <label>
        <input type = "search" name = "cari" autocomplete="off" autofocus>
        <button>cari</button>
    </label>
    </form>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Nim</th>
                <th>Prodi</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <!-- body tabel -->
        <?php
            foreach($mahasiswa as $mhs) :
        ?>
        <tbody>
            <tr style="text-transform: capitalize; text-align: center;">
                <td><?= $mhs['name']; ?></td>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['prodi']; ?></td>
                <td><img src="IMG/<?=$mhs['foto'] ?>" alt="" width="100px"></td>
                <td>
                    <a href="hapus.php?id=<?= $mhs['id']; ?>" onclick="return confirm('apakah anda yakin ingin menghapus data <?= $mhs['nama']; ?>')">hapus</a> |
                    <a href="edit.php?id=<?= $mhs['id']; ?>">edit</a>         
                </td>
            </tr>
        </tbody>
        <?php
            endforeach;
        ?>
    </table>
</body>

</html>