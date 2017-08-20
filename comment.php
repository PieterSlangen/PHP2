<?php

include_once('classes/Feature.class.php');
include_once('classes/User.class.php');
include_once('includes/no-session.inc.php');

try{
    if(!empty($_POST)){
        $comment = $_POST['comment'];
        $taskID = $_POST['taskID'];
        $userID = $_SESSION['id'];
        $task = new Feature();

        $task->setComment($comment);
        $task->setTaskId($taskID);
        $task->setUserId($userID);
        $task->uploadComment();
    }
}catch(Exception $e){
    echo $e->getMessage();
}