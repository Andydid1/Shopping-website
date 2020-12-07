<?php
    session_start();
    if(isset($_SESSION['err'])){
        echo "<red>Username and password doesn't match!</red>";
        $_SESSION['err'] = null;
    }
    if(isset($_SESSION['login'])){
        header("Location: inventory.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>test_frontend</title>
    </head>
    <body>
        <h1>Login Page</h1>
        <form action="login_process.php" method="post">
            <div>
                Username <input type="text" name="u_nm"> 
                <small><a href="sign_up.php">Sign up now!</a></small>
            </div>
            <div>
                Password <input type="password" name="u_pw">
            </div>
            <input type="submit" value="Login">
        </form>
    </body>
</html>