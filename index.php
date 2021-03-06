<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isset($_SESSION)) {
        session_start();
    }
    $currentpage = "Home";
    include 'includes/pages.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="author" content="Mac">
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
<?php
    include 'includes/connectvars.php';
    include 'common/mainmenu.php';

    // Establish connection
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or die("Could not connect: " . mysqli_connect_error());

    // ...

    // Close connection
    mysqli_close($conn);
?>

    <main>
    <fieldset>
        <a href="product.php?sel_product=3\">Our featured product is Pears!</a>
    </fieldset>
    <div class = "MainBody">

          <div class = "LeftSide">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna vitae ipsum aliquet pharetra. Nullam pretium ultricies felis at ultrices. Nullam pretium congue quam sed ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam posuere sapien id egestas iaculis. Duis vehicula ut velit ut congue. Vestibulum vitae nisl commodo, efficitur massa in, aliquam tellus. Nam posuere, orci eget pretium blandit, eros lacus semper metus, id luctus mi risus sed risus. Proin lorem nunc, consectetur vel consequat vel, rutrum vitae ipsum. Mauris molestie, mi a maximus tempor, ex magna porttitor tortor, ac cursus dolor diam sed nunc. Aliquam elementum consectetur dapibus.

              Suspendisse venenatis magna augue, quis porta lacus lobortis vulputate. Aliquam eu ligula sit amet massa elementum luctus ut in nisi. Integer consectetur justo ultricies neque tincidunt rhoncus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In tempor facilisis nibh, sit amet pretium enim maximus in. Nunc fermentum sagittis sagittis. Etiam non congue sapien. Nulla in sem commodo, volutpat sapien varius, posuere dui. Quisque eget egestas libero. Vestibulum dolor turpis, porta sed tempus vel, tincidunt at libero. Sed libero orci, luctus eget hendrerit nec, rhoncus id sapien. Aliquam ac erat et sapien semper vehicula. Fusce quis odio elit. Duis id tincidunt arcu. Ut euismod accumsan velit eget pharetra. Fusce purus metus, blandit sit amet libero non, malesuada finibus tortor.

              Morbi semper ornare fermentum. In hac habitasse platea dictumst. Praesent pretium vulputate dolor, eu fermentum risus ornare vitae. Phasellus semper nisi nibh, nec porta massa tincidunt in. Suspendisse maximus nulla elit, ac finibus orci rutrum eu. Sed laoreet felis id efficitur pretium. Cras ultricies libero sed magna fringilla, at gravida elit fermentum. Nunc varius, nisi nec sodales lobortis, enim dolor laoreet ligula, et tristique quam enim non diam.

              Fusce neque mauris, sodales non hendrerit vel, ultrices eget enim. Integer et tellus nisl. Nulla facilisi. Praesent sagittis, quam id sagittis auctor, metus mi sodales ipsum, tincidunt cursus mi erat nec nisi. Duis interdum luctus purus sed tempor. Etiam sed mauris dolor. Curabitur elementum, mi non lobortis pretium, diam purus tincidunt augue, vitae lobortis urna ante molestie ante. Aenean at leo non augue cursus feugiat. Vestibulum in odio maximus libero mattis interdum et ut tellus.

              Morbi sit amet ex hendrerit, ullamcorper libero elementum, venenatis quam. Aenean tristique eleifend ligula a feugiat. Vestibulum convallis pellentesque erat, et feugiat lacus. Cras mollis vestibulum ipsum, vel elementum turpis tempor vitae. In ullamcorper dui ac nibh eleifend eleifend. Ut mauris risus, euismod id tortor eget, cursus ultricies elit. Nullam eget justo arcu. Vestibulum vel malesuada nunc. Donec ornare sapien leo, ac porta massa sodales vitae. Maecenas blandit turpis id feugiat congue. Morbi ac lectus vulputate, aliquet enim sit amet, convallis est. Aenean commodo metus vitae risus interdum feugiat. Duis ut vulputate ante. Cras facilisis magna eget eros auctor, in fringilla erat luctus.</p>

              <div class ="LeftPic">
                <img src="images/leftpic.jpg" alt="Farmer" >
              </div>
            </div>

            <div class = "RightSide">
            <div class ="RightPic">
              <img src="images/rightpic.jpg" alt="Plant" >
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in magna vitae ipsum aliquet pharetra. Nullam pretium ultricies felis at ultrices. Nullam pretium congue quam sed ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam posuere sapien id egestas iaculis. Duis vehicula ut velit ut congue. Vestibulum vitae nisl commodo, efficitur massa in, aliquam tellus. Nam posuere, orci eget pretium blandit, eros lacus semper metus, id luctus mi risus sed risus. Proin lorem nunc, consectetur vel consequat vel, rutrum vitae ipsum. Mauris molestie, mi a maximus tempor, ex magna porttitor tortor, ac cursus dolor diam sed nunc. Aliquam elementum consectetur dapibus.

              Suspendisse venenatis magna augue, quis porta lacus lobortis vulputate. Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.

              Morbi semper ornare fermentum. In hac habitasse platea dictumst. Praesent pretium vulputate dolor, eu fermentum risus ornare vitae. Phasellus semper nisi nibh, nec porta massa tincidunt in. Suspendisse maximus nulla elit, ac finibus orci rutrum eu. Sed laoreet felis id efficitur pretium. Cras ultricies libero sed magna fringilla, at gravida elit fermentum. Nunc varius, nisi nec sodales lobortis, enim dolor laoreet ligula, et tristique quam enim non diam.

              Fusce neque mauris, sodales non hendrerit vel, ultrices eget enim. Integer et tellus nisl. Nulla facilisi. Praesent sagittis, quam id sagittis auctor, metus mi sodales ipsum, tincidunt cursus mi erat nec nisi. Duis interdum luctus purus sed tempor. Etiam sed mauris dolor. Curabitur elementum, mi non lobortis pretium, diam purus tincidunt augue, vitae lobortis urna ante molestie ante. Aenean at leo non augue cursus feugiat. Vestibulum in odio maximus libero mattis interdum et ut tellus.

              Morbi sit amet ex hendrerit, ullamcorper libero elementum, venenatis quam. Aenean tristique eleifend ligula a feugiat. Vestibulum convallis pellentesque erat, et feugiat lacus. Cras mollis vestibulum ipsum, vel elementum turpis tempor vitae. In ullamcorper dui ac nibh eleifend eleifend. Ut mauris risus, euismod id tortor eget, cursus ultricies elit. Nullam eget justo arcu. Vestibulum vel malesuada nunc. Donec ornare sapien leo, ac porta massa sodales vitae. Maecenas blandit turpis id feugiat congue. Morbi ac lectus vulputate, aliquet enim sit amet, convallis est. Aenean commodo metus vitae risus interdum feugiat. Duis ut vulputate ante. Cras facilisis magna eget eros auctor, in fringilla erat luctus.</p>
          </div>
        </div>
    <?php include("common/footer.php"); ?>
    </main>


</body>
</html>
