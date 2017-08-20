<?php
include_once("includes/no-session.inc.php");
include_once("classes/Feature.class.php");

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

    <div id="error" class="alert-warning">
        <p><?php if (isset($error)) {echo htmlspecialchars($error);} ?></p>
    </div>

    <?php foreach ($task->getTasksId() as $t): ?>
        <div class="list-group-item">
            <p><?php echo htmlspecialchars($t['name']); ?></p>
            <p class="badge badge-danger"><?php echo htmlspecialchars($task->checkDeadline($t['deadline'])); ?></p>
            <form  class="form-check form-check-inline" action="" method="post">
                <label for="todo">Todo</label>
                <input type="checkbox" name="todo" id="todo" value="<?php echo htmlspecialchars($t['todo']); ?>">
                <input type="hidden" id="taskID" name="taskID" value="<?php echo $_GET['taskid']; ?>">
            </form>
        </div>
    <?php endforeach; ?>
    <br>
        <h1>Comments</h1>
        <form action="" method="post">
            <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea><br>
            <input type="hidden" id="userID" name="userID" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" id="taskID" name="taskID" value="<?php echo $_GET['taskid']; ?>">
            <input type="hidden" id="userEmail" name="userEmail" value="<?php echo $_SESSION['email']; ?>">

            <button class="btn btn-danger" type="submit" name="Add" id="Add">Add</button>
        </form>
    <br>
    <div id="comment-box">
        <?php foreach ($task->showComments() as $c): ?>
                <p class="text-danger"><?php echo htmlspecialchars($c['userEmail']) ?></p>
                <p><?php echo htmlspecialchars($c['comment']) ?></p>
                <hr>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!--<script src="js/script.js"></script>-->

<script>
    $("#Add").click("submit", function(e){
        var comment = $("#comment").val();
        var taskID = $("#taskID").val();
        var userID = $("#userID").val();
        var userEmail = $("#userEmail").val();

        $.ajax({
            type:"POST",
            url:"comment.php",
            data:{comment: comment, taskID: taskID, userID: userID},
            success: function(response){
                if(comment == ""){
                    $("#error").text("Please fill in a comment");
                }else{
                    /*alert(comment);
                     alert(taskID);
                     alert(userID);
                     alert(response);*/
                    var div = $("<div></div>");
                    div.html("<p class='text-danger'>" + userEmail + "</p><p>" + comment + "</p><hr>");

                    $("#comment-box").prepend(div);
                    $("#comment").val("").focus();
                }
            }
        });
        e.preventDefault();
    });

    $("#todo").click("submit", function(e){
       var todo = $("#todo").val();
       var taskID = $("#taskID").val();

       $.ajax({
          type:'POST',
           url:'todo.php',
           data:{todo: todo, taskID: taskID},
           success: function(response){
                  if($("#todo").val() == 0){
                      $("#todo").val(1);
                  }else{
                      $("#todo").val(0);
                  }
              /*alert(todo);
              alert(taskID);
              alert(response);*/
           }
       });
    });
</script>

</body>
</html>
