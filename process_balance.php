<?php
    session_start();
    if(empty($_SESSION['login'])){
        $_SESSION['err'] = 1;
        header("Location: increase_balance.php");
        exit;
    }
    // Check input validity
    $amount = $_POST['in_balance'];
    if($amount==''){
        $_SESSION['err'] = 1;
        header("Location: increase_balance.php");
        exit;
    }
    $arr = str_split($amount,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: increase_balance.php");
            exit;
        }
    }
    $amount = (int)$amount;
    if($amount <= 0){
        $_SESSION['err'] = 1;
        header("Location: increase_balance.php");
        exit;
    }
    // Update balance
    $u_name = $_SESSION['login'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    $query = "select balance from user_info where u_name = '{$u_name}';";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $balance = $row['balance'];
    $balance += $amount;
    $query = "update user_info set balance = {$balance} where u_name = '$u_name';";
    mysqli_query($dbc, $query);
    // Success
    header("Location: balance_success.html");