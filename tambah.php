<?php
session_start();
if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;}

include 'controler.php';
if(isset($_POST['submit']))
{
    if(tambah($_POST)>0){
    echo"
    <script>
    alert('data berhasil diinput');
    document.location.href='index.php';
    </script>
    ";

    }else{
    echo"
    <script>
    alert('data gagal diinput');
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

        <label>
            nama
            <input type="text" name="nama" required autofocus autocapitalize="on">
        </label>
        <label>
            nim
            <input type="text" name="nim" required autofocus>
        </label>
        <label>
            prodi
            <input type="text" name="prodi" required autocomplete="">
        </label>
        <label>
            foto
            <input type="file" name="foto" required>
        </label>
        <button type="submit" name="submit">TAMBAHKAN</button>
    </form>
</body>

</html>