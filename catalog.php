<!DOCTYPE html>
<html>
  <head>

    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=font1|font2|etc" type="text/css">
    <link rel="stylesheet" href="index.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

  </head>
  
  <body>  

   
    <nav class="nav-bar">
      <h1 class="title">Catalog</h1>
      <ul class="nav-bar-links">
          <li class="nav-item"><a href="index.php">Home</a></li>
          <li class="nav-item"><a href="catalog.html">Catalog</a></li>
          <li class="nav-item"><a href="cart.html">Cart</a></li>
          <li class="nav-item"><a href="wishlist.html">Wish List</a></li>

          <li><a href="">Log In</a></li>
          <li><a href="">Sign Up</a></li>
          <li><a href="">Sign Out</a></li>
      </ul>
    </nav>
    <main>
      <div class = "mainContent">
        <div class = "searchBar">
            <input id = "searchBar" type='text'>
        </div>
        <div class = "searchButton">
          <button id ="searchButton">Search</button>
        </div>


        <div class = "results">
          

        </div>
      </div>

       <?php 
      include 'connectvars.php';
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
        

      while($row = mysqli_fetch_row($result)) {	
       
        echo "<div class='productHolder'> 
                <div class='imgHolder'> 
                  <img src=$row[3] width='200' height='200'> 
                </div>
                <div class = 'productInfo'>
                  <p><a href='#'> $row[1]</a></p>
                  <p>$ $row[2]</p>
                </div>
              </div>";
      }
    
      mysqli_free_result($result);
      mysqli_close($conn);
    ?>

    </main>
  </body>

  
 
</html>