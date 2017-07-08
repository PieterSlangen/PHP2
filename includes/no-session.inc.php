<?php
session_start();
sessionCheck();
function sessionCheck()
{
    if (!empty($_SESSION['email'])) {
    } else {
        header('location: login.php');
    }
}
