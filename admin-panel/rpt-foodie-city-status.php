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
                <h3> city wise foodie details</h3>
            </div>
            <div id="filter">
                <?php {
                    echo "<form method='post'>";

                    

                    $query = "select * from foodie_detail group by foodie_address";
                    $result = mysql_query($query) or die(mysql_error());
                    echo "<select name='foodie_address'>";
                    echo "<option value='#'>Select City</option>";
                    while ($row = mysql_fetch_array($result)) {
                        $foodie_address = ucwords($row['foodie_address']);
                        echo "<option value='{$row['foodie_address']}'>{$foodie_address}</option>";
                    }
                    echo "</select> ";

                    echo "<select name='status'>";
                    echo "<option value='#'>Select Staus</option>";
                    echo "<option value='1'>Active</option>"
                    . "<option value='0'>Block</option>";
                    echo "</select> ";
                   echo "<input type='submit' value='Filter'>
                    </form>";
                }
                ?>
            </div>
            <?php
            if ($_POST) {
                $foodie_address=$_POST['foodie_address'];
                $foodie_status=$_POST['status'];
                $query = "select * from foodie_detail where foodie_status='{$foodie_status}' and foodie_address='{$foodie_address}'";
                $result = mysql_query($query) or die(mysql_error());
                $count = mysql_num_rows($result);
                echo "<a href='' target='_blank' onclick='window.print();' ><img src='img/tools/print12.png' style='height:30px;width:30px;float:right;margin-top:-50px;'></a>";
                echo "<h6 class='label1'>Total {$count} records found.</h6>";
                
                if ($count > 0) {
                    
                    echo "<table border='1' class='report'>
                    <tr>
                <th>NO.</th>
                <th width='20%'>Foodie Name</th>
                <th>City</th>
                <th>Contact NO.</th>
                <th width='10%'>Email Address</th>
                <th>Status</th>
               </tr>";
                    $i = 1;
                    while ($row = mysql_fetch_array($result)) {
                        if ($i % 2 == 0) {
                            echo "<tr class='even'>";
                        } else {
                            echo "<tr class='odd'>";
                        }
                        if($row['foodie_status']==1)
                        {
                            $foodie_status="Active";
                        }
                        else
                        {
                            $foodie_status="Blocked"; 
                        }
                        $foodie_address=  ucwords($row['foodie_address']);
                        echo "<td>{$i}</td>
                        <td>{$row['foodie_name']}</td>
                        <td>{$row['foodie_address']}</td>
                        <td>{$row['foodie_contact']}</td>
                        <td>{$row['foodie_email']}</td>
                        <td>{$foodie_status}</td>
                       </tr>";
                        $i++;
                    }

                    echo "</table>";
                    echo "<hr class='line3'>";
                    
                }
            }
            ?>
        </div>
        </center>
    </body>
</html>