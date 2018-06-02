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

        function url() {
            return sprintf(
                "%s://%s%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER['SERVER_NAME'],
                $_SERVER['REQUEST_URI']);
        }

        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }

        $query = "SELECT pID,PName,pPrice,pPhoto FROM ProjProducts ";


        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query to show fields from table failed");
        }

        $fields_num = mysqli_num_fields($result);
        echo "<h1>Products</h1>";

        $path = dirname(url());

        while($row = mysqli_fetch_row($result)) {

        echo "<div class='productHolder'>
                <div class='imgHolder'>
                  <img src=$row[3] width='200' height='200'>
                </div>
                <div class = 'productInfo'>
                  <p><a href=\"$path/product.php?sel_product=$row[0]\">$row[1]</a></p>
                  <p>$ $row[2]</p>
                </div>
              </div>";
        }

        mysqli_free_result($result);
        mysqli_close($conn);
    ?>

    </main>
    <?php include("common/footer.php"); ?>
</body>

</html>
