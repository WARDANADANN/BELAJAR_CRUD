<?php
    $conn = mysqli_connect("localhost","root","","belajar");
    function query($query)
    {
        global $conn;
        $rows=[];
        $data = mysqli_query($conn,$query);
        while($result = mysqli_fetch_assoc($data)){
            $rows[]=$result;
        }
        return $rows; 
    }

    function tambah($post){
        global $conn;
        $nama =htmlspecialchars($post["nama"]);
        $nim =htmlspecialchars($post["nim"]);
        $prodi =htmlspecialchars($post["prodi"]);
        $foto = upload();
        if(!$foto){
            return false;
        }
        $query = "INSERT INTO student (nama,nim,prodi,foto) values ('$nama','$nim','$prodi','$foto');";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function delete($data){
        global $conn;
        $query="DELETE FROM student WHERE (id = $data)";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }

    function edit($post){
        global $conn;
        $id=$post["id"];
        $nama =htmlspecialchars($post["nama"]);
        $nim =htmlspecialchars($post["nim"]);
        $prodi =htmlspecialchars($post["prodi"]);


        $fotolama =$post["fotolama"];
        if($_FILES["foto"]["error"]===4){
            $foto=$fotolama;
        }else{
            $foto=upload();
        }
        $query = "UPDATE student set nama ='$nama', nim='$nim',prodi='$prodi',foto='$foto' where (id= $id);";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
    function cari($cari){
        $sytax="SELECT * FROM student WHERE id LIKE '%$cari%' OR nama LIKE '%$cari%' OR nim LIKE '%$cari%' OR prodi LIKE '%$cari%'";
        return query($sytax);
    }

    function upload(){
        $namaFoto=$_FILES['foto']['name'];
        $tmp_name=$_FILES['foto']['tmp_name'];
        $errorFoto=$_FILES['foto']['error'];
        $ukuranFoto=$_FILES['foto']['size'];
        //cek apakah ada foto yg diupload atau tidak ,kode error = "4" menunjukan data kosong
        if($errorFoto === 4){
            echo"
            <script>alert('pilih gambar terlebih dahulu')</script>
            ";
            return false;
        }

        //memastikan yang diupload adalah gambar
        $sayamauekstensi =['jpg','png','jpeg','jfif'];
        $ekstensiGambar = explode('.',$namaFoto); //ambil var nama foto kalau ketemu titik maka pecah sebagai array 
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        //end artinya mengambil array yang paling akhir.
        //strtolower artinya mengubah semua data menjadi lowercase.
        
        //cek apakah ekstensi gambar yang diupload sesuai dengan yang saya mau.
        if(!in_array($ekstensiGambar,$sayamauekstensi)){ //fungsi in_array (A,B)berfungsi untuk mencari A di dalam B
            echo"
            <script>alert('yang anda upload bukan gambar')</script>
            ";
            return false;
        }

        //cek ukuran file sesuai dengan yang saya bataskan
        if($ukuranFoto>1000000){
            echo"
            <script>alert('ukuran file terlalu besar')</script>
            ";
            return false;
        }

        //generate nama yang random
        $namabaru =uniqid();
        $namabaru.=".";
        $namabaru.=$ekstensiGambar;
        //upload gambar
        move_uploaded_file($tmp_name,'IMG/'.$namabaru);
        return $namabaru;
    }

    function register($data){
        global $conn;
        $username = strtolower(stripslashes($data['username'])); 
        $password = mysqli_real_escape_string($conn,$data["password"]);//untuk memungkinkan user memasukan dengan tanda kutip
        $password2 = mysqli_real_escape_string($conn,$data["password2"]);//untuk memungkinkan user memasukan dengan tanda kutip
        //cek password
        if($password!== $password2){
            echo"
            <script>
            alert('konfirmasi password tidak sesuai');
            </script>
            ";
            return false;
        }

        // enkripsi password
        $password = password_hash($password,PASSWORD_DEFAULT);

        // cek username yangtelah ada\
        $result= mysqli_query($conn,"select * from data where username='$username'");
        if(mysqli_fetch_assoc($result)){
            echo"
            <script>
            alert('GAGAL INPUT username telah ADA');
            </script>
            ";
            return false;
        }
        $query="insert into data (username,pasword) values
        ('$username','$password')";
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }
?>

