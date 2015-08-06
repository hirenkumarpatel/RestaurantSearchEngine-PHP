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
                <h2>Feature wise restaurant details</h2>
            </div>
            <div id="filter">
                <?php 
                $air_con = isset($_POST['feature']) && $_POST['feature']=='Air Condition'? 'selected' : ' ';
                $wifi = isset($_POST['feature']) && $_POST['feature']=='Wifi'? 'selected' : ' ';
                $candle_light = isset($_POST['feature']) && $_POST['feature']=='Candle Light'? 'selected' : ' ';
                $live_music = isset($_POST['feature']) && $_POST['feature']=='Live Music'? 'selected' : ' ';
                $parking = isset($_POST['feature']) && $_POST['feature']=='Parking'? 'selected' : ' ';
                $pure_veg = isset($_POST['feature']) && $_POST['feature']=='Pure Veg'? 'selected' : ' ';
                $bar = isset($_POST['feature']) && $_POST['feature']=='Bar'? 'selected' : '';
                    echo "<form method='post'>";
                    echo "<select name='feature' > 
                    <option value=''>Select Feature</option>
                    <option   value='Air Condition' $air_con>Air Condition</option>
                    <option value='Wifi' $wifi>Wifi</option>
                    <option value='Candle Light' $candle_light>Candle Light</option>
                    <option value='Live Music' $live_music>Live Music</option>
                    <option value='Parking' $parking>Parking</option>
                    <option value='Pure Veg.' $pure_veg>Pure Veg.</option>
                    <option value='Bar' $bar>Bar</option>
                    </select>";
                   echo "<input type='submit' value='Filter'>
                    </form>";
                
                ?>
            </div>
            <?php
            if ($_POST) {
                
               $feature=$_POST['feature'];
                if($feature=='Air Condition')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_air_con='1'";  
                }
                elseif($feature=='Wifi')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_wifi='1'";  
                }
                 elseif($feature=='Candle Light')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_candle_light='1'";  
                }
                 elseif($feature=='Live Music')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_live_music='1'";  
                }
                 elseif($feature=='Parking')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_parking='1'";  
                }
                 elseif($feature=='Pure Veg.')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_pure_veg='1'";  
                }
                 elseif($feature=='Bar')
                {
                  $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rest_bar='1'";  
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
                <th>Feature</th>
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
                <td>{$feature}</td>
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