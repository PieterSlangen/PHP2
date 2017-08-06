<?php
include_once("includes/no-session.inc.php");
include_once("classes/User.class.php");

if (!empty($_POST)) {
    if (isset($_POST['add'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen(trim($firstname)) === 0 || strlen(trim($lastname)) === 0 || strlen(trim($password)) === 0) {
            $errorMessage = "Please fill in all fields.";
            $error = true;
        } else {
            $errorMessage = "";
            $error = false;
        }

        if ($error == false) {
            $user = new User();
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setAdmin("1");
            $user->register();
        }
    } elseif (isset($_POST['delete'])) {
        $email2 = $_POST['email2'];

        $user = new User();
        $user->setEmail($email2);
        $user->delete();
    }
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add admin</title>
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>


<?php include_once("includes/navAdmin.inc.php"); ?>
    <div>
        <form action="" method="post">

            <div>
                <?php
                if (isset($error)) {
                    echo "<p class='error'>$errorMessage</p>";
                }
                ?>
            </div>

            <h3>Add admin</h3>

            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname"> </br>

            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname"></br>

            <label for="email">email</label>
            <input type="text" name="email" id="email"></br>

            <label for="password">Password</label>
            <input type="password" name="password" id="password"></br>

            <input type="submit" name="add" value="add">

            <h3>Add admin</h3>

            <label for="email2">Email</label>
            <input type="text" name="email2" id="email2"> </br>

            <input type="submit" name="delete" value="delete">

        </form>
    </div>

</body>
</html>