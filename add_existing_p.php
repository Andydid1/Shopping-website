<?php
    session_start();
    if(!empty($_SESSION['err'])){
        echo "Error";
        $_SESSION['err'] = null;
    }
    if(empty($_SESSION['login'])){
        header("Location: login.php");
    }
    if(empty($_GET['i_id'])){
        $_SESSION['err'] = 1;
        header("Location: inventory.php");
    }
    $i_id = $_GET['i_id'];    
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    $query = "select i_name from inventory where i_id = {$i_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $i_name = $row['i_name'];
?>
<!DOCTYPE html>
<html>
    <h1>Adding existing product to <?php echo $i_name;?></h1>
    <table width="80%" border="3" cellpadding="0" cellspacing="0">
        <tr>
            <td><b>Product name</b></td>
            <td><b>Description</b></td>
            <td><b>Unit price</b></td>
            <td><b>Unit</b></td>
        </tr>  
        <?php
            $query = "select * from product;";
            $result = mysqli_query($dbc,$query);
            while($row = mysqli_fetch_array($result)):
                echo "<tr>
                <td>{$row['p_name']}</td>
                <td>{$row['description']}</td>
                <td>\${$row['unit_price']}</td>
                <td>{$row['unit']}</td>
                <td><a href=confirm_add_e_p.php?i_id={$i_id}&p_id={$row['p_id']}>Add</a></td>
                </tr>";
            endwhile;
        ?>
    </table>
</html>