<div>
<table>
<tr>
<td><img src="images/shrubs.jpg" alt="Logo" style="display: inline-block; width:64px; height:64px;"></td>
<td>
<?php
    if (isset($_SESSION['username']) && $_SESSION['username'] != "") {
        echo "<h1>Welcome, " . $_SESSION['username'] . "!</h1>";
    }
    else {
        echo "<h1>Welcome!</h1>";
    }
?>
</td>
</tr>
</table>
</div>