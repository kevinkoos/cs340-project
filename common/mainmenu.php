<nav class="nav-bar">
  <ul class="nav-bar-links">
    <li class="nav-item"><a href="index.html">Home</a></li>
    <li class="nav-item"><a href="catalog.html">Catalog</a></li>
    <li class="nav-item"><a href="cart.html">Cart</a></li>
    <li class="nav-item"><a href="wishlist.html">Wish List</a></li>

    <?php
        if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
            echo "<li><a href=\"\">Sign Out</a></li>";
        }
        else {
            echo "<li><a href=\"\">Log In</a></li>";
            echo "<li><a href=\"\">Sign Up</a></li>";
        }
    ?>
  </ul>
</nav>
