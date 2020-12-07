<?php
    session_start();
    if(isset($_SESSION['err'])){
        echo "Error";
        $_SESSION['err'] = null;
    }
    if(empty($_SESSION['login'])){
        header("Location: login.php");
        exit;
    }?>
<!DOCTYPE html>
<html>
    <body>
        <h1>How much money($) you want to deposit?</h1>
        <form action="process_balance.php" method="post">
            <input type="text" name="in_balance" value="1">
            <input type="submit" value="Confirm">
        </form>
        <div><a href="person_info.php">Back</a></div>
    </body>
</html>