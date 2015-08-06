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
                <h3> subscription wise Restaurant Details</h3>
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

                    echo "<select name='subscr'>";
                    echo "<option value=''>Subscription</option>";
                    echo "<option value='2'>All</option>";
                    echo "<option value='1'>Active</option>";
                    echo "<option value='0'>Expired</option>";
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
                $subscr = $_POST['subscr'];
                $today=date("Y-m-d h:i:s");
                if($subscr==0)
                {
                $query = "select *,DATEDIFF('{$today}',r.rest_reg_date)as days from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and s.state_id='{$state_id}'and c.city_id='{$city_id}' having days>365";
                }
                elseif ($subscr==1) 
                {
                    $query = "select *,DATEDIFF('{$today}',r.rest_reg_date)as days from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and s.state_id='{$state_id}' and c.city_id='{$city_id}' having days<=365";
                }
                else 
                {
                    $query = "select *,DATEDIFF('{$today}',r.rest_reg_date)as days from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and s.state_id='{$state_id}' and c.city_id='{$city_id}'";
                }
                
                $result = mysql_query($query) or die(mysql_error());
                $count = mysql_num_rows($result);
                echo "<h3 class='label1'>Total {$count} records found.</h3>";
                if ($count > 0) {
                    
                    echo "<table border='1' class='report'>
                    <tr>
                <th>NO.</th>
                <th>Restaurant</th>
                <th>City</th>
                <th>Owner</th>
                <th>Email Address</th>
                <th>Subscription</th>
                <th>days</th>
                
                
                </tr>";
                    $i = 1;
                    while ($row = mysql_fetch_array($result)) {
                        if ($i % 2 == 0) {
                            echo "<tr class='even'>";
                        } else {
                            echo "<tr class='odd'>";
                        }
                        $days=$row['days'];
                        $days_left=365-$days;
                        
                        if($days_left<0)
                        {
                            $subscr='Expired';
                            $days_left=0;
                        }
                        else 
                        {
                            $subscr='Active';
                        }
                        
                        echo "<td>{$i}</td>
                <td>{$row['rest_name']}</td>
                <td>{$row['city_name']}</td>
                 <td>{$row['rest_owner']}</td>    
                <td>{$row['rest_email']}</td>
                <td>{$subscr}</td>                  
                <td>{$days_left}</td> 
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