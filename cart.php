<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Cart";
    include 'includes/pages.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Cart</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=font1|font2|etc">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/banner.php';
    include 'common/mainmenu.php';

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    // ...



        // executes if logged in
    if(isset($_SESSION['username'])){
        $uname = $_SESSION['username'];

        if (isset($_GET['checkout_button'])) {
            $query = "CALL emptyCart('$uname')";
            $result = mysqli_query($conn, $query) or die("Query failed: " . mysql_error());
            echo "<h1 class='empty_cart'>Checkout successful!</h1>";
        } 

        $query = "SELECT * FROM UserCart WHERE uUsername ='$uname' ";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysql_error());

        if (mysqli_num_rows($result) == 0) {
            echo "<h1 class='empty_cart'>No items in your cart!</h1>";
        } else {
            $count = 0;
            $total = 0;
            echo "<form method=\"get\" action=\"#\">";
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<div style='width:100%; height:120px;'>
                        <td><img src='$row[3]' alt='$row[1]' style='display: inline-block; float:left; width:100px; height:100px; margin-right: 10px;'></td>
                        <td>$row[1]</td><br>
                        <td>Individual price: \$$row[2]</td><br>
                        <td>Quantity: $row[4]</td><br>
                        <td>Total price: \$$row[5]</td><br>
                        <td><input type='submit' name='delete_$count' value='Delete item from cart' /></td><br>
                        </div>";		
                echo "</tr>";
                $count ++;
                $total = $total + $row[5];
            }
            
            echo "Total: \$$total   <input id='checkout_button' type = 'submit' name='checkout_button'  value = 'Checkout' />";
            echo "</form>";
        }
    } else {
        echo "<h1>Sign up required to purchase our products!</h1>";
    }


    // Close connection
mysqli_close($conn);
?>

<?php include("common/footer.php"); ?>

</body>
</html>
