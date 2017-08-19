<?php

include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");

if (!empty($_POST)) {
    $name = $_POST['name'];
    $id = $_GET['subjectid'];
    $subject = new Feature();

    $subject->setName($name);
    $subject->setSubject($id);
    $subject->updateSubject();
}

$id = $_GET['subjectid'];
$subject = new Feature();

$subject->setSubject($id);

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List detail</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

<?php include_once("includes/navAdmin.inc.php"); ?><br>

<div class="container">

    <h1><?php echo $_GET['subjectname']?></h1>

    <?php foreach ($subject->getSubjectId() as $s): ?>
        <div class="list-group-item">
            <p><?php echo htmlspecialchars($s['taskname']); ?></p>
            <p class="badge badge-danger"><?php echo htmlspecialchars($subject->checkDeadline($s['deadline'])); ?></p>
            <p><?php echo htmlspecialchars($s['listname']); ?></p>
        </div>
    <?php endforeach; ?>
    <br>
    <h3>Update subject</h3>

    <form action="" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" id="name" name="name">
        </div>

        <button class="btn btn-danger" type="submit">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>
