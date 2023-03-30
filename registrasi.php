<?php
include 'function.php';
if(isset($_POST["registrasi"])){
    if(register($_POST)>0){
        echo"
        <script>
        alert('userbaru telah ditambahkan ');
        </script>
        ";
    }
    else{
        mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>resgitrasi</title>
</head>
<body>
    <a href="index.php">kembali</a>
    <form action="" method="post">

        <ul>
            <label>
            Email
            <input type = "email" name = "email" required>
        </label>
    </ul>
    <ul>
        <label>
            password
            <input type = "password" name = "password" required>
        </label>
    </ul>
    <ul>
        
        <label>
            konfirmasi
            <input type = "password" name = "password2" required> 
        </label>
    </ul>
    <ul>
        <button type="submit" name="registrasi">registrasi</button>
    </ul>
</form>
</body>
</html>