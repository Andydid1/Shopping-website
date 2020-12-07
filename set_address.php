<!DOCTYPE html>
<h1>Set address</h1>
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
    if(!empty($_GET['a_id'])){
        include_once "mysql_info.php";
        $dbc = mysqli_connect(constant("DB_H"),
        constant("DB_U"),constant("DB_P"),constant("DB_DB"));
        $a_id = $_GET['a_id'];
        $query = "select * from address where a_id = {$a_id};";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $country = $row['country'];
        $state = $row['state'];
        $city = $row['city'];
        $addr_line1 = $row['addr_line1'];
        $addr_line2 = $row['addr_line2'];
    }else{
        $a_id = null;
    }
?>
<html>
    <body>
        <?php 
            $_GET['a_id'] = $a_id;
            echo "
            <form action='process_address.php?a_id={$a_id}' method='post'>";
                if(empty($_GET['a_id'])){
                    echo "
                    <div>
                        Country: <input type='text' name='country'>
                    </div>
                    <div>
                        State: <input type='text' name='state'>
                    </div>
                    <div>
                        City: <input type='text' name='city'>
                    </div>
                    <div>
                        Address Line 1: <input type='text' name='addr_line1'>
                    </div>
                    <div>
                        Address Line 2: <input type='text' name='addr_line2'>
                    </div>
                    <div>
                        <input type='submit' value='Submit'>
                    </div>
                    ";
                }else{
                    echo "
                    <div>
                        Country: <input type='text' name='country' value = '{$country}'>
                    </div>
                    <div>
                        State: <input type='text' name='state' value = '{$state}'>
                    </div>
                    <div>
                        City: <input type='text' name='city' value = '{$city}'>
                    </div>
                    <div>
                        Address Line 1: <input type='text' name='addr_line1' value = '{$addr_line1}'>
                    </div>
                    <div>
                        Address Line 2: <input type='text' name='addr_line2' value = '{$addr_line2}'>
                    </div>
                    <div>
                        <input type='submit' value='Submit'>
                    </div>
                    ";
                }
        ?>
        </form>
    </body>
</html>