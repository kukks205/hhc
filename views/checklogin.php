<?php
ob_start();
//session_start();

include 'includes/loginCheck.php';
$login = new loginCheck();
$login->checkLogin($_POST['username'], $_POST['password'],$_POST['theme']);
?>
