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
                <h3> Cost wise Restaurant Details</h3>
                
            </div>
            <div id="filter">
                <?php {
                    echo "<form method='post'>";
                    echo "<input type='text' name='min_cost' placeholder='Minimun Cost' style='background-image:url(img/tools/rupee.png);background-position:left;background-repeat: no-repeat;padding-left:25px;width:10px;'>&nbsp";
                    echo "<input type='text' name='max_cost' placeholder='Maximun Cost'style='background-image:url(img/tools/rupee.png);background-position:left;background-repeat: no-repeat;padding-left:25px;width:10px;'>&nbsp";
                    echo "<input type='submit' value='Filter'>
                    </form>";
                }
                ?>
            </div>
            <?php
            if ($_POST) {
                $min_cost=$_POST['min_cost'];
                $max_cost=$_POST['max_cost'];
                $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_cost between '{$min_cost}' and '{$max_cost}'order by r.rest_cost";
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