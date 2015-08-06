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

        <!--/ Stylesheet(Application) -->
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
                <h3> Menu wise Restaurant Details</h3>
            </div>
            <div id="filter">
                <?php {
                    echo "<form method='post'>";
                    $query = "select * from state";
                    $result = mysql_query($query) or die(mysql_error());
                    echo "<select name='state_id'>";
                    echo "<option value='#'>Select State</option>";
                    while ($row = mysql_fetch_array($result)) {
                        $state_name = ucwords($row['state_name']);
                        echo "<option value='{$row['state_id']}'>{$state_name}</option>";
                    }
                    echo "</select> ";

                    $query = "select * from city";
                    $result = mysql_query($query) or die(mysql_error());
                    echo "<select name='city_id'>";
                    echo "<option value='#'>Select City</option>";
                    while ($row = mysql_fetch_array($result)) {
                        $city_name = ucwords($row['city_name']);
                        echo "<option value='{$row['city_id']}'>{$city_name}</option>";
                    }
                    echo "</select> ";

                    echo "<select name='menu_avail'>";
                    echo "<option value=''>Menu Availability</option>";
                    echo "<option value='1'>Available</option>";
                    echo "<option value='0'>Not Available</option>";
                    echo "</select> ";
                   echo "<input type='submit' value='Filter'>
                    </form>";
                }
                ?>
            </div>
            <?php
            if ($_POST) {
                $state_id=$_POST['state_id'];
                $city_id=$_POST['city_id'];
                $menu_avail = $_POST['menu_avail'];
                if($menu_avail==1)
                {
                    $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and s.state_id='{$state_id}' and c.city_id='{$city_id}' and r.rest_id in(
                        select r.rest_id from restaurant_detail r,restaurant_menu rp where rp.rest_id=r.rest_id group by rp.rest_id)";
                    $menu_avail="Available";
                }
                else
                {
                    $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and s.state_id='{$state_id}' and c.city_id='{$city_id}' and r.rest_id not in(
                        select r.rest_id from restaurant_detail r,restaurant_menu rp where rp.rest_id=r.rest_id group by rp.rest_id)";
                    $menu_avail="Not Available";
                }
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
                <th width='9%'>Cost</th>
                <th>Menu</th>
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
                <td><span class='icone-rupee'> {$row['rest_cost']}</span></td>
                 <td>{$menu_avail}</td>    
                <td>{$row['rest_time1_on']} to {$row['rest_time1_off']}</td>
                <td>{$row['rest_time2_on']} to {$row['rest_time2_off']}</td>
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