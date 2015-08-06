<?php
session_start();
require './class/db-connection.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Restaurant|RestaurantSearchEngine</title>
        <link rel="stylesheet"  type="text/css" href="css/zomato-style.css"/>
        <?php include './theme-part/header-script.php'; ?>
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
            <div class="container mbot2" >
                <div class="grid_16 column">
                    <div class="heading">
                                    <h1>Top Restaurants</h1>
                                </div>
                </div>
                <article class="mbot">
                    <div class="grid_16 column">
                        <?php
                        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id and c.city_id='{$city}' group by rt.rest_id order by avg_rate desc";
                        $result = mysql_query($query) or die(mysql_error());
                        $i = 0;
                        while ($row = mysql_fetch_array($result)) {
                            $i++;
                            $rest_id = $row['rest_id'];
                            $rest_name = ucwords($row['rest_name']);
                            $locality_name = ucwords($row['locality_name']);
                            $city_name = ucwords($row['city_name']);
                            
                            $query1="select rp.rest_photo from restaurant_photo rp,restaurant_detail r where rp.rest_id=r.rest_id and r.rest_id='{$rest_id} group by r.rest_id'";
                            $result1 = mysql_query($query1) or die(mysql_error());
                            $row1 = mysql_fetch_array($result1);
                            $rest_photo = $row1['rest_photo'];
                            if ($rest_photo != "") {
                                $rest_photo = "Admin-Panel/rest/rest-photo/" . $rest_photo;
                            } else {
                                $rest_photo = "Admin-Panel/rest/rest-photo/rest_not_avail.png";
                            }
                            echo "<div class='grid_1by4 column alpha'>
                            <div class='top-res-box '>
                                <a href='restaurant-display-detail.php?qry={$rest_id}'>
                                    <div class='top-res-box-bg' style='background-image: url({$rest_photo});'>

                                        <div class='top-res-box-rank'><span class='hash'>#</span>{$i}</div>
                                    </div>
                                </a>";
                            $query1 = "select avg(rt.rate)as avg_rate from restaurant_detail r,rating rt where  rt.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rt.rest_id";
                            $result1 = mysql_query($query1) or die(mysql_error());
                            $row1 = mysql_fetch_array($result1);
                            if ($row1) {
                                $total_rate = number_format($row1['avg_rate'], 1);
                            } else {
                                $total_rate = 0;
                            }
                            echo"<div class='top-res-box-details'>
                                    <div  class='rating-div right '>
                                        {$total_rate}
                                    </div>
                                    <div class='column' style='width:225px'>
                                        <div class='left' style='width:225px'>
                                            <a href='restaurant-display-detail.php?qry={$rest_id}'>
                                                <h4 class='top-res-box-name' title='{$rest_name}'><span>{$rest_name}</span></h4>
                                            </a>
                                            <div class='clear'></div>
                                        </div>
                                        <div class='left grid_4'>
                                            <div class='top-res-box-zone'>
                                                <a class='cblack' href=''>
                                                    {$locality_name},&nbsp;{$city_name}
                                                </a>
                                            </div>
                                            <div class='clear'></div>
                                        </div>
                                        <div class='clear'></div>
                                    </div>
                                    <div class='clear'></div>";

                            $query1 = "select count(rp.rest_id) as total_photo from restaurant_detail r,restaurant_photo rp where  rp.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rp.rest_id";
                            $result1 = mysql_query($query1) or die(mysql_error());
                            $row1 = mysql_fetch_array($result1);
                            if ($row1) {

                                $rest_photo = $row1['total_photo'];
                            } else {
                                $rest_photo = 0;
                            }
                            $query1 = "select count(rw.rest_id) as total_review from restaurant_detail r,review rw where  rw.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rw.rest_id";
                            $result1 = mysql_query($query1) or die(mysql_error());
                            $row1 = mysql_fetch_array($result1);
                            if ($row1) {

                                $rest_review = $row1['total_review'];
                            } else {
                                $rest_review = 0;
                            }

                            echo"<div class='search-result-links mt5'>
                                        <div class='column'>
                                            <div class='left'>
                                                <a href=''>
                                                    Menu
                                                </a>
                                            </div>
                                            <div class='grey-text left'>&nbsp;&nbsp;·&nbsp;&nbsp;</div>
                                            <div class='left'>
                                                <a href=''>
                                                    {$rest_photo} photos
                                                </a>
                                            </div>
                                            <div class='grey-text left'>&nbsp;&nbsp;·&nbsp;&nbsp;</div>
                                            <div class='left'>
                                                <a href=''>
                                                    {$rest_review} Reviews
                                                </a>
                                            </div>
                                            <div class='clear'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                        }
                        ?>





                    </div>
                </article>
                <div class="clear"></div>
            </div>
            <?php
            include './theme-part/footer.php';
            ?>
            <!--Footer Area End--> 

        </div>
        <?php include './theme-part/footer-script.php'; ?>

    </div>
    <!--/ END Row -->
</div>
<!--/ END Content -->

</section>
<!--/ END Template Main Content -->

</body>
</html>