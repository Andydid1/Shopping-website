<?php
    session_start();
    if(empty($_SESSION['login'])){
        $_SESSION['err'] = 1;
        header("Location: login.php");
        exit;
    }
    if(empty($_GET['i_id'])){
        $_SESSION['err'] = 1;
        header("Location: inventory.php");
        exit;
    }
    if(empty($_GET['p_id'])){
        $_SESSION['err'] = 1;
        header("Location: inventory.php?i_id={$_GET['i_id']}");
        exit;
    }
    $i_id = $_GET['i_id'];
    $p_id = $_GET['p_id'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    // Check input validity
    $amount = $_POST['amount'];
    if($amount==''){
        $_SESSION['err'] = 1;
        header("Location: confirm_add_e_p.php?i_id={$i_id}&p_id={$p_id}");
        exit;
    }
    $arr = str_split($amount,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: confirm_add_e_p.php?i_id={$i_id}&p_id={$p_id}");
            exit;
        }
    }
    $amount = (int)$amount;
    if($amount <= 0){
        $_SESSION['err'] = 1;
        header("Location: confirm_add_e_p.php?i_id={$i_id}&p_id={$p_id}");
        exit;
    }
    // Process modification
    $query = "update stored_in set st_num = $amount where p_id = $p_id and i_id = $i_id;";
    mysqli_query($dbc, $query);
    header("Location: modify_s_success.php?i_id=$i_id&p_id=$p_id");
