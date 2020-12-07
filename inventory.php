<!DOCTYPE html>
<html>
    <?php 
    session_start();
    if(empty($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    $curr_i_id = $_GET['i_id'];
    if(empty($curr_i_id)){
        $query = "select min(i_id) from inventory;";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $curr_i_id = $row['min(i_id)'];
        header("Location: inventory.php?i_id=$curr_i_id");
    }
    $query = "select i_name from inventory where i_id = {$curr_i_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    echo "<h1>Inventory---{$row['i_name']}</h1>";
    $query = "select a_id from user_info where u_name = '{$_SESSION['login']}';";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    if(empty($row['a_id'])){
        echo "<small><font color='red'>Remember to set your address before purchase!</font></small></br>";
    }
    ?>
    Welcome, <a href='person_info.php'><?php echo $_SESSION['login']?></a>---<a href='orders.php'>My orders</a>---
    <a href='log_out.php'>Log out</a>
    </br>
    <table width="80%" border="3" cellpadding="0" cellspacing="0">
        <tr>
            <td>Product name</td>
            <td>Description</td>
            <td>Unit price</td>
            <td>Unit</td>
            <td>Remaining</td>
        </tr>  
        <?php
            // $dbc = mysqli_connect(constant("DB_H"),constant("DB_U"),constant("DB_P"),constant("DB_DB"));
            $query = "select * from stored_in where i_id = $curr_i_id;";
            $result = mysqli_query($dbc,$query);
            $items_id = array();
            $items_remain = array();
            $i = 0;
            while($row = mysqli_fetch_array($result)):
                array_push($items_id,$row['p_id']);
                array_push($items_remain,$row['st_num']);
            endwhile;
            foreach($items_id as $curr_p):
                $query = "select * from product where p_id = {$curr_p}";
                $result = mysqli_query($dbc, $query);
                $row = mysqli_fetch_array($result);
                echo "<tr>
                <td>{$row['p_name']}</td>
                <td>{$row['description']}</td>
                <td>\${$row['unit_price']}</td>
                <td>{$row['unit']}</td>
                <td>{$items_remain[$i]}</td>
                <td><a href='purchase.php?p_id={$curr_p}'>Purchase</a></td>
                </tr>";
                $i++;
            endforeach;
        ?>
    </table>
    <a href='add_product.php?i_id=<?php echo $curr_i_id;?>'>Add a new product</a>
    </br>
    Go to
    <?php
        $query = "select i_id, i_name from inventory;";
        $result = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result)){
            $i_id = $row['i_id'];
            $i_name = $row['i_name'];
            echo " --- <a href='inventory.php?i_id={$i_id}'>{$i_name}</a>";
        }
    ?>
     --- <a href='create_inventory.php'>Create new inventory</a>
</html>