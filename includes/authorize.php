<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    include 'connectvars.php';

    function filter_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    // Escape user inputs for security
    $uname = filter_input(mysqli_real_escape_string($conn, $_POST['uname']));
    $passw = filter_input(mysqli_real_escape_string($conn, $_POST['passw']));
    $auth = false;

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
            //echo "<p class='success'>Login successful!</p>";
            $auth = true;
        }
        else {
            //echo "<p class='error'>Invalid username and/or password!</p>";
        }
    }
    else {
        //echo "<p class='error'>Invalid username and/or password!</p>";
    }
    // Free result
    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);

    if ($auth) {
        header("Location: ../index.php");
    }
    else {
        header('Location: ../login.php?retry=true');
    }
    exit();
?>
