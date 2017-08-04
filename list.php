<?php

include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");

if(!empty($_POST)){
    $name = $_POST['name'];

    $list = new Feature();
    $list->setName($name);
    $list->add();
}

$feed = new Feature();
$feed->getList();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List</title>
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?>

<h1>Lists</h1>

<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name"><br>

    <button type="submit">Save</button>
</form>

<?php foreach ($feed->getList() as $l): ?>
    <a href="list.php"><?php echo htmlspecialchars($l["name"]); ?></a><br>
<?php endforeach; ?>


<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>