<?php
    session_start();
    $curr_i_id = $_GET['i_id'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    // Check validity
    $p_name = $_POST['p_name'];
    $description = $_POST['description'];
    $unit_price = $_POST['unit_price'];
    $unit = $_POST['unit'];
    $amount = $_POST['amount'];
    if($p_name == '' || $description == ''
     || $unit_price == '' || $unit == ''|| $amount == ''){
        $_SESSION['err'] = 1;
        header("Location: add_product.php?i_id=$curr_i_id");
        exit;
    }
    // Check amount is a number
    $arr = str_split($amount,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: add_product.php?i_id=$curr_i_id");
            exit;
        }
    }
    $amount = (int)$amount;
    if($amount <= 0){
        $_SESSION['err'] = 1;
        header("Location: add_product.php?i_id=$curr_i_id");
        exit;
    }
    // Check unit price is a number
    $arr = str_split($unit_price,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: add_product.php?i_id=$curr_i_id");
            exit;
        }
    }
    $unit_price = (int)$unit_price;
    if($unit_price <= 0){
        $_SESSION['err'] = 1;
        header("Location: add_product.php?i_id=$curr_i_id");
        exit;
    }
    // Create the product
    $query = "insert into product (p_name, description, unit_price, unit) values ('{$p_name}', '{$description}', {$unit_price}, '{$unit}');";
    mysqli_query($dbc, $query);
    $query = "select max(p_id) from product;";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $p_id = $row['max(p_id)'];
    // Add in inventory
    $query = "insert into stored_in values ($p_id, $curr_i_id, $amount);";
    mysqli_query($dbc, $query);
    // Success
    header("Location: inventory.php?i_id=$curr_i_id");