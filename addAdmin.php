<?php
include_once("includes/no-session.inc.php");
include_once("includes/no-admin.inc.php");

try {
    $error="";

    if (!empty($_POST)) {
        if (isset($_POST['add'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setAdmin("1");
            $user->register();
        } elseif (isset($_POST['delete'])) {
            $email2 = $_POST['email2'];

            $user = new User();
            $user->setEmail($email2);
            $user->delete();
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
    <title>Add admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>


<?php include_once("includes/navAdmin.inc.php"); ?><br>

    <div class="container">
        <p class="alert-warning"><?php if (isset($error)) {
    echo htmlspecialchars($error);
} ?></p>

        <form action="" method="post">

            <h3>Add admin</h3>

            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input class="form-control" type="text" name="firstname" id="firstname">
            </div>

            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input class="form-control" type="text" name="lastname" id="lastname">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password">
            </div>

            <input class="btn btn-danger" type="submit" name="add" value="add">
            <br><br>
            <h3>Delete admin</h3>

            <div class="form-group">
                <label for="email2">Email</label>
                <input class="form-control" type="text" name="email2" id="email2">
            </div>

            <input class="btn btn-danger" type="submit" name="delete" value="delete">

        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>