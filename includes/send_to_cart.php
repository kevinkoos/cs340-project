<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    include 'connectvars.php';

    function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    if (isset($_SESSION['username']) && $_SESSION['username'] != "" && isset($_GET['prod_id']) && isset($_POST['quantity'])) {
        // Escape user inputs for security
        $user = $_SESSION['username'];
        $prod_id = (int)clean_input($_GET['prod_id']);
        $quantity = (int)clean_input(mysqli_real_escape_string($conn, $_POST['quantity']));

        $query = "DELETE FROM ProjCart WHERE pID = $prod_id AND uUsername = \"$user\";";
        mysqli_query($conn, $query) or die("Query failed1: " . mysql_error());
        
        $query = "INSERT INTO ProjCart (pID, uUsername, cCount) VALUES ($prod_id, \"$user\", $quantity);";
        mysqli_query($conn, $query) or die("Query failed2: " . mysql_error());
    }

    // Close connection
    mysqli_close($conn);

    header("Location: ../cart.php");
    exit();
?>
