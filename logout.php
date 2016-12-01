<?php
    session_start();
    $session_id = $_SESSION['session_id'];
    $now = date("Y-m-d H:i:s",time());
    include 'connect.php';
    echo $session_id;
    echo '<br/>';
    echo $now;
    $expire_session_query = $db->prepare("UPDATE `sessions` SET `expired_at`='$now' WHERE `id`='$session_id'");
    $expire_session_query->execute();
    unset($_SESSION['session_id']);
    unset($_SESSION['session_username']);
    header("Location: https://{$_SERVER['HTTP_HOST']}/index.php");
?>