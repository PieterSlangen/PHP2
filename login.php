<?php
session_start();

include_once("classes/User.class.php");


try {
    $error="";

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $user->login();

        if ($user->login()) {
            $_SESSION['email'] = $email;

            foreach ($user->checkAdmin() as $u) {
                if ($u['admin'] == 0) {
                    header('location: index.php');
                } else {
                    header('location: indexAdmin.php');
                }
            }
        } else {
            $error = "Please fill in all fields.";
        }
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

<img class="logo" src="images/logo.png" alt="todo logo">

<h1 class="header">Login</h1>

<div class="container">
    <div class="alert-warning"><?php if (isset($error)) {
    echo htmlspecialchars($error);
} ?></div>

    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="text" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-danger">Login</button>

        <p>or <a class="text-danger" href="register.php">register</a> here!</p>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>