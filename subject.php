<?php

include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");

if (!empty($_POST['add'])) {
    $name = $_POST['name'];

    $list = new Feature();
    $list->setName($name);
    $list->addSubject();
} elseif (!empty($_POST['delete'])) {
    $name2 = $_POST['name2'];

    $list = new Feature();
    $list->setName($name2);
    $list->deleteSubject();
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject</title>
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>

<?php include_once("includes/navAdmin.inc.php"); ?>

<form action="" method="post">
    <h1>Add subject</h1>

    <label for="name">Name</label>
    <input type="text" name="name" id="name"><br>

    <input type="submit" name="add" value="add">

    <h1>Delete subject</h1>

    <label for="name2">Name</label>
    <input type="text" name="name2" id="name2"><br>

    <input type="submit" name="delete" value="delete">
</form>



<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>