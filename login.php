<?php
include'controler.php';
session_start();

if(isset($_COOKIE['id']) && isset($_COOKIE['username'])){
    echo"
    <script>alert('hallo');</script>
    ";
    $id=$_COOKIE['id'];
    $username= $_COOKIE['username'];
    $result = mysqli_query($conn,"SELECT username from data where userid = $id");
    $key= mysqli_fetch_assoc($result);
    if($username === hash("sha256",$key['username'])){
        $_SESSION['login']= true; 
    }
}

if(isset($_SESSION['login'])){
header("Location: index.php");
exit;}
    if(isset($_POST['login'])){
        //mengambil semua data user dari database
        $username=$_POST['username'];
        $result = mysqli_query($conn,"select*from data where username= '$username'");
        $password=$_POST['password'];

    if(mysqli_num_rows($result)===1){
        //username telah masuk
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password,$row['pasword'])){
            $_SESSION['login']=true;//cek session

            if(isset($_POST['remember'])){//cek cookie
                setcookie('id',$row['userid'], time()+60);
                setcookie('username',hash("sha256",$row['username']),time()+60);
            }
            header("Location: index.php");
            
            exit;
        }
    }
        echo"
        <script>
        alert('username atau password salah')
        </script>
        ";
        
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <a href="registrasi.php"> sign up</a>
    <form action="" method="post">
        <ul>
            <li><label>
                username
                <input type = "text" name = "username" required>
            </label></li>
            <li><label>
                password
                <input type = "password" name = "password" required>
            </label></li>
            <li><label>
                remember
                <input type = "checkbox" name = "remember">
            </label></li>
            <li><button type="submit" name="login">login</button></li>
        </ul>
    </form>
</body>
</html>