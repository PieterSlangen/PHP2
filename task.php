<?php

include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");


try{
    $error="";
    if (!empty($_POST)) {
        $name = $_POST['name'];
        $deadline = $_POST['deadline'];
        $subject = $_POST['subject'];
        $list = $_POST['list'];

        $task = new Feature();
        $task->setName($name);
        $task->setDeadline($deadline);
        $task->setSubject($subject);
        $task->setList($list);
        $task->addTask();
    }
}catch(Exception $e) {
    $error = $e->getMessage();
}

$feed = new Feature();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.css">
</head>
<body>

<?php include_once("includes/nav.inc.php"); ?><br>

<h1>Add task</h1>

<p class="error"><?php echo htmlspecialchars($error) ?></p>

<form action="" method="post">
    <label for="name">Name</label>
    <input type="text" name="name" id="name"><br>

    <select name="subject" id="subject">
        <?php foreach ($feed->getSubjects() as $s): ?>
            <option value="<?php echo htmlspecialchars($s["id"]); ?>"><?php echo htmlspecialchars($s["name"]); ?></option>
        <?php endforeach; ?>
    </select><br>

    <select name="list" id="list">
        <?php foreach ($feed->getLists() as $l): ?>
            <option value="<?php echo htmlspecialchars($l["id"]); ?>"><?php echo htmlspecialchars($l["name"]); ?></option>
        <?php endforeach; ?>
    </select><br>

    <input type="date" name="deadline" id="deadline"><br>

    <button type="submit">Save</button>
</form>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>