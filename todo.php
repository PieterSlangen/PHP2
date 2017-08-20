<?php

include_once('classes/Feature.class.php');
include_once('includes/no-session.inc.php');

try {
    if (isset($_POST['todo'])) {
        $todo = $_POST['todo'];
        $id = $_POST['taskID'];

        $feature = new Feature();
        $feature->setTodo($todo);
        $feature->setTaskId($id);
        $feature->updateTodo();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
