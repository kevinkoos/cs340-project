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
    <meta name="author" content="Anton Synytsia">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/banner.php';
    include 'common/mainmenu.php';

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    if (isset($_GET["sel_product"])) {
        $pid = (int)$_GET["sel_product"];
        $query = "SELECT pName, pPrice, pQuantity, pDesc, pPhoto FROM ProjProducts WHERE pPID=$pid;";
        $result = mysqli_query($conn, $query)
            or die("Query failed: " . mysql_error());
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_row($result);
            $cmd = "";
            $cmd .= "<h2>".$row[0]."</h2>";
            $cmd .= "<fieldset>"
            $cmd .= "<table><tr><td>";
            $cmd .= "<img src=\"".$row[4]."\" alt=\"".$row[0]."\" style=\"display: inline-block; width:360px;\"></img>";
            $cmd .= "</td><td>";
            $cmd .= "<h3>Price</h3><p class=\"desc1\">".$row[1]."</p>";
            $cmd .= "<h3>Availability</h3>";
            if ($row[2] > 0) {
                $cmd .= "<p class=\"desc2\">".$row[2]." in stock</p>";
            }
            else {
                $cmd .= "<p class=\"desc3\">None in stock</p>";
            }
            $cmd .= "<h3>Description</h3><p class=\"desc4\">".$row[3]."</p>";
            $cmd .= "</td></tr></table>";
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

</body>
</html>
