<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}
include 'includes/connectvars.php';
    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

// executes if "move wishlist to cart" button was pressed
if(isset($_GET['quantities'])) {
    $uname = $_SESSION['username'];
    $query = "SELECT P.pID FROM ProjProducts P, ProjWishlist W WHERE W.uUsername = '$uname' AND P.pID = W.pID;";

    $result = mysqli_query($conn, $query)or die("Query failed: " . mysql_error());
    if (mysqli_num_rows($result) != 0) {
        $num = count($_GET['quantities']);
        echo "Count: $num ";
        for($i = 0; $i < $num; $i ++) {
            $row=mysqli_fetch_row($result);
            echo "pid: $row[0] ";
            $quant = $_GET['quantities'][$i];
            echo "quant: $quant ";
            if ($quant != 0) {
                $fnm = "CALL WishItemToCart('$uname', '$row[0]', '$quant')";
                echo "$fnm\n";
                $result = mysqli_query($conn, $fnm) or die("Query failed: " . mysql_error());
            }
        }
        // Close connection
        mysqli_close($conn);
        header("Location: cart.php");
    } 
}
// Close connection
mysqli_close($conn);
header("Location: wishlist.php");
?>