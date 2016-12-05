<?php
    session_start();
    $session_id = $_SESSION['session_id'];
    //current time stamp
    $now = date("Y-m-d H:i:s",time());
    include 'connect.php';
    //add expired time stamp to sessions table
    $expire_session_query = $db->prepare("UPDATE `sessions` SET `expired_at`='$now' WHERE `id`='$session_id'");
    $expire_session_query->execute();
    //unset variables
    unset($_SESSION['session_id']);
    unset($_SESSION['session_username']);
    //redirect
    header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
?>