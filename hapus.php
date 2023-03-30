<?php
session_start();
if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;}

    include 'controler.php';
    if(delete($_GET['id'])>0){
        alert("berhasil menghapus data","index.php");
    } else{
        echo "
        <script>
            alert('data berhasil dihapus');
            document.location.href='index.php';
        </script>
        ";
        
    }
?>