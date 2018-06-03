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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="Anton">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/login_validator.js"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/banner.php';
    include 'common/mainmenu.php';
?>

<main>
<form method="post" id="login" action="includes/authorize.php">
    <fieldset>
        <legend>Login</legend>
        <?php
        if (isset($_GET["retry"]) && $_GET['retry'] == true) {
            echo "<p class=\"error\">Incorrect username or password! Please try again or sign up.</p>";
        }
        ?>
        <table>
            <colgroup>
                <col style="width:150px;">
                <col style="width:auto;">
            </colgroup>
            <tr>
                <td class="hlabel"><label for="uname">Username</label></td>
                <td><input type="text" class="required" name="uname" id="uname" value="<?php if (isset($_GET['uname'])) { echo $_GET['uname']; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="passw">Password</label></td>
                <td><input type="password" class="required" name="passw" id="passw"></td>
            </tr>
        </table>
        <input class="button button_blue" type="submit" value="Login" />
        <input class="button button_blue" type="reset" value="Clear Form" />
    </fieldset>
</form>
</main>

<?php include("common/footer.php"); ?>

</body>
</html>
