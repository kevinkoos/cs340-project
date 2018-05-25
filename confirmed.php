<?php
ob_start();
session_start();
ini_set('display_errors', 1);

$auth = 1;

require('includes/dbconnection.php');

$sql = "INSERT INTO Login (UserName, Password, EMail, Auth, News) VALUES('$_SESSION[username]','$_SESSION[password]','$_SESSION[email]','$auth','$_SESSION[news]');";

$rs = $conn->Execute($sql);

$_SESSION['auth'] = 1;
header('Location: index.php');
exit();

$rs->Close();
$conn->Close();

$rs = null;
$conn = null;

ob_end_flush();
?>
