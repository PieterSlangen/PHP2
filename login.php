<?php
session_start();

include_once("classes/User.class.php");

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $user->setEmail($email);
    $user->setPassword($password);
    $user->Login();

    if ($user->Login()) {
        $_SESSION['email'] = $email;
        header('Location: index.php');
    } else {
        $error = "Username or password is incorrect.";
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>

<h1>Login</h1>

<form action="" method="post">
    <label for="email">email</label>
    <input type="text" name="email" id="email">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <button type="submit">Login</button>

    <p>or <a href="register.php">register</a> here!</p>

    <?php
    if (isset($error)) {
        echo "<p class='error'>$error</p>";
    }
    ?>
</form>

</body>
</html>