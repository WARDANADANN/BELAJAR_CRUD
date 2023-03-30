<?php
    session_start();
    $_SESSION=[];
    session_unset();
    session_destroy();

    //hapus cookie
    setcookie('id','false',time()-60);
    header("Location: login.php");


?>