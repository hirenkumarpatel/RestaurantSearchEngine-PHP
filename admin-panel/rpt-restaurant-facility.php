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
                <h2> Facility wise restaurant details</h2>
            </div>
            <div id="filter">
                <?php 
                    echo "<form method='post'>";
                    
                    
                    
                   echo "<select name='facility' > 
                    <option value=''>Select Facility</option>
                    <option value='Dine in'>Dine in</option>
                    <option value='Delivery'>Delivery</option>
                    <option value='Catering'>Catering</option>
                    <option value='Take Away'>Take Away</option>
                    </select>";
                   echo "<input type='submit' >";
                  echo"  </form>";
                
                ?>
            </div>
            <?php
            if ($_POST) {
                
                $facility=$_POST['facility'];
                if($facility=='Dine in')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_dine_in='1'";  
                }
                elseif($facility=='Delivery')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_delivery='1'";  
                }
                 elseif($facility=='Catering')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_catering='1'";  
                }
                 elseif($facility=='Take Away')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_take_away='1'";  
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
                <th>Area</th>
                <th>Facility</th>
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
                <td>{$facility}</td>
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