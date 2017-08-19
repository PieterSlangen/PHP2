<?php
include_once("classes/User.class.php");

$user = new User();

foreach($user->checkAdmin() as $u){
    if($u['admin'] == 0){
        header('location: index.php');
    }else{

    }
}
