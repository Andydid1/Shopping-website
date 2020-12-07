<?php
session_start();
$u_nm = $_POST['u_nm'];
$u_pw = $_POST['u_pw'];
$dbc = mysqli_connect('localhost','Andy','1116','test_db');
$query = "select * from user_info where u_name = '{$u_nm}'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if($row['u_pw']==sha1($u_pw)){
    $_SESSION['login'] = $u_nm;
    header("Location: inventory.php");
}else{
    $_SESSION['err'] = 1;
    header("Location: login.php");
    exit;
}