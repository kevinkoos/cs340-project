<div>
<table>
<colgroup>
    <col style="width:100px;">
    <col style="width:auto;">
</colgroup>
<tr>
    <td><img src="images/shrubs.jpg" alt="Logo" style="width:100%; padding-right: 10px;"></td>
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