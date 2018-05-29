<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Log In";
    include 'includes/pages.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Log In</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=font1|font2|etc">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/login_validator.js"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/banner.php';
    include 'common/mainmenu.php';
?>

<form method="post" id="login" action="includes/authorize.php">
    <?php
    if (isset($_GET["retry"]) && $_GET['retry'] == true) {
        echo "<p class=\"error\">There was an error in the login.<br />Either username or password was incorrect.<br />Please re-enter the correct login information.</p>";
    }
    ?>
    <fieldset>
        <legend>Login:</legend>
        <p>
            <label for="uname">Username:</label>
            <input type="text" class="required" name="uname" id="uname">
        </p>
        <p>
            <label for="passw">Password:</label>
            <input type="password" class="required" name="passw" id="passw">
        </p>
    </fieldset>
    <p>
        <input type="submit" value="Login" />
        <input type="reset" value="Clear Form" />
    </p>
</form>

<?php include("common/footer.php"); ?>

</body>
</html>
