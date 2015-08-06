<?php

session_start();
require '../class/db-connection.php';
connection();
if (isset($_GET['city'])) {
    $city_id = mysql_real_escape_string($_GET['city']);
    $query = "select city_id from city where city_id='{$city_id}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row > 0) {
        $_SESSION['city'] = $row['city_id'];
    }
}
    $query = "select * from state";
    $result = mysql_query($query) or die(mysql_error());
    echo"<form>";
    ?>
    <select  style='background:#f1f1f1' name='city_id' onchange="city_loader('ajax/city-loader.php?city=' + this.value)">

        <?php

        while ($row = mysql_fetch_array($result)) {
            echo"<optgroup label='{$row['state_name']}'>";
            $query1 = "select * from city where state_id='{$row['state_id']}'";
            $result1 = mysql_query($query1) or die(mysql_error());
            while ($row1 = mysql_fetch_array($result1)) {
                if ($row1['city_id'] == $city_id) {
                    $select = "selected='selected'";
                } else {
                    $select = "";
                }
                echo "<option value='{$row1['city_id']}' $select>{$row1['city_name']}</option>";
            }
            echo "</optgroup>";
        }
        echo "</select>";
        echo "</form>"
    
    ?>

