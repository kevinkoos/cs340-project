<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Sign Up";
    include 'includes/pages.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="Anton">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script type="text/javascript" src="js/signup_validator.js"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/banner.php';
    include 'common/mainmenu.php';

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysqli_connect_error());

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Escape user inputs for security
        $uname  = clean_input(mysqli_real_escape_string($conn, $_POST['uname']));
        $email  = clean_input(mysqli_real_escape_string($conn, $_POST['email']));
        $passw  = clean_input(mysqli_real_escape_string($conn, $_POST['passw']));
        $street = clean_input(mysqli_real_escape_string($conn, $_POST['street']));
        $city   = clean_input(mysqli_real_escape_string($conn, $_POST['city']));
        $state  = clean_input(mysqli_real_escape_string($conn, $_POST['state']));
        $zip    = clean_input(mysqli_real_escape_string($conn, $_POST['zip']));

        // Verify username
        $query = "SELECT * FROM ProjUsers WHERE uUsername='$uname'";
        $result1 = mysqli_query($conn, $query)
            or die("Query failed: " . mysqli_error($conn));
        $query = "SELECT * FROM ProjUsers WHERE uEmail='$email'";
        $result2 = mysqli_query($conn, $query)
            or die("Query failed: " . mysqli_error($conn));

        if (mysqli_num_rows($result1) > 0) {
            $err_res = 1;
        }
        else if (mysqli_num_rows($result2) > 0) {
            $err_res = 2;
        }
        else {
            // Generate salt
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $salt = '';
            for ($i = 0; $i < 20; $i++) {
                $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
            }
            // MD5 password
            $mdsp = MD5($passw . $salt);
            // Insert query
            $query = "INSERT INTO ProjUsers (uUsername, uEmail, uPassword, uSalt, uCity, uState, uZIP, uStreet) VALUES ('$uname', '$email', '$mdsp', '$salt', '$city', '$state', '$zip', '$street')";
            mysqli_query($conn, $query)
                or die("Query failed: " . mysqli_error($conn));
            $err_res = 3;
        }
        // Free result
        mysqli_free_result($result1);
        mysqli_free_result($result2);
    }
    // Close connection
    mysqli_close($conn);
?>

<main>
<form method="post" id="signup">
    <fieldset>
        <legend>Register</legend>
        <?php
        if (isset($err_res)) {
            if ($err_res == 1) {
                echo "<p class=\"error\">Username already taken! Please choose a different username.</p>";
            }
            else if ($err_res == 2) {
                echo "<p class=\"error\">Email already taken! Please choose a different email.</p>";
            }
            else if ($err_res == 3) {
                echo "<p class=\"success\">Signup successful! Navigate to Login page to sing in.</p>";
            }
        }
        ?>
        <table>
            <colgroup>
                <col style="width:150px;">
                <col style="width:auto;">
            </colgroup>
            <tr>
                <td class="hlabel"><label for="uname">Username</label></td>
                <td><input type="text" class="required" name="uname" id="uname" value="<?php if (isset($uname)) { echo $uname; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="email">Email</label></td>
                <td><input type="text" class="required" name="email" id="email" value="<?php if (isset($email)) { echo $email; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="passw">Password</label></td>
                <td><input type="password" class="required" name="passw" id="passw"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="confirm_passw">Confirm Password</label></td>
                <td><input type="password" class="required" name="confirm_passw" id="confirm_passw"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="street">Street</label></td>
                <td><input type="text" class="required" name="street" id="street" value="<?php if (isset($street)) { echo $street; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="city">City</label></td>
                <td><input type="text" class="required" name="city" id="city" value="<?php if (isset($city)) { echo $city; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="state">State</label></td>
                <td><input type="text" class="required" name="state" id="state" value="<?php if (isset($state)) { echo $state; } ?>"></td>
            </tr>
            <tr>
                <td class="hlabel"><label for="zip">ZIP</label></td>
                <td><input type="number" min="1" max="99999" class="optional" name="zip" id="zip" title="ZIP should be numeric" value="<?php if (isset($zip)) { echo $zip; } ?>"></td>
            </tr>
        </table>
        <input class="button button_blue" type="submit" value="Sign Up" />
        <input class="button button_blue" type="reset" value="Clear Form" />
    </fieldset>
</form>
</main>

<?php include("common/footer.php"); ?>

</body>
</html>
