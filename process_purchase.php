<?php
    session_start();
    if(!isset($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }
    $u_name = $_SESSION['login'];
    // Check input validity
    $p_id = $_GET['p_id'];
    $amount = $_POST['amount'];
    if($amount==''){
        $_SESSION['err'] = 1;
        header("Location: purchase.php?p_id={$p_id}");
        exit;
    }
    $arr = str_split($amount,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: purchase.php?p_id={$p_id}");
            exit;
        }
    }
    $amount = (int)$amount;
    if($amount <= 0){
        $_SESSION['err'] = 1;
        header("Location: purchase.php?p_id={$p_id}");
        exit;
    }
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    $query = "select * from stored_in where p_id = {$p_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $storage = $row['st_num'];
    if($storage < $amount){
        $_SESSION['err'] = 1;
        header("Location: purchase.php?p_id={$p_id}");
        exit;
    }
    // Make the purchase
    // Get info about user
    $query = "select u_id, balance, a_id from user_info where u_name = '{$u_name}';";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $balance = $row['balance'];
    $u_id = $row['u_id'];
    $a_id = $row['a_id'];
    if(empty($row['a_id'])){
        header("Location: set_address.php");
        exit;
    }
    // Get info about product
    $query = "select * from product where p_id = {$p_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $unit_price = $row['unit_price'];
    $sum = $amount * $unit_price;
    if($sum > $balance){
        $_SESSION['err'] = 1;
        header("Location: purchase.php?p_id={$p_id}");
        exit;
    }
    // Modify storage
    $remain_storage = $storage - $amount;
    $query = "update stored_in set st_num = {$remain_storage} where p_id = {$p_id};";
    mysqli_query($dbc, $query);
    // Modify balance
    $remain_balance = $balance - $sum;
    $query = "update user_info set balance = {$remain_balance} where u_name = '{$u_name}';";
    mysqli_query($dbc, $query);
    // Modify order
    $date = date("Y-m-d");
    $o_year = (int)substr($date,0,4);
    $o_month = (int)substr($date,5,2);
    $o_day = (int)substr($date,8,2);
    $query = "insert into orders (p_id, u_id, o_year, o_month, o_day, o_amount) values ({$p_id},{$u_id},{$o_year},{$o_month},{$o_day},{$amount});";
    mysqli_query($dbc, $query);
    // Success
    header("Location: purchase_success.html");
    