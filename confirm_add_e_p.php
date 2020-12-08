<?php
    session_start();
    if(isset($_SESSION['err'])){
        echo "Error";
        $_SESSION['err'] = null;
    }    
    if(empty($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }
    // Get data according to product id
    if(!empty($_GET['p_id']) && !empty($_GET['i_id'])){
        include_once "mysql_info.php";
        $dbc = mysqli_connect(constant("DB_H"),
        constant("DB_U"),constant("DB_P"),constant("DB_DB"));
        $p_id = $_GET['p_id'];
        $i_id = $_GET['i_id'];
        // Gather product info
        $query = "select * from product where p_id = {$p_id};";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $p_name = $row['p_name'];
        $description = $row['description'];
        $unit_price = $row['unit_price'];
        $unit = $row['unit'];    
        // Gather inventory info
        $query = "select i_name, a_id from inventory where i_id = {$i_id};";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $i_name = $row['i_name'];
        $a_id = $row['a_id'];
        // Gather address info
        $query = "select * from address where a_id = {$a_id};";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $country = $row['country'];
        $state = $row['state'];
        $city = $row['city'];
        $addr_line1 = $row['addr_line1'];
        $addr_line2 = $row['addr_line2'];
    }else{
        $_SESSION['err'] = 1;
        header("Location: inventory.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Product Adding Confirmation</h1>
        <h2>Product name</h2>
        <?php echo $p_name;?>
        <h2>Description</h2>
        <?php echo $description;?>
        <h2>Unit price</h2>
        <?php echo $unit_price;?>
        <h2>Unit</h2>
        <?php echo $unit;?>
        <h2><font color='blue'>Adding to</font></h2>
        <?php 
            echo "<b>$i_name</b>";
            echo "</br>
            $country</br>
            $state</br>
            $city</br>
            $addr_line1</br>";
        ?>
        <h2>Amount</h2>
        <form action="process_add_e_p.php?p_id=<?php echo "{$p_id}";?>&i_id=<?php echo "{$i_id}";?>" method="post">        
            <input type="text" list="amount_list" value="1" name="amount">
            <input type="Submit" value="Confirm">
        </form>
        <a href="add_existing_p.php?i_id=<?php echo "{$i_id}";?>">Back</a>
    </body>
</html>