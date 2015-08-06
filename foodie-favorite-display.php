<?php
session_start();
require './class/db-connection.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
?>
<!doctype html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <title>Restaurant Search Engine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/zomato-style.css"/>

<?php
include './theme-part/header-script.php';
?>

    </head>

    <body>
        <!--Wrapper Start-->
        <div id="wrapper"> 
            <!--Header Start-->
            <header id="header"> 
                <div class="container">
<?php
include './theme-part/header.php';
?>
                </div>
            </header>
            <!--Banner Start-->
            <section id="banner" class="height">
                <div class="contact-banner"><img src="images/inner-banner-4.jpg" alt="img"></div>
            </section>
            <!--Banner End-->
<?php
$query = "select * from restaurant_detail r,foodie_favorite wl,locality l,city c 
where wl.rest_id=r.rest_id and r.locality_id=l.locality_id and r.city_id=c.city_id and wl.foodie_id='{$_SESSION['user_id']}'";
$result = mysql_query($query) or die(mysql_error());
$record = mysql_num_rows($result);
?>
            <section>
                <div class="container">


                    <div class="grid_10 column alpha pos-relative">

                        <div class="even mbot0 ptop0">
                            <div class="plr15"><h2 class="section-heading mb0">Favorite <span class="grey-text"><?php echo $record; ?></span></h2></div>
                            <div class='zs-following-list pbot0 clearfix'>
<?php
while ($row = mysql_fetch_array($result)) {
    $rest_id = $row['rest_id'];
    $rest_name = ucwords($row['rest_name']);
    $locality_name = ucwords($row['locality_name']);
    $city_name = ucwords($row['city_name']);

    $query1 = "select rest_photo from restaurant_photo where rest_id='{$rest_id}' limit 1";
    $result1 = mysql_query($query1) or die(mysql_error());
    $row1 = mysql_fetch_array($result1);
    if ($row1) {
        $rest_photo = "admin-panel/rest/rest-photo/{$row1['rest_photo']}";
    } else {
        $rest_photo = "admin-panel/rest/rest-photo/rest_not_avail.png";
    }
    $query1 = "select rate,r.rest_id from restaurant_detail r,rating rt where  rt.rest_id=r.rest_id and r.rest_id='{$rest_id}' and foodie_id='{$_SESSION['user_id']}'";
    $result1 = mysql_query($query1) or die(mysql_error());
    $row1 = mysql_fetch_array($result1);
    if ($row1) {
        $rest_rate = number_format($row1['rate'], 1);
        
        
    } else {
        $rest_rate = 0;
        
    }
    echo " <div class='plr15'>
                                    <div class='grid_6 mbot0'><div class='actn'>
                                            <div class='actn-im'>
                                                <a href=''><img src='{$rest_photo}'></a>
                                            </div>
                                            <div class='actn-data'>
                                                <div class='actn-data-l'>
                                                    <a class='actn-e-name js_jewel_popup' href='' data-entity_id='110401' data-entity_type='RESTAURANT'>{$rest_name}</a>
                                                    <div class='clear'></div>
                                                    <div>
                                                        <a class='cblack' href='' title='Ellis Bridge'>
                                                            {$locality_name}, {$city_name}
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class='actn-data-r '>
                                                    <div class='rating-div'>{$rest_rate}</div>
                                                    <div style='margin-left:20px;'><a href='foodie-favorite-delete.php?qry={$rest_id}' title='Remove from favorite'><span class='icon-trash' style='font-size:35px;color:#2d2d2d;text-decoration:none;'></span></a></div>
                                                    
                                                    <div class='clear'></div>
                                                </div>
                                                <div class='clear'></div>
                                            </div>
                                            <div class='clear'></div>
                                        </div>
                                    </div>

                                </div>";
                       
}
?>
                            </div>

                        </div>





                    </div>



                    <div class="clear"></div>


                </div>
            </section>


        </div>
        <div class="clear"></div>
    </div>
</section>

</section>
<!--Content Area End--> 

<!--Footer Area Start-->
<?php
include './theme-part/footer.php';
?>
<!--Footer Area End--> 
</div>
<!--Wrapper End--> 

<!-- jQuery --> 
<?php
include './theme-part/footer-script.php';
?>

</body>

</html>

