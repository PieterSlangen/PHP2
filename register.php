<?php
include_once("classes/User.class.php");

try {
    $error="";

    if (!empty($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen(trim($firstname)) === 0 || strlen(trim($lastname)) === 0 || strlen(trim($password)) === 0) {
            $error = "Please fill in all fields.";
            $errorBool = true;
        } else {
            $error = "";
            $errorBool = false;
        }

        if ($errorBool == false) {
            $user = new User();
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setAdmin("0");
            $user->register();

            header('Location: login.php');
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
    <title>Register</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

<div class="alert alert-warning"><?php echo htmlspecialchars($error) ?></div>

<div>
    <div>
        <h3>Register</h3>
    </div>
    <div>
        <form action="" method="post">

            <div>
                <?php
                if (isset($errorBool)) {
                    echo "<p class='error'>$error</p>";
                }
                ?>
            </div>

            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname"> </br>

            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname"></br>

            <label for="email">email</label>
            <input type="text" name="email" id="email"></br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"></br>

            <button type="submit">Register</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>