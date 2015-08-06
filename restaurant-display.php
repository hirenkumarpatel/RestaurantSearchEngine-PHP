<?php
session_start();
require './class/db-connection.php';
connection();
$records = "";
$search1 = "";
$filter = "";
$cuisine1="";
$sort = 0;
$city = "";
$qry;

mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");

if (isset($_SESSION['city'])) {

    $city = $_SESSION['city'];
} else {


    $query = "select city_id from city";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $city_list[] = $row['city_id'];
    }
    $_SESSION['city'] = array_rand($city_list, 1);
    $city = $_SESSION['city'];
}

if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
if (isset($_POST['city_id'])) {
    $city_id = mysql_real_escape_string($_POST['city_id']);
}
if (isset($_POST['search1'])) {
    $search1 = mysql_real_escape_string($_POST['search1']);
}
if (isset($_GET['cuisine1'])) {
    $cuisine1 = mysql_real_escape_string($_GET['cuisine1']);
}

if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
}
if (isset($_POST['rest_locality'])) {
    $rest_locality = mysql_real_escape_string($_POST['rest_locality']);
    if ($rest_locality != "") {

        $locality_query = "and r.locality_id='{$rest_locality}'";
    } else {
        $locality_query = "";
    }
}
if (isset($_POST['rest_cuisine'])) {
    $rest_cuisine = mysql_real_escape_string($_POST['rest_cuisine']);
    if ($rest_cuisine != "") {
        $cuisine_query = " and r.rest_cuisine_id like '%{$rest_cuisine}%' ";
    } else {
        $cuisine_query = "";
    }
}
if (isset($_POST['rest_cost'])) {
    if ($_POST['rest_cost'] != "") {
        $rest_cost1 = explode("-", mysql_real_escape_string($_POST['rest_cost']));
        $min_cost = $rest_cost1[0];
        $max_cost = $rest_cost1[1];
        $cost_query = " and r.rest_cost between '{$min_cost}' and '{$max_cost}' ";
    } else {
        $cost_query = " ";
    }
}
if (isset($_POST['rest_delivery'])) {
    $rest_delivery = 1;
    $delivery_query = "  and r.rest_delivery='1' ";
} else {
    $rest_delivery = 0;
    $delivery_query = " ";
}
if (isset($_POST['rest_dine_in'])) {
    $rest_dine_in = 1;
    $dine_in_query = " and r.rest_dine_in='1' ";
} else {
    $rest_dine_in = 0;
    $dine_in_query = "";
}
if (isset($_POST['rest_catering'])) {
    $rest_catering = 1;
    $catering_query = " and r.rest_catering='1' ";
} else {
    $rest_catering = 0;
    $catering_query = "";
}
if (isset($_POST['rest_take_away'])) {
    $rest_take_away = 1;
    $take_away_query = " and r.rest_take_away='1' ";
} else {
    $rest_take_away = 0;
    $take_away_query = "";
}
if (isset($_POST['rest_bar'])) {
    $rest_bar = 1;
    $bar_query = " and r.rest_bar='1' ";
} else {
    $rest_bar = 0;
    $bar_query = "";
}
if (isset($_POST['rest_pure_veg'])) {
    $rest_pure_veg = 1;
    $pure_veg_query = " and r.rest_pure_veg='1' ";
} else {
    $rest_pure_veg = 0;
    $pure_veg_query = "";
}
if (isset($_POST['rest_wifi'])) {
    $rest_wifi = 1;
    $wifi_query = " and r.rest_wifi='1' ";
} else {
    $rest_wifi = 0;
    $wifi_query = "";
}
if (isset($_POST['rest_air_con'])) {
    $rest_air_con = 1;
    $air_con_query = " and r.rest_air_con='1' ";
} else {
    $rest_air_con = 0;
    $air_con_query = "";
}
if (isset($_POST['rest_parking'])) {
    $rest_parking = 1;
    $parking_query = " and r.rest_parking='1' ";
} else {
    $rest_parking = 0;
    $parking_query = "";
}

/* * *************************** */

if (isset($_GET['sort'])) {
    $rest_sort = mysql_real_escape_string($_GET['sort']);
    $sort = 1;
}

/* * **************************** */
?>
<html lang="en" >
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Restaurants</title>
        <link rel="stylesheet" type="text/css" href="css/zomato-style.css">
       
        <?php
        include './theme-part/header-script.php';
        ?>
        <script>
            function sortRestaurant()
            {
                var e = document.getElementById("rest-sort");

                window.open(e.options[e.selectedIndex].value, "_self");
            }
        </script>



    </head>
    <body >
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
                
                <div class="contact-banner"><img src="images/inner-banner-1.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 

            <!--   Header and subtitle of Restaurants-------------------->
            <section>
                <div class="container">


                    <div class="grid_16 item">
                        <div class="bb grid_16" >
                            <div class="heading">
                                <?php
                                if (isset($_SESSION['city'])) {
                                    $query = "select city_name from city where city_id='{$city}'";
                                    $result = mysql_query($query) or die(mysql_error());
                                    $row = mysql_fetch_array($result);
                                    if ($row) {
                                        echo "<h1>Restaurants in {$row['city_name']}</h1>";
                                    }
                                } else {
                                    echo "<h1>Restaurants</h1>";
                                }
                                ?>


                            </div>

                            <div class="clear"></div>
                            <div class="clear"></div>


                        </div>

                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </section>
            <!--   Header and subtitle of Restaurants  ends  -------------------->





            <!------------- main Container      -------->
            <section class="ptop">
                <div id="mainframe" class="container">
                    <div class="grid_16 column">
                        <div class="grid_3 column alpha search-filter-container">

                            <!--    Filter section start           --->

                            <form  method="post">
                                <input type="hidden" name="filter" value="1">
                                <div class="search-filters-container">
                                    <div class="search-filters-top">


                                        <div class="search-filter-tab">
                                            <div id="filter-locations-html-area">
                                                <div class="search-filter-label loc-label">
                                                    <div class="active-label">Location</div>
                                                    <div class="clear"></div>
                                                    <?php
                                                    $query = "select * from locality";
                                                    $result = mysql_query($query) or die(mysql_error());
                                                    echo "<select name='rest_locality' style='width: 235px;background: #f1f1f1;border:1px solid #dbdbdb;margin-bottom: 0px;' >";
                                                    echo "<optgroup label='Popular Locality'>";
                                                    echo"<option value=''>Select Locality</option>";
                                                    while ($row = mysql_fetch_array($result)) {
                                                        $locality_id = $row['locality_id'];
                                                        $locality_name = ucwords($row['locality_name']);
                                                        echo "<option value='{$locality_id}'>{$locality_name}</option>";
                                                    }
                                                    echo "</optgroup></select>";
                                                    ?>    


                                                    <div class="clear"></div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="search-filter-tab">
                                            <div id="filter-cuisines-html-area">
                                                <div class="search-filter-label cuisine-label">
                                                    <div title="Filter results by cuisine">Cuisine</div>

                                                    <?php
                                                    $query = "select * from cuisine where cuisine_status='1'";
                                                    $result = mysql_query($query) or die(mysql_error());
                                                    echo "<select name='rest_cuisine' style='width: 235px;background: #f1f1f1;border:1px solid #dbdbdb;margin-bottom: 0px;' >";
                                                    echo "<optgroup label='Popular Cuisine'>";
                                                    echo"<option value=''>Select Cuisine</option>";
                                                    while ($row = mysql_fetch_array($result)) {
                                                        $cuisine_id = $row['cuisine_id'];
                                                        $cuisine_name = ucwords($row['cuisine_name']);
                                                        echo "<option value='{$cuisine_id}'>{$cuisine_name}</option>";
                                                    }
                                                    echo "</optgroup></select>";
                                                    ?>



                                                    <div class="clear"></div>

                                                    </div>

                                                    <div class="clear"></div>
                                                </div>
                                            </div>


                                            <div class="search-filter-tab">
                                            <div id="filter-cost-html-area">
                                                <div class="search-filter-label cft-label">
                                                    <div title="Filter results by cost for two">Cost for two</div>
                                                    <div class="clear"></div>

                                                    <select name="rest_cost" style="width: 235px;background: #f1f1f1;border:1px solid #dbdbdb;margin-bottom: 0px;">
                                                        <option value="0-5000">Click to choose</option>
                                                        <option value="0-250">Less than Rs. 250</option>
                                                        <option value="250-500">Rs. 250 to Rs. 500 </option>
                                                        <option value="500-1000">Rs. 500 to Rs. 1000 </option>
                                                        <option value="1000-1500">Rs. 1000 to Rs. 1500 </option>
                                                        <option value="1500-2500">Rs. 1500 to Rs. 2500 </option>
                                                        <option value="2500-5000">Rs. 2500+ </option>

                                                    </select>

                                                    <div class="clear"></div>

                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <div class="search-filter-tab">
                                            <div>
                                                <div class="search-filter-label category-label active-label">Category</div>
                                                <div class="clear"></div>
                                                <div>
                                                    <ul class="additional-options clearfix">
                                                        <li>
                                                            <a >Delivery <div class="right"><input  name="rest_delivery" type="checkbox"  style="height:16px;width: 16px;"></div></a>
                                                        </li>

                                                        <li>
                                                            <a >Dine in <div class="right"><input  name="rest_dine_in" type="checkbox"  style="height:16px;width: 16px;"></div></a>
                                                        </li>

                                                        <li>
                                                            <a >Catering <div class="right"><input  name="rest_catering" type="checkbox"  style="height:16px;width: 16px;"></div></a>
                                                        </li>

                                                        <li>
                                                            <a >Take Away <div class="right"><input  name="rest_take_away" type="checkbox"  style="height:16px;width: 16px;"></div></a>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <div class="clear"></div>
                                        </div>

                                        <div class="search-filter-tab more-filters-tab">
                                            <div id="filter-more-html-area">
                                                <div class="search-filter-label more-filters-label" title="Apply additional filters">More filters</div>
                                                <div class="clear"></div>
                                                <div id="more-filters">
                                                    <div>

                                                        <ul class="additional-options clearfix">

                                                            <li>
                                                                <a data-icon="b" >Bar present <div class="right"><input  name="rest_bar" type="checkbox"  style="height:16px;width: 16px;"></div></a>

                                                                <div class="clear"></div>
                                                            </li>
                                                            <li>
                                                                <a data-icon="V" >Pure veg <div class="right"><input  name="rest_pure_veg" type="checkbox"  style="height:16px;width: 16px;"></div></a>

                                                                <div class="clear"></div>
                                                            </li>


                                                            <li>
                                                                <a data-icon="å" >Wifi <div class="right"><input  name="rest_wifi" type="checkbox"  style="height:16px;width: 16px;"></div></a>

                                                                <div class="clear"></div>
                                                            </li>
                                                            <li>
                                                                <a data-icon="&"   >Air Condition <div class="right"><input  name="rest_air_con" type="checkbox"  style="height:16px;width: 16px;"></div></a>

                                                                <div class="clear"></div>
                                                            </li>

                                                            <li>
                                                                <a data-icon="^" >Parking Available<div class="right"><input  name="rest_parking" type="checkbox"  style="height:16px;width: 16px;"></div></a>

                                                                <div class="clear"></div>
                                                            </li>

                                                        </ul>
                                                        <input type="submit" value="Filter" class="btn" style="background: #dbdbdb;margin:10px 10px 10px 10px;float: right;">


                                                        <div class="clear"></div>
                                                    </div>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--  filter section ends  -------------->
                            <div class="clear"></div>
                        </div>



                        <!----- restaurant  data part  start  --------------->
                        <div class="grid_9 column search-start">

                            <!-- database data  header part -->

                            <?php
                            if($cuisine1!="")
                            {
                                $query = "select * from restaurant_detail r,locality l,city c,state s
                                    where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_cuisine_id like '%{$cuisine1}%' and c.city_id='{$city}'";
                                $result = mysql_query($query) or die(mysql_error());
                                $record = mysql_affected_rows();
                            }
                            else 
                            if ($search1 != "") {
                                $query = "select * from restaurant_detail r,locality l,city c,state s
                                    where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_name like '%{$search1}%' and c.city_id='{$city}'";
                                $result = mysql_query($query) or die(mysql_error());
                                $record = mysql_affected_rows();
                                if ($record == 0) {
                                    $query = "select * from restaurant_detail r,locality l,city c,state s
                                        where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and l.locality_name like '%{$search1}%'  and c.city_id='{$city}'";
                                    $result = mysql_query($query) or die(mysql_error());
                                    $record = mysql_affected_rows();
                                    if ($record == 0) {
                                        $query1 = "select * from cuisine where  cuisine_name like '%{$search1}%'";
                                        $result1 = mysql_query($query1) or die(mysql_error());
                                        $row1 = mysql_fetch_array($result1);
                                        if ($result1) {
                                            $cuisine_id = $row1['cuisine_id'];
                                            $query = "select * from restaurant_detail r,locality l,city c,state s
                                                where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and r.rest_cuisine_id like '%{$cuisine_id},%'  and c.city_id='{$city}'";
                                            $result = mysql_query($query) or die(mysql_error());
                                            $record = mysql_affected_rows();
                                        }
                                    }
                                }
                            } else {
                                if ($filter == 1) {

                                    $query = "select * from restaurant_detail r,locality l,city c,state s
            where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id {$locality_query} {$cuisine_query} {$cost_query} {$delivery_query} {$dine_in_query} {$catering_query} {$take_away_query} {$bar_query} {$pure_veg_query} {$wifi_query} {$air_con_query} {$parking_query}  and c.city_id='{$city}'";
                                    $result = mysql_query($query) or die(mysql_error());
                                } else if ($sort == 1) {
                                    if ($rest_sort == 'ra') {
                                        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id   and c.city_id='{$city}' group by rt.rest_id order by avg_rate";
                                        $result = mysql_query($query) or die(mysql_error());
                                    } elseif ($rest_sort == 'rd') {

                                        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id   and c.city_id='{$city}' group by rt.rest_id order by avg_rate desc";
                                        $result = mysql_query($query) or die(mysql_error());
                                    } elseif ($rest_sort == 'ca') {
                                        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id   and c.city_id='{$city}' group by rt.rest_id order by r.rest_cost";
                                        $result = mysql_query($query) or die(mysql_error());
                                    } elseif ($rest_sort == 'cd') {
                                        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id   and c.city_id='{$city}' group by rt.rest_id order by r.rest_cost desc";
                                        $result = mysql_query($query) or die(mysql_error());
                                    }
                                } else {

                                    $query = "select * from restaurant_detail r,locality l,city c
                                    where r.locality_id=l.locality_id and r.city_id=c.city_id   and c.city_id='{$city}'";
                                    $result = mysql_query($query) or die(mysql_error());
                                }

                                $record = mysql_num_rows($result);
                            }
                            ?>
                            <div class="category-filters even brstd mb5 box-sizing-content">
                                <div class="left">
                                    <ul class="text-tabs clearfix">
                                        <li id="start-tab-all" class="text-tab-link selected">
                                            <a>
                                                Total <span class="grey-text"><?php echo $record; ?></span> Restaurant Found
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="right">
                                    <div id="sort-container" class="search-sort">
                                        <div class="right ta-right sort-label">
                                            <div class="sort-dd p-relative left">
                                                <div class="sort-sel right">
                                                    <form>
                                                        <select  id="rest-sort" name="rest_sort" style="width:auto;background: #f1f1f1;" onchange="sortRestaurant();">
                                                            <option>SORTING</option>
                                                            <option  value="<?php echo "restaurant-display.php?sort=ra"; ?>">Rating - low to high</option>
                                                            <option  value="<?php echo "restaurant-display.php?sort=rd"; ?>">Rating - high to low</option>
                                                            <option  value="<?php echo "restaurant-display.php?sort=ca"; ?>">Cost - low to high</option>
                                                            <option  value="<?php echo "restaurant-display.php?sort=cd"; ?>">Cost - high to low</option>
                                                        </select>
                                                    </form>
                                                </div>

                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <!--   data header end  ---->



                            <div class="search_results mbot">
                                <section id="search-results-container">
                                    <div id="sort-result-container">
                                        <ol>
                                            <!-- START SHOWING SEARCH RESULTS -->
                                            <?php
                                            while ($row = mysql_fetch_array($result)) {
                                                $rest_id = $row['rest_id'];
                                                $rest_name = ucwords($row['rest_name']);
                                                $owner_website = $row['rest_website'];
                                                $rest_address = ucwords($row['rest_address']);
                                                $rest_cost = $row['rest_cost'];
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
                                                $city_name = ucfirst($row['city_name']);
                                                echo "<li class = 'resZS mb5 pb5 brstd even  status1' data-res_id = '13278' style = 'display: list-item;'>
                                        <article class = ''>
                                        <div class = 'search-result'>
                                        <div>
                                      
                                        <div class = 'search_grid_left pos-relative column alpha'>
                                        <div class = 'search-name'>
                                        <h3 class = 'top-res-box-name ln24 left'>
                                        <a class='rest_header' href = 'restaurant-display-detail.php?qry={$rest_id}' title = '{$rest_name}'>{$rest_name}</a>
                                        </h3>

                                        <div class = 'clear'></div>

                                        <div class = 'ln24'>
                                        <a>{$locality_name}</a>
                                        <span class = 'search-result-address' >› {$rest_address}</span>
                                        </div>";

                                                foreach ($rest_cuisine_id as $value) {
                                                    $query2 = "select cuisine_name from cuisine where cuisine_id = '{$value}'";
                                                    $result2 = mysql_query($query2) or die(mysql_error());
                                                    $row2 = mysql_fetch_array($result2);
                                                    if ($row2) {
                                                        $rest_cuisine_name = $rest_cuisine_name . $row2['cuisine_name'] . ", ";
                                                    }
                                                }
                                                echo "<div class = 'res-snippet-small-cuisine' >{$rest_cuisine_name}</div>
                                        <div class = 'ln24'>
                                        <span class = 'upc grey-text sml'>Cost for 2: </span>Rs. {$rest_cost}
                                        </div>
                                        <div class = 'clear'></div>
                                        </div>
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
                                                echo "<div class = 'search_grid_right column omega ta-right'>
                                        <div class = 'search-result-stars ln24 clearfix'>
                                        <div class = 'right'>
                                        <div class = 'rating-div left  level-6'>
                                        {$rest_rate}
                                        </div>
                                        <div class = 'clear'></div>
                                        <div class = 'rating-rank right'>
                                        <span class='rating-votes-div-13278'>{$rest_vote} votes</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='clear'></div>
                                                        </div>
                                                       
                                                        <div class='clear ieclear'></div>
                                                    </div>

                                                    <div class='clear'></div>
                                                </div>
                                                <div class='plr15 search-result-links box-sizing-content'>
                                                    <div class='left'>
                                                        <a href='' class='cblack'>
                                                            Menu
                                                        </a>
                                                        <div class='clear'></div>
                                                    </div>";

                                                /*                                                 * **              restauarant photo  ********* */

                                                $query1 = "select count(rp.rest_id) as total_photo from restaurant_detail r,restaurant_photo rp where  rp.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rp.rest_id";
                                                $result1 = mysql_query($query1) or die(mysql_error());
                                                $row1 = mysql_fetch_array($result1);
                                                if ($row1) {

                                                    $rest_photo = $row1['total_photo'];
                                                } else {
                                                    $rest_photo = 0;
                                                }
                                                echo"<div class='grey-text left'>&nbsp;&nbsp;·&nbsp;&nbsp;</div>
                                                    <div class='left'>
                                                        <a href='' class='search-result-reviews'>
                                                            {$rest_photo} photos
                                                        </a>
                                                        <div class='clear'></div>
                                                    </div>";

                                                /*                                                 * ******     restauarant photo  ********* */

                                                $query1 = "select count(rw.rest_id) as total_review from restaurant_detail r,review rw where  rw.rest_id=r.rest_id and r.rest_id='{$rest_id}'  group by rw.rest_id";
                                                $result1 = mysql_query($query1) or die(mysql_error());
                                                $row1 = mysql_fetch_array($result1);
                                                if ($row1) {

                                                    $rest_review = $row1['total_review'];
                                                } else {
                                                    $rest_review = 0;
                                                }

                                                echo "<div class='grey-text left'>&nbsp;&nbsp;·&nbsp;&nbsp;</div>
                                                    <div class='left'>
                                                        <a href='' class='search-result-reviews' title='User reviews for Cafe Eastwood'>
                                                            {$rest_review} Reviews
                                                        </a>
                                                        <div class='clear'></div>
                                                    </div>";

                                                /*                                                 * *****************  Facility  and features  ******************** */
                                                if ($rest_type == 1) {
                                                    $type = "Pure Vegetarian";
                                                    $rest_type = "<span data-icon='V' style='font-size:24px;color:green;margin-left:0px;' title='Pure Vegitarian'></span>";
                                                } else {
                                                    $type = 'Serves Non-Veg';
                                                    $rest_type = "<span data-icon='V' style='font-size:24px;color:#a80000;margin-left:0px;' title='Non Veg Available'></span>";
                                                }
                                                if ($rest_wifi == 1) {
                                                    $rest_wifi = "<span data-icon='å' style='font-size:24px;color:gray;margin-left:0px;' title='Wifi Available'></span>";
                                                } else {
                                                    $rest_wifi = "";
                                                }
                                                if ($rest_air_con == 1) {
                                                    $rest_air_con = "<span data-icon='&' style='font-size:24px;color:skyblue;margin-left:0px;' title='Air Conditioner'></span>";
                                                } else {
                                                    $rest_air_con = "";
                                                }

                                                if ($rest_parking == 1) {
                                                    $rest_parking = "<img src='images/parking.png' style='margin-left:0px;height:22px;width:22px;padding:3px 0px;' title='Parking Available'>";
                                                } else {
                                                    $rest_parking = "";
                                                }
                                                if ($rest_dinein == 1) {
                                                    $rest_dinein = "<span data-icon='D' style='font-size:24px;color:#a80000;margin-left:0px;' title='Dine in Available'></span>";
                                                } else {
                                                    $rest_dine_in = "";
                                                }
                                                if ($rest_delivery == 1) {
                                                    $rest_delivery = "<span data-icon='d' style='font-size:24px;color:#484548;margin-left:0px;' title='Home Delivery'></span>";
                                                } else {
                                                    $rest_delivery = "";
                                                }
                                                if ($rest_catering == 1) {
                                                    $rest_catering = "<span data-icon='G' style='font-size:24px;color:#424842;margin-left:0px;' title='Catering Provided'></span>";
                                                } else {
                                                    $rest_catering = "";
                                                }
                                                if ($rest_bar == 1) {
                                                    $rest_bar = "<span data-icon='b' style='font-size:24px;color:blue;margin-left:0px;' title='Bar Available'></span>";
                                                } else {
                                                    $rest_bar = "";
                                                }
                                                echo "<div class='right'>
                                              {$rest_catering}{$rest_type}{$rest_wifi}{$rest_air_con}{$rest_dinein}{$rest_delivery}{$rest_bar}{$rest_parking}                                            
                                                        <div class='clear'></div>
                                                    </div>
                                                            <div class='clear'></div>
                                                </div>
                                            </article>
                                        </li>";
                                            }
                                            ?>

                                            <!-- END SHOWING SEARCH RESULTS -->
                                        </ol>
                                    </div>
                                    <div class="search-pagination-top bb box-sizing-content">
                                        
<!--                                        <div class="right res-right">
                                            <ul data-only_page_str="" class="pagination-control res-menu-paginator">
                                                
                                                <li class=" current">1</li>
                                                <li class=" active"><a href="restaurant-list.php?page=2" title="Go to Page 2">2</a></li></ul></div>-->
                                        <div class="clear"></div>
                                    </div>

                                    
                                    <div class="clear ieclear"></div>

                            </div>

                        </div>

                       
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear ieclear"></div>
            </section>
            <div class="clear ieclear"></div>
            <!------------- main Container  ends    -------->
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

    </body></html>