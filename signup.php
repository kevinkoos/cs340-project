<!DOCTYPE html>
<?php
    $currentpage = "Sign Up";
    include "includes/pages.php";
?>

<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/signup_validator.js"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include "common/header.php";

    echo "<h2>Sign Up</h2>";

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Escape user inputs for security
        $uname = mysqli_real_escape_string($conn, $_POST['uname']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $passw = mysqli_real_escape_string($conn, $_POST['passw']);
        $age   = mysqli_real_escape_string($conn, $_POST['age']);

        // Verify username
        $query = "SELECT * FROM Users WHERE username='$uname'";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysql_error());

        if (mysqli_num_rows($result) > 0) {
            echo "<p class='error'>Username already taken! Please choose a different username.</p>";
        } else {
            // Generate salt
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $salt = '';
            for ($i = 0; $i < 20; $i++) {
                $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
            }
            // MD5 password
            $mdsp = MD5($passw . $salt);;
            // Insert query
            $query = "INSERT INTO Users (username, firstName, lastName, email, password, age, salt) VALUES ('$uname', '$fname', '$lname', '$email', '$mdsp', '$age', '$salt')";
            if (mysqli_query($conn, $query)) {
                echo "<p class='success'>SignUp successful!</p>";
            } else {
                echo "<p class='error'>ERROR: Failed to execute $query. " . mysqli_error($conn) . "</p>";
            }
        }
        // Free result
        mysqli_free_result($result);
    }
    // Close connection
    mysqli_close($conn);
?>

<form method="post" id="signup">
    <fieldset>
        <legend>Register:</legend>
        <p>
            <label for="uname">Username:</label>
            <input type="text" class="required" name="uname" id="uname">
        </p>
        <p>
            <label for="fname">First Name:</label>
            <input type="text" class="required" name="fname" id="fname">
        </p>
        <p>
            <label for="lname">Last Name:</label>
            <input type="text" class="required" name="lname" id="lname">
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" class="required" name="email" id="email">
        </p>
        <p>
            <label for="passw">Password:</label>
            <input type="password" class="required" name="passw" id="passw">
        </p>
        <p>
            <label for="confirm_passw">Confirm Password:</label>
            <input type="password" class="required" name="confirm_passw" id="confirm_passw">
        </p>
        <p>
            <label for="age">Age:</label>
            <input type="number" min=1 max=300 class="optional" name="age" id="age" title="Age should be numeric">
        </p>
    </fieldset>
    <p>
        <input type="submit" value="Sign Up" />
        <input type="reset" value="Clear Form" />
    </p>
</form>

</body>
</html>
