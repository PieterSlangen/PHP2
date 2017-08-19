<?php

include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");
include_once("includes/no-admin.inc.php");

try {
    $error="";

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
} catch (Exception $e) {
    $error = $e->getMessage();
}

$feed = new feature();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subject</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>

<?php include_once("includes/navAdmin.inc.php"); ?>

<div class="container">
    <p class="alert-warning"><?php if(isset($error)){echo htmlspecialchars($error);} ?></p>

    <form action="" method="post">
        <h1>Add subject</h1>

        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name">
        </div>

        <input class="btn btn-danger" type="submit" name="add" value="add">
        <br>  <br>
        <h1>Delete subject</h1>

        <div class="form-group">
            <label for="name2">Name</label>
            <input class="form-control" type="text" name="name2" id="name2">
        </div>

        <input class="btn btn-danger" type="submit" name="delete" value="delete">
    </form>
    <br>
    <?php foreach ($feed->getSubjects() as $s): ?>
        <div class="list-group-item">
            <a class="text-danger" href="detailSubject.php?subjectid=<?php echo htmlspecialchars($s['id'])?>&subjectname=<?php echo htmlspecialchars($s['name'])?>"><?php echo htmlspecialchars($s["name"]); ?></a>
        </div>
    <?php endforeach; ?>
</div>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>