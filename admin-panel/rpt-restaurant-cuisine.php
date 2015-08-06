<?php
require '../class/db-connection.php';
connection();
session_start();
?>
<html>
    <head>
        <title>
            Reports
        </title> 
        <link rel="stylesheet" href="css/report-style.css">

    </head>

    <body bgcolor="#f1f1f1" >
    <center>
        <div id="a4">
            <div id="header" >
                <img src="img/logo-img-black.png" >

            </div>
            <hr class="line2">
            <hr class="line1">
            <div id="sub-header">
                <h2>Restaurant Details</h2>
            </div>
            <div id="filter">
                <?php {
                    echo "<form method='post'>";

                    $query = "select * from state";
                    $result = mysql_query($query) or die(mysql_error());
                    echo"<select name='city_id' >";
                    while ($row = mysql_fetch_array($result)) {
                        echo"<optgroup label='{$row['state_name']}'>";
                        $query1 = "select * from city where state_id='{$row['state_id']}'";
                        $result1 = mysql_query($query1) or die(mysql_error());
                        while ($row1 = mysql_fetch_array($result1)) {
                            
                            echo "<option value='{$row1['city_id']}'>{$row1['city_name']}</option>";
                        }
                        echo "</optgroup>";
                    }
                    echo "</select>";



                    $query = "select * from cuisine";
                    $result = mysql_query($query) or die(mysql_error());
                    echo "<select name='cuisine_id'>";
                    echo "<option value='#'>Select Cuisine</option>";
                    while ($row = mysql_fetch_array($result)) {
                        $cuisine_name = ucwords($row['cuisine_name']);
                        echo "<option value='{$row['cuisine_id']}'>{$cuisine_name}</option>";
                    }
                    echo "</select> ";


                    echo "<input type='submit' value='Filter'>
                    </form>";
                }
                ?>
            </div>
            <?php
            if ($_POST) {
                $city_id=$_POST['city_id'];
                $cuisine_id = $_POST['cuisine_id'];
                $query = "select cuisine_name from cuisine where cuisine_id='{$cuisine_id}'";
                $result = mysql_query($query) or die(mysql_error());
                $row = mysql_fetch_array($result);
                if ($row) {
                    $cuisine_name = $row['cuisine_name'];
                }
                $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_cuisine_id like '%{$cuisine_id}%' and c.city_id='{$city_id}' ";
                $result = mysql_query($query) or die(mysql_error());
                $count = mysql_num_rows($result);
                echo "<a href='' target='_blank' onclick='window.print();' ><img src='img/tools/print12.png' style='height:30px;width:30px;float:right;margin-top:-50px;'></a>";
                echo "<h3 class='label1'>Total {$count} records found.</h3>";
                if ($count > 0) {

                    echo "<table border='1' class='report'>
                    <tr>
                <th>NO.</th>
                <th>Restaurant</th>
                <th>City</th>
                <th>Area</th>
                <th>Cuisine</th>
                <th >Cost</th>
                <th>Morning Time</th>
                <th>Evening Time</th>
                
                </tr>";
                    $i = 1;
                    while ($row = mysql_fetch_array($result)) {
                        if ($i % 2 == 0) {
                            echo "<tr class='even'>";
                        } else {
                            echo "<tr class='odd'>";
                        }
                        echo "<td>{$i}</td>
                <td>{$row['rest_name']}</td>
                <td>{$row['city_name']}</td>
                <td>{$row['locality_name']}</td>
                <td>{$cuisine_name}</td>
                <td width='8%' align='right'><span class='icone-rupee'> {$row['rest_cost']}</span></td>
                <td align='center'>{$row['rest_time1_on']} to {$row['rest_time1_off']}</td>
                <td align='center'>{$row['rest_time2_on']} to {$row['rest_time2_off']}</td>
                </tr>";
                        $i++;
                    }
                    echo " </table>";
                    echo "<hr class='line3'>";
                }
            }
            ?>
        </div>
    </center>

</body>
</html>