<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Catalog";
    include 'includes/pages.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="Anton">
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
    
    if (isset($_GET['sel_product'])) {
        $pid = (int)$_GET['sel_product'];
        $query = "SELECT pName, pPrice, pQuantity, pDesc, pPhoto FROM ProjProducts WHERE pID=$pid;";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysqli_error($conn));
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_row($result);
            $cmd = "";
            $cmd .= "<fieldset>";
            // Display product title
            $cmd .= "<h2>".$row[0]."</h2>";
            $cmd .= "<table><colgroup><col style=\"width:45%;\"><col style=\"width:55%;\"></colgroup><tr style=\"vertical-align: top;\"><td>";
            // Display product image
            $cmd .= "<img src=\"".$row[4]."\" alt=\"".$row[0]."\" style=\"width:100%; padding-right: 10px;\"></img>";
            $cmd .= "</td><td>";
            // Display product specs
            $cmd .= "<h3>Price</h3><p class=\"desc2 info\">$".$row[1]."</p>";
            $cmd .= "<h3>Availability</h3>";
            if ($row[2] > 0) {
                $cmd .= "<p class=\"desc2 info\">".$row[2]." in stock</p>";
            }
            else {
                $cmd .= "<p class=\"desc3 info\">None in stock</p>";
            }
            $cmd .= "<h3>Description</h3><p class=\"desc4 info\">".$row[3]."</p>";
            // Add the Send to Cart button
            if ($row[2] > 0) {
                $cmd .= "<h3>Purchase</h3>";
                $cmd .= "<div class=\"info\">";
                $cmd .= "<form method=\"post\" id=\"purchase\" action=\"includes/send_to_cart.php?prod_id=".$pid."\">";
                if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                    $cmd .= "<div>";
                    $cmd .= "<label for=\"quantity\">Quantity:</label>";
                    $cmd .= "<input type=\"number\" value=\"1\" min=1 max=".$row[2]." class=\"optional\" name=\"quantity\" id=\"quantity\" title=\"Quantity must be a number\">";
                    $cmd .= "</div>";
                    $cmd .= "<div>";
                    $cmd .= "<input class=\"button button_green\" style=\"display: inline-block;\" type=\"submit\" name=\"send_to_cart\" value=\"Send to Cart\" />";
                    $cmd .= "<input class=\"button button_blue\" style=\"display: inline-block;\" type=\"submit\" name=\"add_to_wishlist\" value=\"Add to Wishlist\" />";
                    $cmd .= "</div>";
                }
                else {
                    $cmd .= "<div>";
                    $cmd .= "<label for=\"quantity\">Quantity:</label>";
                    $cmd .= "<input disabled type=\"number\" value=\"1\" min=1 max=".$row[2]." class=\"optional\" name=\"quantity\" id=\"quantity\" title=\"Quantity must be a number\">";
                    $cmd .= "</div>";
                    $cmd .= "<input disabled class=\"button button_green disabled\" type=\"submit\" value=\"Send to Cart\" />";
                    $cmd .= "<p class=\"desc1\">Login to purchase!</p>";
                }
                $cmd .= "</form>";
                $cmd .= "</div>";
            }
            // Add an option to comment
            $cmd .= "<h3>Review</h3>";
            $cmd .= "<div class=\"info\">";
            $cmd .= "<form method=\"post\" id=\"review\" action=\"includes/add_review.php?prod_id=".$pid."\">";
            if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
                $cmd .= "<label for=\"rating\">Rating:</label>";
                $cmd .= "<input type=\"number\" value=\"0\" min=0 max=10 class=\"optional\" name=\"rating\" id=\"rating\" title=\"Rating must be a number\">";
                $cmd .= "<textarea name=\"comment\" id=\"comment\" class=\"review_box\" wrap=\"hard\" rows=\"1\" cols=\"1\"></textarea>";
                $cmd .= "<input class=\"button button_red\" type=\"submit\" value=\"Review\" />";
            }
            else {
                $cmd .= "<p class=\"desc1\">Login to post a review!</p>";
            }
            $cmd .= "</form>";
            $cmd .= "</div>";
            $cmd .= "</td></tr></table>";
            // Display all product reviews
            $cmd .= "<h3>Comments</h3>";
            $cmd .= "<div class=\"info\">";
            $query2 = "SELECT uUserName, rComment, rRating FROM ProjReviews WHERE pID = $pid;";
            $result2 = mysqli_query($conn, $query2)
                or die("Query failed: " . mysqli_error($conn));
            while ($row2 = mysqli_fetch_row($result2)) {
                $cmd .= "<div>";
                $cmd .= "<p class=\"desc4\">".$row2[2]."</p>";
                $cmd .= "<p class=\"desc4\">".$row2[1]."</p>";
                $cmd .= "<p class=\"desc4\" style=\"float: right;\"><i>-- ".$row2[0]."</i></p>";
                $cmd .= "</div>";
            }
            $cmd .= "</div>";
            mysqli_free_result($result2);

            $cmd .= "</fieldset>";
            echo $cmd;
        }
        // Free result
        mysqli_free_result($result);
    }

    // Close connection
    mysqli_close($conn);
?>


    <?php include("common/footer.php"); ?>
    </main>

</body>
</html>
