<?php
/**
 * Created by PhpStorm.
 * User: silvi
 * Date: 11/14/2018
 * Time: 8:58 PM
 */
if(isset($_SESSION)){
    session_destroy();
}
require_once ('db_connect.php');
$errors=[];
if(isset($_POST['submit'])){
    if(empty($_POST['email'])){
        $errors="Please enter an email address";
    }
    if(empty($_POST['password'])){
        $errors="Please enter a password";
    }
    if($_POST['password'] != $_POST['confirmPassword']){
        $errors="Passwords do not match";
    }

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $firstName = mysqli_real_escape_string($connection, $_POST['firstName']);
    $lastName=mysqli_real_escape_string($connection, $_POST['lastName']);

    $salt=random_bytes(10);

    $hashedPassword = hash('sha256', ($_POST['password'].salt));
    $sql = "INSERT INTO users (email, first_name, last_name, password, salt)VALUES"
        ."('$email', '$firstName', '$lastName', '$hashedPassword', '$salt')";
    $result = mysqli_query($connection, $sql);
    header('Location: /authentication/login.php');
    die;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Please Register</title>
</head>
<body>
<h1>Welcome! Please Log In.</h1>

<?php if (count($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" value="">
    <br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" value="" autocomplete="off">
    <br>
    <label for="confirm-password">Confirm Password</label>
    <input type="password" id="confirm-password" name="confirmPassword" value="" autocomplete="off">
    <br>
    <label for="first-name">First Name</label>
    <input type="text" id="first-name" name="firstName" value="">
    <br>
    <label for="last-name">Last Name</label>
    <input type="text" id="last-name" name="lastName" value="">
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>

</html>
