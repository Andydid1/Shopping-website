
<?php

session_start();
if(isset($_SESSION['err'])){
    if($_SESSION['err'] == 1)
    echo "Two password doesn't match or empty input";
    $_SESSION['err'] = null;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>test_frontend</title>
    </head>
    <body>
        <h1>Sign Up Page</h1>
        <form action="sign_process.php" method="post">
            <div>
                Username <input type="text" name="u_nm">
            </div>
            <div>
                Password <input type="password" name="u_pw">
            </div>
            <div>
                Repeat Password <input type="password" name="u_pw2">
            </div>
            <input type="submit" value="Sign up">
            <small>Already have an account? <a href="login.php">Log in</a></small>
        </form>
    </body>
</html>