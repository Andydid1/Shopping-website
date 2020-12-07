<?php
    session_start();
    if(!empty($_SESSION['err'])){
        echo "Error";
        $_SESSION['err'] = null;
    }    
    if(empty($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <body>
        <h1>Create an inventory</h1>
        <small>Note: Name of inventory must be unique!</small>
        <form action="process_create_i.php" method="post">
            <div>
                Name: <input type='text' name='i_name'>
            </div>
            <div>
                Size: <input type='text' name='i_size'>
            </div>
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
        </form>
        <a href="inventory.php">Back to inventory</a>
    </body>
</html>