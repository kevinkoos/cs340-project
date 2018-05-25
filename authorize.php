<?php
session_start();
ini_set('display_errors', 1);

$username = $_POST['username'];
$password = $_POST['password'];
$authorized = false;

require('includes/dbconnection.php');

$sql = 'SELECT * from Login';

$rs = $conn->Execute($sql);

// Using a while looping structure to find the first record in the database

while (!$rs->EOF) {
  if ($rs->Fields["UserName"]->Value == $username && $rs->Fields["Password"]->Value == $password) {
    $_SESSION['auth'] = $rs->Fields['Auth']->Value;
    $_SESSION['username'] = $rs->Fields['UserName']->Value;
    $authorized = true;
    break;
  }
  $rs->MoveNext();
}
# Close the connection
$rs->Close();
$conn->Close();

$rs = null;
$conn = null;

if (!$authorized) {
  header('Location: login.php?retry=true');
  exit();
}
else {
  header('Location: index.php');
  exit();
}
?>
