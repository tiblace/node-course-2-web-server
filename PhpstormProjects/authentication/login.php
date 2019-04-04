<?php
/**
 * Created by PhpStorm.
 * User: silvi
 * Date: 11/14/2018
 * Time: 9:27 PM
 */
session_start();
session_destroy();

require_once ('db_connect.php');

$loginError= false;
if(isset($_POST['submit'])){
    $loginError=true;

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $sql = "SELECT id, password, salt FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $matchedUser = mysqli_fetch_assoc($result);

    $hashedPassword = hash('sha256', ($_POST['password'].$matchedUser['salt']));

    if($hashedPassword ==$matchedUser['password']){
        session_start();
        $_SESSION['user_id']=$matchedUser['id'];
        header('Location: /authentication/index.php');
        die;
    }else {
        $loginError = true;
    }
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Log In</title>
</head>
<body>
    <h1>Welcome. Please Log In.</h1>
    <?php if($loginError): ?>
        <h2 style="color: red;">Invalid email address or password.</h2>
    <?php endif; ?>

    <form method="post">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="">
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="" autocomplete="off">
        <br>
        <input type="submit" name="submit" value="Submit">
        <br>
        <a href="register.php">Register</a>
    </form>
</body>
</html>
