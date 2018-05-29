<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Log In";
    include "includes/pages.php";
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
    include "common/banner.php";
    include "common/mainmenu.php";

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Escape user inputs for security
        $uname = mysqli_real_escape_string($conn, $_POST['uname']);
        $passw = mysqli_real_escape_string($conn, $_POST['passw']);

        // Verify username
        $query = "SELECT uSalt, uPassword FROM ProjUsers WHERE uUsername='$uname'";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysql_error());

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_row($result);
            // MD5 password
            $mdsp = MD5($passw . $row[0]);

            if (strcmp($mdsp, $row[1]) == 0) {
                $_SESSION['username'] = $uname;
                echo "<p class='success'>Login successful!</p>";
            }
            else {
                echo "<p class='error'>Invalid username and/or password!</p>";
            }
        }
        else {
            echo "<p class='error'>Invalid username and/or password!</p>";
        }
        // Free result
        mysqli_free_result($result);
    }
    // Close connection
    mysqli_close($conn);
?>

<form method="post" id="login">
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
