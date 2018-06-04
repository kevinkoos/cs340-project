<div>
<nav class="nav-bar">
    <ul class="nav-bar-links">
    <li class="nav-item" id="icon-li"><a href="index.php" id="icon-lk"><img src="images/tree.svg" alt="Shrubs" id="icon-img"></a>
    <a id="title" href="index.php">Shrubs</a></li>
<?php
    foreach ($content as $page => $location) {
        if ($location[1] == 0) {
            echo "<li class=\"nav-item\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
        }
        else if ($location[1] == 1) {
            if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
                echo "<li class=\"nav-item\" style=\"float:right\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
            }
        }
        else if ($location[1] == 2) {
            if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
                echo "<li class=\"nav-item\" style=\"float:right\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
            }
        }
    }
?>

    </ul>
</nav>
</div>
