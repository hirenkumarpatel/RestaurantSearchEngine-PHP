<?php
session_start();
$foodie_id = 0;
if (isset($_SESSION['user_id'])) {
    $foodie_id = $_SESSION['user_id'];
}
require './class/db-connection.php';
connection();
include "./class/data-truncate.php";
?>

<html lang="en" >
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/zomato-style.css">
        <?php
        include './theme-part/header-script.php';
        $qry;
        $msg = "";
        $qry = mysql_real_escape_string($_GET['qry']);
        if (!isset($_GET['qry']) || empty($_GET['qry'])) {
            header("location:restaurant-display.php");
        }
        ?>
        <link rel="stylesheet" href="assets/jrating/jRating.jquery.css" type="text/css" />



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
                <div class="contact-banner"><img src="images/inner-banner-2.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 
            <?php
            $query = "select * from restaurant_detail r,locality l,city c,state s
                                    where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_id='{$qry}'";
            $result = mysql_query($query) or die(mysql_error());
            $record = mysql_num_rows($result);
            while ($row = mysql_fetch_array($result)) {
                $rest_id = $row['rest_id'];
                $rest_name = ucwords($row['rest_name']);
                $rest_map = $row['rest_map'];
                $owner_website = $row['rest_website'];
                $rest_address = ucwords($row['rest_address']);
                $rest_cost = $row['rest_cost'];
                $rest_time1 = $row['rest_time1_on'];
                $rest_time2 = $row['rest_time1_off'];
                $rest_time3 = $row['rest_time2_on'];
                $rest_time4 = $row['rest_time2_off'];
                $payment1 = explode(",", $row['rest_payment']);
                $rest_visit_counter = $row['rest_visit_counter'];
                if (empty($payment1[1])) {
                    $payment = ucwords($payment1[0]);
                    $rest_payment = "Only {$payment}";
                } else {
                    $payment = ucwords($payment1[0]) . " and " . ucwords($payment1[1]);

                    $rest_payment = "{$payment}";
                }
                $rest_contact = $row['rest_contact'];
                $rest_type = $row['rest_pure_veg'];
                $rest_parking = $row['rest_parking'];
                $rest_dinein = $row['rest_dine_in'];
                $rest_delivery = $row['rest_delivery'];
                $rest_air_con = $row['rest_air_con'];
                $rest_wifi = $row['rest_wifi'];
                $rest_catering = $row['rest_catering'];
                $rest_bar = $row['rest_bar'];
                $rest_status = $row['rest_status'];
                $rest_cuisine_id = explode(",", $row['rest_cuisine_id']);
                $rest_cuisine_name = "";
                $locality_name = ucfirst($row['locality_name']);
                $state_name = ucfirst($row['state_name']);
                $city_name = ucfirst($row['city_name']);
                echo "<section class='res-main res-imagery-tshadow container clearfix pbot'>
                <div class=' grid_16 column mtop ptop0' style='margin-top:0px;'>
                    <div class='clear'></div>
                    <div class='grid_16 bbd'>
                        <div class='grid_12 grid-sm-12 column alpha'>
                            <div class='left mr10 res-title-container'>
                                <h1 class='res-main-name left'>
                                    <a href='' class='rest_header' style='font-size: 28px;' title='{$rest_name}'>
                                        {$rest_name}
                                    </a>
                                </h1>
                            </div>

                            <div class='res-main-subzone-links left'>
                                <div class='left ttupper'><a class='nhu' href=''><b class='grey-text'>{$locality_name}</b></a></div>
                                
                                <div class='clear'></div>
                            </div>";

                echo "<div class='clear'></div>
                        </div>";
                $query1 = "select count(rt.rate) as total_vote,avg(rt.rate)as avg_rate from restaurant_detail r,rating rt where  rt.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rt.rest_id";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1) {
                    $rest_rate = number_format($row1['avg_rate'], 1);
                    $rest_vote = $row1['total_vote'];
                } else {
                    $rest_rate = 0;
                    $rest_vote = 0;
                }
                echo "<div class='grid_4 grid-sm-4 column omega res-rating-cont-main' style='float:right;margin-right:20px;'>
                            <div class='rating-info rrw-container rrw-container-112288 ' itemprop='aggregateRating' itemscope='' itemtype='http://schema.org/AggregateRating'>
                                <div class='res-rating pos-relative clearfix'>
                                    <div  class=' rating-div small-rating rrw-aggregate level-7' style='padding:0px;'>
                                      {$rest_rate}<span class='rating-upon'>/5</span>                            </div>
                                    <div class='res-rating-rhs'>
                                        <div class='rating-votes-div rrw-votes'>
                                            <span class='tooltip_formatted fbold'>Based on <span itemprop='ratingCount'>{$rest_vote}</span> votes</span>                                </div>
                                    </div>
                                </div>
                                <div class='clear'></div>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <div class='clear'></div>
                    </div>";


                echo "<div class='grid_16 bbd pb5 pt5'>
                        <div class='grid_16 column alpha phone-details '>
                            <div class='clear'></div>
                            <div id='resinfo-phone' class='p-relative'>

                                <div class='bold ttupper res-main-label column alpha'>Phone:</div>

                                <div class='grid_14 column omega res-main-phone'>
                                    <div class='phone left' id='phoneNoString'>
                                        <div class='column alpha'>
                                            <span class='tel'>{$rest_contact}</span>

                                        </div>
                                    </div>


                                    <div class='clear'></div>
                                </div>
                                <div class='clear'></div>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <div class='clear'></div>
                        <div class='grid_16'>
                            <div class='res-main-address clearfix'>
                                <div class='bold res-main-label column alpha ttupper'>Address:</div>
                                <div class='grid_14 column omega'>
                                    
                                    <h4 class='res-main-address-text left' itemprop='address' itemscope='' itemtype=''>
                                        {$rest_address}<span  itemprop='addressCountry'> , {$state_name}, India</span>                            </h4>
                                    <!-- Link for Chain -->
                                    <div class='res-main-address-links left'>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <div class='clear'></div>
                    </div>
                    <!-- phone and address - end -->

                    <div class='grid_16 ptop0 pbot p-relative res-page-stats-cont'>
                        <div class='column alpha res-action-box'>
                            <div class='clearfix'>
                                <div class='res-act-button left'>
                                    <a href='foodie-favorite-add.php?qry={$rest_id}' data-icon='Æ' title='Add to favorite' > </a>
                                </div>

                                <div class='res-act-button left'>
                                    <a href='foodie-wish-list-add.php?qry={$rest_id}' title='Add to wishlist'  data-icon='w'> </a>
                                </div>

                                <div class='res-act-button left'>
                                    <a href='foodie-been-there-add.php?qry={$rest_id}' title='Add as been there' data-icon='E' > </a>
                                </div>
                            </div>
                            <div class='clear'></div>
                        </div>
                        <div class='grid_4 res-add-review-box left'>
                            <div class='left'>
                                <div class='grid_4 your-rating rating-widget ratings-wrapper  rating-widget-res_112288' data-res_id='112288' data-rating-for='restaurant' data-review_id=''>
                                    <div class='rating-top'>
                                        <div class='grey-text ttupper bold left'>Your Rating</div>
                                                                          
                                    </div>
                                    <div>";

                /*                 * *************-- rate -- */
                $query1 = "select * from rating where foodie_id='{$foodie_id}' and rest_id='{$rest_id}'";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1 > 0) {
                    $rate_value = $row1['rate'];
                    $rate_status = "isDisabled : true";
                } else {
                    $rate_value = 0;
                    $rate_status = "isDisabled : false";
                }
                echo"<div class='rating-bar' data-average=' {$rate_value}' data-id={$rest_id}></div>";

                /*                 * **********  rate end  ********* */
                echo"<div class='clear'></div>
                                      <div class='clear'></div>
                                    </div>
                                    <div class='clear'></div>
                                </div>                  
        
        
        </div>
                            <div class='clear'></div>
                        </div>";
                /*                 * ***********  for review and wishlist  ******** */

                $query1 = "select count(rw.rest_id) as total_review from restaurant_detail r,review rw where  rw.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rw.rest_id";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1) {

                    $rest_review = $row1['total_review'];
                } else {
                    $rest_review = 0;
                }
                $query1 = "select count(w.rest_id) as total_wish_list from restaurant_detail r,foodie_wish_list w where  w.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by w.rest_id";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1) {

                    $total_wish_list = $row1['total_wish_list'];
                } else {
                    $total_wish_list = 0;
                }
                $query1 = "select count(f.rest_id) as total_favorite from restaurant_detail r,foodie_favorite f where  f.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by f.rest_id";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1) {

                    $total_favorite = $row1['total_favorite'];
                } else {
                    $total_favorite = 0;
                }

                echo"<div class=' right res-stats-cont' style='margin-right:20px;'>
                            <div class='res-main-stats clearfix pos-relative'>

                                <div class='res-main-stats-stat'>
                                   
                                        <div class='res-main-stats-num'>{$rest_review}</div>
                                        <div class='res-main-stats-text'>reviews&nbsp;</div>
                                   
                                </div>
                                <div class='res-main-stats-stat'>
                                   
                                        <div class='res-main-stats-num'>{$total_favorite}</div>
                                        <div class='res-main-stats-text'>favorites</div>
                                   
                                </div>

                                <div class='res-main-stats-stat wishlist'>
                                    <div class='res-main-stats-num' id='wtt_count'>{$total_wish_list}</div>
                                    <div class='res-main-stats-text' id='wtt_text'>wishlists</div>
                                </div>
                                <div class='res-main-stats-stat wishlist'>
                                    <div class='res-main-stats-num' id='wtt_count'>{$rest_visit_counter}</div>
                                    <div class='res-main-stats-text' id='wtt_text'>Visits</div>
                                </div>
                                

                            </div>
                        </div>
                        <div class='clear'></div>
                    </div>
                </div>
            </section>";

                $query1 = "select count(rp.rest_id) as total_photo from restaurant_detail r,restaurant_photo rp where  rp.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rp.rest_id";
                $result1 = mysql_query($query1) or die(mysql_error());
                $row1 = mysql_fetch_array($result1);
                if ($row1) {

                    $total_photo = $row1['total_photo'];
                } else {
                    $total_photo = 0;
                }
                echo "<section class='res-tabs '>
                <div class='container' id='mainframe'>
                    <div class='grid_16 column'>
                        <div class='tabs-container clearfix'>
                            <div class='grid_10 column alpha'>
                                <a id='tabtop'></a>
                                 <ul class='tabs clearfix'>
                                <li class='selected'><h2><a href='restaurant-display-detail.php?qry={$rest_id}'>info</a></h2></li>
                                <li class='' ><h2><a href='restaurant-display-menu.php?qry={$rest_id}'>Menu</a></h2></li>
                                <li class='' ><h2><a href='restaurant-display-photo.php?qry={$rest_id}'>Photo&nbsp;({$total_photo})</span></a></h2></li>
                               </ul><div class='clear'></div>                  
                                </div>
                            <div class='clear'></div>
                        </div>
                        <div class='clear'></div>
                    </div>
                    <div class='clear'></div>
                </div>
                <div class='clear'></div>
            </section>";
                /*                 * *********   features   ******************** */

                if ($rest_type == 1) {
                    $rest_type_title = "Pure Vegetarian";
                    $rest_type = "<span data-icon='V' style='font-size:30px;color:green;margin-left:0px;padding:20px 0px;'> </span><div class='res-info-feature-text'>Pure Vegetarian</div>";
                } else {
                    $resttype = 'Serves Non-Veg';
                    $rest_type = "<span data-icon='V' style='font-size:30px;color:#a80000;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Non Veg. Available</div>";
                }
                if ($rest_wifi == 1) {
                    $rest_wifi = "<span data-icon='å' style='font-size:30px;color:gray;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Wifi Available</div>";
                } else {
                    $rest_wifi = "";
                }
                if ($rest_air_con == 1) {
                    $rest_air_con = "<span data-icon='&' style='font-size:30px;color:skyblue;margin-left:0px;'></span><div class='res-info-feature-text'>Air Conditioner</div>";
                } else {
                    $rest_air_con = "";
                }

                if ($rest_parking == 1) {
                    $rest_parking = "<div class='res-info-feature-text'><img src='images/parking.png' style='margin-left:0px;height:30px;width:30px;'>&nbsp;&nbsp;Parking Available</div>";
                } else {
                    $rest_parking = "";
                }
                if ($rest_dinein == 1) {
                    $rest_dinein = "<span data-icon='D' style='font-size:30px;color:#a80000;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Dine in</div>";
                } else {
                    $rest_dine_in = "";
                }
                if ($rest_delivery == 1) {
                    $rest_delivery = "<span data-icon='d' style='font-size:30px;color:#484548;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Home Delivery</div>";
                } else {
                    $rest_delivery = "";
                }
                if ($rest_catering == 1) {
                    $rest_catering = "<span data-icon='G' style='font-size:30px;color:#424842;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Catering Available</div>";
                } else {
                    $rest_catering = "";
                }
                if ($rest_bar == 1) {
                    $rest_bar = "<span data-icon='b' style='font-size:30px;color:blue;margin-left:0px;padding:20px 0px;'></span><div class='res-info-feature-text'>Bar Available</div>";
                } else {
                    $rest_bar = "";
                }

                echo"<div class='container' id='mainframe'>
                <section class='section'>
                    <div class='grid_16 column'>
                        <div class='grid_14 container-content mbot2 brstd column'>
                            <div class='clear'></div>
                            <div class='icont'>

                                <div class='ipadding info-tab'>
                                    <div class='tshadow'>    

                                        <div class='res-info-group clearfix' style='margin-bottom:20px;'>
                                            <div class='left alpha'>
                                                <h3 class='res-info-icon' data-icon='¥'>Qwiches info</h3>
                                            </div>
                                            <div class='res-info-highlights'>
                                                <label class='z-label'>Special Features</label>
                                                <div class='res-info-feature'>
                                                    <!--<div data-icon='´' class='res-info-feature-icon icon_green icon_delivery' title='Home Delivery'></div><div class='res-info-feature-text'>Home Delivery</div>-->
                                                    {$rest_air_con}{$rest_catering}{$rest_type}{$rest_wifi}{$rest_dinein}{$rest_delivery}{$rest_bar}{$rest_parking}
                                                </div>
                                              </div>
                                        </div>";
                /*                 * ********  cuisine name   ************** */


                foreach ($rest_cuisine_id as $value) {
                    $query2 = "select cuisine_name from cuisine where cuisine_id = '{$value}'";
                    $result2 = mysql_query($query2) or die(mysql_error());
                    $row2 = mysql_fetch_array($result2);
                    if ($row2) {
                        $rest_cuisine_name = $rest_cuisine_name . $row2['cuisine_name'] . ", ";
                    }
                }
                echo "<div class='res-info-group clearfix'>
                                            <div class='left alpha'>
                                                <h3 class='res-info-icon' data-icon='C'>Cuisines served in {$rest_name}</h3>
                                            </div>

                                            <div class='grid_12 left'>
                                                <div class='grid_7 column alpha'>
                                                    <div class='grid_6 '>
                                                        <label class='z-label'>Cuisines</label>
                                                        <div class='pb5 res-info-cuisines clearfix'>{$rest_cuisine_name}</div>                        <div class='clear'></div>
                                                    </div>
                                                    <div class='clear'></div>
                                                </div>";

                /*                 * ************  menu photo   ********* */
                $query = "select * from restaurant_menu where rest_id='{$qry}'";
                $result = mysql_query($query) or die("Error in Selecting query :" . mysql_error());

                echo" <div class='column omega'>
                                                                        <div class='right res-info-menu-div'><div>
                                                                                <div class='res-info-headline'>
                                                                                    <a class='left z-label zred' href='menu#tabtop'>Menu</a>
                                                                                    <div class='clear'></div>
                                                                                </div>
                                                                                <div class='clear'></div>";
                while ($row = mysql_fetch_array($result)) {

                    $rest_menu = "Admin-Panel/rest/rest-menu/" . $row['rest_menu'];
                    echo "<a href='menu?medium=mobile#tabtop' class='res-info-thumbs'>
                                              <img src='{$rest_menu}' alt='Scanned menu for {$rest_name}'></a>";
                }

                echo"<div class='clear'></div></div></div>                </div>
                                                                    <div class='clear'></div>
                                            </div>
                                        </div>



                                        <div class='res-info-group clearfix'>
                                            <div class='left alpha'>
                                                <h3 data-icon='F' class='res-info-icon'>Cost and prices at{$rest_name}</h3>
                                                <div class='clear'></div>
                                            </div>
                                            <div class='column omega res-info-detail'>
                                                <label class='z-label left'>Cost&nbsp;</label>
                                                <a href='' class='tooltip left lh26px'>?</a>
                                                <div class='clear'></div>
                                                <span style='line-height:22px;margin-top:2px;display:block;'><span itemprop='priceRange'><span class='cft-big'><span>Rs. </span> {$rest_cost}</span> for two people (approx.)</span></span>

                                                <div class='ht5'></div>
                                                <div class='mt5'>

                                                    <div class='column alpha grid_6'>
                                                        <span class='res-info-payment res-info-icon' data-icon='I'>Payment options at Qwiches</span>
                                                        <span itemprop='paymentAccepted'>{$rest_payment} accepted</span>                                    </div>
                                                    <div class='clear'></div>
                                                    <div class='clear'></div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class='res-info-group clearfix'>
                                            <div class='left alpha'>
                                                <h3 class='res-info-icon' data-icon='c'>Qwiches, Navrangpura timings</h3>
                                            </div>
                                            <div class='column omega res-info-detail'>
                                                <div>
                                                    <label class='z-label left'>Opening hours</label>
                                                    <span class='open-now-res left'>Open Now</span>
                                                    <div class='clear'></div>
                                                    <span class='res-info-timings'><strong>Morning Time :</strong>{$rest_time1} to {$rest_time2}&nbsp;<strong>Evening Time :</strong>{$rest_time3} to {$rest_time4}</span>
                                                    <!-- Nightlife fields -->
                                                    <!--Happy Hours -->

                                                </div>
                                                <div class='clear'></div>
                                            </div>

                                        </div>";
                /*                 * *********  photo   *************** */
                $query1 = "select * from restaurant_photo where rest_id='{$rest_id}'";
                $result1 = mysql_query($query1) or die(mysql_error());
                $record = mysql_num_rows($result1);
                echo"<div class='res-info-group parentPhotoBox clearfix'>
                                            <div class='left alpha'>
                                                <h3 class='res-info-icon res-p-icon' data-icon=')'>Qwiches Pictures</h3>
                                            </div>
                                            <label class='z-label' id='resinfo-photos'>Photos</label>
                                            <div class='grid_11 left photosContainer' data-res_id='112288'>

                                                <div class='res-photo-thumbnails'>";
                $i = 0;
                while ($row1 = mysql_fetch_array($result1)) {
                    echo "<a href='' class='res-info-thumbs'>
                         <img src='Admin-Panel/rest/rest-photo/{$row1['rest_photo']}' class='res-photo-thumbnail' data-type='res' data-index='0' alt='{$rest_name} photo'></a>";
                    $i++;
                    if ($i >= 5) {
                        echo "<div class='left-photo-count user-info-thumbs-load-more res-photo-thumbnail'>+" . ($record - 5) . "</div>";
                        break;
                    }
                }


                echo "<div class='clear'></div>
                                        </div>

                                        <div class='clearfix'>
                                            <div id='restaurant-details'>

                                            </div>
                                        </div>

                                        <div class='clear'></div>
                                        <div class='info-footer-links pbot0 ptop'>

                                            <a href='restaurant-edit.php?qry={$rest_id}' style='padding: 10px 12px;float:right;background: #a80000;text-transform:uppercase;color:#fff;float:left;text-decoration:none;'>Edit Information</a>

                                            <div class='clear'></div>
                                        </div>
                                        <div class='clear'></div>


                                    </div>                    </div>
                                <div class='clear ieclear'></div>

                            </div>
                        </div>";
                echo"</div></div>";


                /*                 * *****  map iframe ********************** */

                echo "<div class='span3' style='width:330px;'>
          <div class='location-map'>
            <div class='location-map-head'>
              <div class='left-side'>
                <h5>Meet us!</h5>
               </div>
              
            </div>
            <div class='map-box'>
              <div  style='width:100%; height:430px; vertical-align:central;'>";

echo "<iframe src='{$rest_map}'  frameborder='0' style='border:0;height:100%;width:100%;'></iframe>";

                echo "</div>
            </div>
            <div class='bottom-sec'> <a href='#' class='week'>ALL WEEK</a> </div>
          </div>
        </div>";


                /*                 * ****  lopcation map ends  ******* */


                echo "</section>
                <div class='clear'></div>
            </div>
            <div class='clear'></div>


            <div class='clear ieclear'></div>

            <div class='clear ieclear'></div>";
            }
            ?>




            <?php
            $query = "select f.foodie_name,f.foodie_photo,r.rest_name,l.locality_name,rw.* 
                    from foodie_detail f,restaurant_detail r, locality l,review rw
                    where rw.foodie_id=f.foodie_id and rw.rest_id=r.rest_id and r.locality_id=l.locality_id and rw.rest_id='{$rest_id}' order by rw.review_date desc";
            $result = mysql_query($query) or die(mysql_error());
            $record = mysql_num_rows($result);
            echo "<section id='content' class='container'> 
                <!--Blog Page Section Start-->
                <section class='blog-page-section'>
                    <div class='row-fluid'>
                        <div class='span12'>
                            <div class='heading'>
                                <h1>Reviews</h1>
                            </div>
                        </div>


                    </div>
                </section>";

                echo "<section class='testimonial-page'>
                        <div class='row-fluid'>";
            if ($record > 0) {
                
                            echo"<ul>";
                while ($row = mysql_fetch_array($result)) {
                    $review_id = $row['review_id'];
                    $date1 = explode(" ", $row['review_date']);
                    $date2 = explode("-", $date1[0]);
                    $day = $date2[2];
                    $month = $date2[1];
                    $year = $date2[0];
                    $foodie_photo = $row['foodie_photo'];
                    if ($foodie_photo == "") {
                        $foodie_photo = "admin-panel/photo/not_avail.png";
                    } else {
                        $foodie_photo = "admin-panel/photo/foodie-photo/{$row['foodie_photo']}";
                    }
                    $data = truncate($row['review_text'], 300, " ");
                    $foodie_name = $row['foodie_name'];
                    $rest_name = $row['rest_name'];
                    $query1 = "select count(*)as total_comment from comment where review_id='{$review_id}'";
                    $result1 = mysql_query($query1) or die(mysql_error());
                    $row1 = mysql_fetch_array($result1);
                    $total_commment = $row1['total_comment'];
                    echo "<li>
                          <div class='span2'>
                                        <div class='testo-frame-box'>
                                            <div class='testo-frame'>
                                            <img src='{$foodie_photo}' alt='img' style='height:120px;width:100px;'>
                                            </div>
                                            <strong class='name'>{$foodie_name}</strong>
                                        </div>
                                    </div>
                                    <div class='span10'>
                                        <div class='testo-text'>
                                            <blockquote>
                                                <p>{$data}</p>
                                            </blockquote>
                                            <div class='testo-bottom'>
                                                <div class='testo-rating-box'> <strong class='date'>{$day}/{$month}/{$year}</strong>
                                                    
                                                </div>
                                                <div class='replies-box'> <strong class='replies'>{$total_commment} Comments</strong> </div>
                                                <a href='review-detail.php?qry={$review_id}'><strong class='name'>Read More</strong></a> </div>
                                        </div>
                                    </div>
                                </li>";
                }

                echo "</ul>";
                        
            }

            if (isset($_SESSION['user_id'])) {
                echo "<form action='review-add.php' method='post' class='comment-form'>
                          <div class='comment-row'>
                            <h4>Add Review</h4>
                          </div>
                          <input type='hidden' value='{$rest_id}' name='rest_id'>
                          <textarea name='review_text' cols='10' rows='10' placeholder='Reviews*' ></textarea>
                          <button class='btn-submit2'>Submit</button>
                        </form>";
            }
            echo"</div>
                    </section>";
            ?>


            
        </div>
        <?php
            /*  <!--Footer Area End--> */

            include './theme-part/footer.php';
            ?>
            <!--Footer Area End-->
        <!--Wrapper End--> 
        <?php
        include './theme-part/footer-script.php';

        mysql_query("update restaurant_detail set rest_visit_counter=rest_visit_counter+1 where rest_id='{$rest_id}'");
        mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
        ?>

        <script type="text/javascript" src="assets/jrating/jRating.jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.basic').jRating();

                $('.rating-bar').jRating({
                    length: 5,
                    decimalLength: 0,
<?php echo $rate_status; ?>,
                            onSuccess: function() {
                                alert('Success : your rate has been saved :)');
                            },
                    onError: function() {
                        alert('Error : please retry');
                    }

                });


            });
        </script>
        
    </body></html>