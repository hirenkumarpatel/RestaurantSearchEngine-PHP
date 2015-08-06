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
                <h3> Rate wise Restaurant Details</h3>
            </div>
            <div id="filter">
                <?php 
                    echo "<form method='post'>";
                   
                     echo "<select name='min_rate' > 
                    <option value=''>Min Rate</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    </select>&nbsp";
                      echo "<select name='max_rate' > 
                    <option value=''>Max Rate</option>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    </select>&nbsp";
                    echo "<input type='submit' value='Filter'>
                    </form>";
                
                ?>
            </div>
            <?php
            if ($_POST) {
                $min_rate=$_POST['min_rate'];
                $max_rate=$_POST['max_rate'];
                $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id group by rt.rest_id having avg_rate between '{$min_rate}' and '{$max_rate}' order by avg_rate";
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
                $n = 1;
                while ($row = mysql_fetch_array($result)) {
                    if ($n % 2 == 0) {
                        echo "<tr class='even'>";
                    } 
                    else {
                        echo "<tr class='odd'>";
                    }
                $rate=number_format($row['avg_rate'], 1);
                echo "<td>{$n}</td>
                <td>{$row['rest_name']}</td>
                <td>{$row['city_name']}</td>
                <td>{$row['locality_name']}</td>
                <td>";
                $i=$rate;$j=0;
                while($i>0)
                {
                    
                    if($i>0 and $i<1)
                    {
                        echo "<img src='img/tools/star3.png' style='height:15px;width:15px;'>";  
                    }
                    else
                    {
                        echo "<img src='img/tools/star1.png' style='height:15px;width:15px;'>";  
                    }
                  $i--;$j++;
                }
                while ($j<5)
                {
                    echo "<img src='img/tools/star2.png' style='height:15px;width:15px;'>";  
                    $j++;
                }
                echo"</td>
                <td width='8%' align='right'><span class='icone-rupee'> {$row['rest_cost']}</span></td>
                <td align='center'>{$row['rest_time1_on']} to {$row['rest_time1_off']}</td>
                <td align='center'>{$row['rest_time2_on']} to {$row['rest_time2_off']}</td>
                </tr>";
                        $n++;
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