<?php
require_once 'config/bootstrap.php';
$auth = new Auth();
$auth->logout();

$script = $_SERVER['SCRIPT_NAME'];
$base   = rtrim(dirname(dirname($script)), '/');
header('Location: ' . $base . '/login.php');
exit;
?>