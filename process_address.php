<?php
    session_start();
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    // Get address id of current user
    $a_id = $_GET['a_id'];
    // Check validity
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $addr_line1 = $_POST['addr_line1'];
    $addr_line2 = $_POST['addr_line2'];
    
    if($country == '' || $state == ''
     || $city == '' || $addr_line1 == ''){
        $_SESSION['err'] = 1;
        header("Location: set_address.php");
        exit;
     }
    // If user have no address yet
    if(empty($a_id)){
        $query = "insert into address (country,state,city,addr_line1) values ('{$country}','{$state}','{$city}','{$addr_line1}');"; 
        mysqli_query($dbc,$query);
        $query = "select max(a_id) from address;";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_assoc($result);
        $a_id = $row['max(a_id)'];
        if(isset($addr_line2)){        
            $query = "update address set addr_line2 = '{$addr_line2}' where a_id = {$a_id}";
            mysqli_query($dbc, $query);
        }
        $u_name = $_SESSION['login'];
        $query = "update user_info set a_id = {$a_id} where u_name = '{$u_name}';";
        mysqli_query($dbc, $query);
    }else{ // If the user already have an address
        $query = "update address set country = '{$country}', state = '{$state}', city = '{$city}', addr_line1 = '{$addr_line1}', addr_line2 = null where a_id = {$a_id};";
        mysqli_query($dbc,$query);
        if(!empty($addr_line2)){        
            $query = "update address set addr_line2 = '{$addr_line2}' where a_id = {$a_id}";
            mysqli_query($dbc, $query);
        }
    }
    header("Location: person_info.php");