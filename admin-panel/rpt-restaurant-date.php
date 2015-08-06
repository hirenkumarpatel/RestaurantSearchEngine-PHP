<?php
require '../class/db-connection.php';
connection();
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="tools/zebradp/css/mooncake/zebra_datepicker.css" media="screen">

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
                <?php
                echo "<form method='post'>";
                echo "<input type='text' id='datepicker1' placeholder='Pick a date' name='date1' >";
                echo "<input type='text' id='datepicker2' placeholder='Pick a date' name='date2'>";
                echo "<input type='submit' value='Filter'>
                    </form>";
                ?>
            </div>
            <?php
            if ($_POST) {
                $date1 = $_POST['date1'] . " 00:00:01";
                $date2 = $_POST['date2'] . " 23:59:59";
                $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_reg_date between '{$date1}' and '{$date2}'  order by r.rest_reg_date desc";
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
                <th>Date</th>
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
                        $date1 = explode(" ", $row['rest_reg_date']);
                        $date2 = explode("-", $date1[0]);
                        $day = $date2[2];
                        $month = $date2[1];
                        $year = $date2[0];
                        echo "<td>{$i}</td>
                <td>{$row['rest_name']}</td>
                <td>{$row['city_name']}</td>
                <td>{$row['locality_name']}</td>
                <td>{$day}/{$month}/{$year}</td>
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
<?php
//include './themepart/footerscripts.php';
?>  
</body>
<script type="text/javascript" src="tools/zebradp/jquery-1.8.3.js"></script>
<script type="text/javascript" src="tools/zebradp/zebra_datepicker.min.js"></script>
    <script>
            $('#datepicker1').Zebra_DatePicker({
  format: 'Y-m-d',direction: 0,
   pair: $('#datepicker2')
});
$('#datepicker2').Zebra_DatePicker({
  format: 'Y-m-d',direction: 1
 
});
 </script>
<?php

?>
</html>