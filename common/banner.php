<img style="float:left;" src="images/shrubs.gif" alt="Logo" />
<?php
if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
  echo "<h3 class=\"title\">Welcome, " . $_SESSION["username"] . "!</h3>";
}
else {
  echo "<h3 class=\"title\">Welcome!</h3>";
}
?>
