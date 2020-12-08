<!DOCTYPE html>
<h1>Person Info</h1>
<?php
    if(empty($_SESSION['login'])){
        header("Location: login.php");
    }
    session_start();
    $u_name = $_SESSION['login'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    $query = "select * from user_info where u_name = '{$u_name}';";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $balance = $row['balance'];
    $a_id = $row['a_id'];
?>
<table width="80%" border="3" cellpadding="0" cellspacing="0">
    <tr>
        <td>Name</td>
        <td>Balance</td>
        <td>Country</td>
        <td>State</td>
        <td>City</td>
        <td>Address Line 1</td>
        <td>Address Line 2</td>
    </tr>
    <?php
        echo "<tr>
        <td>{$u_name}</td>
        <td>\${$balance}</td>";
        if(!empty($a_id)){
            $query = "select * from address where a_id = {$a_id};";
            $result = mysqli_query($dbc,$query);
            $row = mysqli_fetch_array($result);
            $country = $row['country'];
            $state = $row['state'];
            $city = $row['city'];
            $addr_line1 = $row['addr_line1'];
            $addr_line2 = $row['addr_line2'];
            echo "
            <td>{$country}</td>
            <td>{$state}</td>
            <td>{$city}</td>
            <td>{$addr_line1}</td>";
            if(isset($addr_line2)){
                echo "<td>{$addr_line2}</td>";
            }
            echo "</tr></table><div><a href='set_address.php?a_id={$a_id}'>Reset your address</a></div>";
        }else{
            echo "<td><a href='set_address.php?a_id={$a_id}'>Set your address</a></td></tr></table>";
        }
    ?>
<div><a href="increase_balance.php">Increase balance</a></div>
<div><a href="inventory.php">Back to inventory</a></div>