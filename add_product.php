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
        header("Location: inventory.php");
    }
    $curr_i_id = $_GET['i_id'];
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Add product</h1>
        Note: product name must be unique
        <form action='process_add_p.php?i_id=<?php echo $curr_i_id?>' method="post">
            <div>
                Product name: <input type='text' name='p_name'>
            </div>
            <div>
                Description: <input type='text' name='description'>
            </div>
            <div>
                Unit price <input type='text' name='unit_price'>
            </div>
            <div>
                Unit <input type='text' name='unit'>
            </div>
            <div>
                Amount <input type='text' name='amount'>
            </div>
            <div>
                <input type='submit' value='Submit'>
            </div>
        </form>
        <a href="add_existing_p.php?i_id=<?php echo $curr_i_id;?>">Add from existing product</a>
        </br>
        <a href="inventory.php?i_id=<?php echo $curr_i_id;?>">Back to inventory</a>
    </body>
</html>