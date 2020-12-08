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
        // Gather storage info
        $query = "select * from stored_in where p_id = {$p_id} and i_id = {$i_id};";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $remain = $row['st_num'];
        // Gather person balance
        $query = "select balance from user_info where u_name = '{$_SESSION['login']}';";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $balance = $row['balance'];
    }else{
        $_SESSION['err'] = 1;
        header("Location: inventory.php");
    }
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Purchase Confirmation</h1>
        <h2>Product name</h2>
        <?php echo $p_name;?>
        <h2>Description</h2>
        <?php echo $description;?>
        <h2>Unit price</h2>
        <?php echo $unit_price;?>
        <h2>Remaining</h2>
        <?php echo $remain;?>
        <h2>Purchase amount</h2>
        <form action="process_purchase.php?p_id=<?php echo "{$p_id}";?>&i_id=<?php echo "{$i_id}";?>" method="post">        
            <input type="text" list="amount_list" value="1" name="amount">
            <input type="Submit" value="Confirm">
        </form>
        Your balance: $<?php echo $balance;?>
        </br>
        <a href="inventory.php">Back</a>
    </body>
</html>