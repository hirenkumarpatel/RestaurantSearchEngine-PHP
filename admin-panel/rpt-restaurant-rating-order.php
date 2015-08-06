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
                <h3> Rate Restaurant Details</h3>
            </div>
            <div id="filter">
                <?php 
                    echo "<form method='post'>";
                    echo "<select name='order' > 
                    <option value='#'>Select Ordering</option>
                    <option value=''>Asending</option>
                    <option value='desc'>Decending</option>
                    </select>";
                    echo "<input type='submit' value='Filter'>
                    </form>";
                
                ?>
            </div>
            <?php
            if ($_POST) {
               
                $order=$_POST['order'];
                $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id group by rt.rest_id order by avg_rate {$order}";
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
                <th>Rating</th>
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
                $rate=number_format($row['avg_rate'], 1);
                echo "<td>{$i}</td>
                <td>{$row['rest_name']}</td>
                <td>{$row['city_name']}</td>
                <td>{$row['locality_name']}</td>
                <td>{$rate}</td>
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