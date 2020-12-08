<?php
    if(empty($_GET['i_id'])||empty($_GET['i_id'])){
        header("Location: inventory.php");
    }
    $i_id = $_GET['i_id'];
    $p_id = $_GET['p_id'];
    include_once "mysql_info.php";
    $dbc = mysqli_connect(constant("DB_H"),
    constant("DB_U"),constant("DB_P"),constant("DB_DB"));
    // Gather product info
    $query = "select * from product where p_id = {$p_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $p_name = $row['p_name'];
    // Gather inventory info
    $query = "select i_name, a_id from inventory where i_id = {$i_id};";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);
    $i_name = $row['i_name'];
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Success! <?php echo "{$p_name} updated in {$i_name}"?></h1>
        <a href="inventory.php?i_id=<?php echo $i_id?>">Back to inventory page</a>
    </body>
</html>