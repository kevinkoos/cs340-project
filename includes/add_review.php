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

    $prod_id = null;

    if (isset($_SESSION['username']) && $_SESSION['username'] != "" && isset($_GET['prod_id'] && isset($_POST['comment']) && isset($_POST['rating'])) {
        // Escape user inputs for security
        $user = $_SESSION['username'];
        $prod_id = (int)clean_input($_GET['prod_id']);
        $comment = clean_input(mysqli_real_escape_string($conn, $_POST['comment']));
        $rating = (int)clean_input($_POST['rating']);

        $query = "DELETE FROM ProjReviews WHERE pID = $prod_id AND uUsername = \"$user\";";
        $quert .= "INSERT INTO ProjReviews (pID, uUsername, rRating, rComment) VALUES ($prod_id, \"$user\", $rating, \"$comment\");";

        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysql_error());

        // Free result
        mysqli_free_result($result);
    }

    // Close connection
    mysqli_close($conn);

    if ($prod_id) {
        header("Location: ../product.php?prod_id=$prod_id");
    }
    else {
        header("Location: ../catalog.php");
    }
    exit();
?>
