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
    Welcome, <a href='person_info.php'><?php echo $u_name?></a>---<a href='log_out.php'>Log out</a>
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
            $query = "select * from orders join user_info on orders.u_id = user_info.u_id join product on orders.p_id = product.p_id where u_name = '{$u_name}';";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)){
                $p_id = $row['p_id'];
                $o_amount = $row['o_amount'];
                $o_year = $row['o_year'];
                $o_month = $row['o_month'];
                $o_day = $row['o_day'];
                $date = "{$o_year}-{$o_month}-{$o_day}";
                $p_name = $row['p_name'];
                $description = $row['description'];
                $unit_price = $row['unit_price'];
                $unit = $row['unit'];
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