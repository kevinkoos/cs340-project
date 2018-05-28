<!DOCTYPE html>
<?php
    $currentpage = "Wishlist";
    include "includes/pages.php";
?>

<html>
<head>
    <title>Wishlist</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=font1|font2|etc">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include "common/banner.php";
    include "common/mainmenu.php";

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysql_error());

    // ...

    // Close connection
    mysqli_close($conn);
?>

    <main>
    </main>

<?php include("common/footer.php"); ?>

</body>
</html>
