<?php
session_start();

require_once ('db_connect.php');

$loggedInUserName = false;
if(isset($_SESSION['user_id'])){
    $userId = mysqli_real_escape_string($connection, $_SESSION['user_id']);
    $sql = "SELECT*FROM users WHERE id = $userId";
    $result = mysqli_query($connection, $sql);
    if($result){
        $matchedUser = mysqli_fetch_assoc($result);
        $loggedInUserName = $matchedUser['first_name'];
    }
}



?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to Cyberspace!</title>
    </head>
    <body>
        <h1>You Are Now On The Information Superhighway.</h1>
        <?php if ($loggedInUserName): ?>
        <h2>Welcome, <?= $loggedInUserName ?>!</h2>
        <p>
            <a href="login.php">Log Out</a>

        </p>
        <?php else: ?>
        <p>
            <a href="login.php">Log In</a><br>
            <a href="register.php">Register</a>
        </p>
        <?php endif; ?>
    </body>
</html>