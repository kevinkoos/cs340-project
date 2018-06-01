<div>
<nav class="nav-bar">
    <ul class="nav-bar-links">
<?php
    foreach ($content as $page => $location) {
        if ($location[1] == 0) {
            echo "<li class=\"nav-item\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
        }
        else if ($location[1] == 1) {
            if (!isset($_SESSION["username"]) || $_SESSION["username"] == "") {
                echo "<li class=\"nav-item\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
            }
        }
        else if ($location[1] == 2) {
            if (isset($_SESSION["username"]) && $_SESSION["username"] != "") {
                echo "<li class=\"nav-item\"><a href=\"".$location[0]."\"".($page==$currentpage ? " class=\"active\"" : "").">".$page."</a></li>";
            }
        }
    }
?>

    </ul>
</nav>
</div>
