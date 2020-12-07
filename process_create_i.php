<?php
    session_start();
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    // Check validity
    $i_name = $_POST['i_name'];
    $i_size = $_POST['i_size'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $addr_line1 = $_POST['addr_line1'];
    $addr_line2 = $_POST['addr_line2'];
    if($i_name == '' || $i_size == ''||$country == '' || $state == ''
     || $city == '' || $addr_line1 == ''){
        $_SESSION['err'] = 1;
        header("Location: create_inventory.php");
        exit;
    }
    // Check duplication
    $query = "select * from inventory where i_name = '{$i_name}';";
    $result = mysqli_query($dbc, $query);
    if(!empty($row = mysqli_fetch_array($result))){
        $_SESSION['err'] = 1;
        header("Location: create_inventory.php");
        exit;
    }
    // Check i_size is a number
    $arr = str_split($i_size,1);
    $n = count($arr);
    for($i=0;$i<$n;$i++){
        if(!is_numeric($arr[$i])){
            $_SESSION['err'] = 1;
            header("Location: create_inventory.php");
            exit;
        }
    }
    $i_size = (int)$i_size;
    if($i_size <= 0){
        $_SESSION['err'] = 1;
        header("Location: create_inventory.php");
        exit;
    }
    // Create the address for inventory
    $query = "insert into address (country,state,city,addr_line1) values ('{$country}','{$state}','{$city}','{$addr_line1}');"; 
    mysqli_query($dbc,$query);
    $query = "select max(a_id) from address;";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_assoc($result);
    $a_id = $row['max(a_id)'];
    if(!empty($addr_line2)){        
        $query = "update address set addr_line2 = '{$addr_line2}' where a_id = {$a_id}";
        mysqli_query($dbc, $query);
    }
    // Create inventory
    $query = "insert into inventory (i_name, i_size, a_id) values ('{$i_name}', {$i_size}, {$a_id});";
    mysqli_query($dbc, $query);
    $query = "select max(i_id) from inventory;";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_assoc($result);
    $curr_i_id = $row['max(i_id)'];
    header("Location: inventory.php?i_id={$curr_i_id}");