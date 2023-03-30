<?php
session_start();
if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;}

include 'controler.php';
//menangkap variabel get id
$id=$_GET['id'];
//menampilkan data dari database
$mahasiswa= query("SELECT * FROM student where (id = $id)");


if(isset($_POST['submit']))
{
   if(edit($_POST)>0){
    echo"
    <script>
    alert('data berhasil diedit');
    document.location.href='index.php';
    </script>
    ";
    }else{
    echo"
    <script>
    alert('data gagal diedit');
    document.location.href='index.php';
    </script>
    ";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            background-color: aqua;
            width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 50px;
            height: 20rem;
            justify-content: space-evenly;
        }

        body button a {
            text-decoration: none;
            color: black;
            position: absolute;
        }

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>

<body style="text-transform: capitalize;">
    <a href="index.php"><button>kembali</button></a>
    <form action="" method="post" enctype="multipart/form-data">
        <?php
            foreach($mahasiswa as $mhs) :
                ?>
        <label>
            <input type="hidden" name="fotolama"value=<?= $mhs['foto']; ?>>
            <input type = "hidden" name = "id" value=<?= $mhs['id']; ?>>
        </label>
        <label>
            nama
            <input type="text" name="nama" required autofocus autocapitalize="on" value=<?= $mhs['nama']; ?>>
        </label>
        <label>
            nim
            <input type="text" name="nim" required autofocus value=<?= $mhs['nim']; ?>>
        </label>
        <label>
            prodi
            <input type="text" name="prodi" required autocomplete="" value=<?= $mhs['prodi']; ?>>
        </label>
        <label>
            
            <img src="IMG/<?= $mhs['foto']; ?>" width="50px" alt=""  pointer><br>
            <input type="file" name="foto">
        </label>
        <?php
            endforeach;
        ?>
        <button type="submit" name="submit">UBAH</button>
    </form>
</body>

</html>