<?php
    session_start();
    $u_pw1 = $_POST['u_pw'];
    $u_pw2 = $_POST['u_pw2'];
    if($u_pw1 != '' && $u_pw2 != '' && $u_pw1 == $u_pw2){
        $u_nm = $_POST['u_nm'];
        $u_pw = sha1($u_pw1);
        include_once "mysql_info.php";
        $dbc = mysqli_connect(constant("DB_H"),
        constant("DB_U"),constant("DB_P"),constant("DB_DB"));
        $query = "INSERT INTO user_info (u_name, u_pw, balance) VALUES ('{$u_nm}','{$u_pw}',1000);";
        mysqli_query($dbc,$query);
        $nquery = "SELECT * from user_info where u_name = '{$u_nm}';";
        $result = mysqli_query($dbc,$nquery);
        $row = mysqli_fetch_array($result);
        $_SESSION['login'] = $row['u_name']; 
        header("Location: inventory.php");
    }else{
        $_SESSION['err'] = 1;
        header("Location: sign_up.php");
        exit;
    }
?>