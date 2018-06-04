<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Wishlist";
    include 'includes/pages.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Wishlist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="Lucas">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/mainmenu.php';
?>

    <main>
    <?php
        // Establish connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die("Could not connect: " . mysqli_connect_error());

        $query = "SELECT P.pName, P.pPrice, P.pPhoto
                  FROM ProjProducts P, ProjWishlist W
                  WHERE W.uUsername = user AND P.pID = W.pID";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysqli_error($conn));
        if (mysqli_num_rows($result) == 0) {
            echo "<p class='empty_wishlist'>No items in your wishlist!</p>";
        } else {
            $array = array_fill(0, mysqli_num_rows($result), 1);

            echo "<form method=\"post\" action=\"collect_vals.php\">";
            while($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<td><img src=\"$row[2]\" alt=\"$row[0]\" style=\"display: inline-block; width:64px; height:64px;\"></td>
                      <td>$row[0]</td>
                      <td>Individual price: $$row[1]</td>
                      <td> Amount needed:
                      <input type=\"number\" name=\"quantities[]\"></td>";
                echo "</tr>\n";
            }
            echo "<input type = \"submit\"  value = \"Move wishlist to cart\" />";
            echo "</form>";
        }

        // Close connection
        mysqli_close($conn);
    ?>

    <?php include("common/footer.php"); ?>
    </main>


</body>
</html>
