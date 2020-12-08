<!DOCTYPE html>
<html>
    <h1>Orders</h1>
    <?php 
    session_start();
    if(empty($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }
    $u_name = $_SESSION['login'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    ?>
    Welcome, <a href='person_info.php'><?php echo $_SESSION['login']?></a>---<a href='log_out.php'>Log out</a>
    </br>
    <table width="100%" border="3" cellpadding="0" cellspacing="0">
        <tr>
            <td>Product name</td>
            <td>Description</td>
            <td>Unit price</td>
            <td>Amount</td>
            <td>Unit</td>
            <td>Total cost</td>
            <td>Order date</td>
        </tr>
        <?php
            $query = "select u_id from user_info where u_name='{$u_name}';";
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $u_id = $row['u_id'];
            $query = "select * from orders where u_id = {$u_id};";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)){
                $p_id = $row['p_id'];
                $o_amount = $row['o_amount'];
                $o_year = $row['o_year'];
                $o_month = $row['o_month'];
                $o_day = $row['o_day'];
                $date = "{$o_year}-{$o_month}-{$o_day}";
                $p_query = "select * from product where p_id = {$p_id}";
                $p_result = mysqli_query($dbc, $p_query);
                $p_row = mysqli_fetch_array($p_result);
                $p_name = $p_row['p_name'];
                $description = $p_row['description'];
                $unit_price = $p_row['unit_price'];
                $unit = $p_row['unit'];
                $total_cost = $unit_price * $o_amount;
                echo "<tr>
                    <td>{$p_name}</td>
                    <td>{$description}</td>
                    <td>\${$unit_price}</td>
                    <td>{$o_amount}</td>
                    <td>{$unit}</td>
                    <td>\${$total_cost}</td>
                    <td>{$date}</td>
                </tr>";
            }
        ?>
    </table>
    <a href="inventory.php">Back to inventory</a>
</html>