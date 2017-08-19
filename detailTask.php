<?php
include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");

try{
    if(!empty($_POST)){
        $task = new Feature();

        $task->setComment($_POST['comment']);
        $task->setTaskId($_GET['taskid']);
        $task->setUserId($_SESSION['id']);
        $task->uploadComment();
    }
}catch(Exception $e){
    echo $e->getMessage();
}

$email = $_SESSION['email'];
$id = $_GET['taskid'];
$task = new Feature();

$task->setTaskId($id);

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

<?php include_once("includes/nav.inc.php"); ?><br>

<div class="container">

    <div class="alert-warning"><?php if (isset($error)) {echo htmlspecialchars($error);} ?></div>

    <?php foreach ($task->getTasksId() as $t): ?>
        <div class="list-group-item">
            <p><?php echo htmlspecialchars($t['name']); ?></p>
            <p class="badge badge-danger"><?php echo htmlspecialchars($task->checkDeadline($t['deadline'])); ?></p>
        </div>
    <?php endforeach; ?>
    <br>
    <div class="comment-list">
        <h1>Comments</h1>
        <form class="comment-form" action="" method="post">
            <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea><br>

            <button class="btn btn-danger" type="submit" name="Add" id="Add">Add</button>
        </form>
    <br>
        <?php foreach($task->showComments() as $c): ?>
            <p class="text-danger"><?php echo htmlspecialchars($c['userEmail']) ?></p>
            <p><?php echo htmlspecialchars($c['comment']) ?></p>
            <hr>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>
