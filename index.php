<?php
session_start();
require './class/db-connection.php';
include './class/data-truncate.php';
connection();
if (!isset($_SESSION['visitor'])) {
    
    $result=mysql_query("select max(visit_id)as visitor from visit");
    $row=  mysql_fetch_array($result);
    $visitor=$row['visitor']+1;
    $_SESSION['visitor'] = $visitor;
    $visit_date=  date("Y-m-d");
    $query="insert into visit(visit,visit_date,hit)values('1','{$visit_date}','0')";
    $result=mysql_query($query) or die(mysql_error());
    
}
else
{
  
}
if (!isset($_SESSION['foodie_id']) and isset($_COOKIE['foodie_id'])) {
    $_SESSION['foodie_id'] = $_COOKIE['foodie_id'];
    $query = "select foodie_name from foodie_detail where foodie_id='{$_SESSION['foodie_id']}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
        $_SESSION['foodie_name'] = $row['foodie_name'];
    }
}
if (isset($_SESSION['city'])) {
    
    $city = $_SESSION['city'];
   
}
 else {
    
 
     $query="select city_id from city";
     $result=  mysql_query($query)or die(mysql_error());
     while ($row = mysql_fetch_array($result)) {
         $city_list[]=$row['city_id'];
     }
     $_SESSION['city']=  array_rand($city_list,1);
     $city=$_SESSION['city'];
     
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
                    <?php
                    include './theme-part/slider.php';
                    ?>
            
            <section id="content" class="container">
                <!--Blog Section Start-->
                <section class="blog-section">                
                    <!-- -->  
                    <div class="row-fluid">
                        <!--  <div class="span8">-->
                        <div class="span12">
                            <div class="row-fluid">
                                <div class="head">
                                    <h2>Latest Reviews</h2>
                                </div>
                            </div>

                        </div>
                        <div class="row-fluid">
                            <div class="span12">
<?php
$query = "select f.foodie_name,f.foodie_photo,r.rest_name,l.locality_name,rw.*,ct.city_name 
                          from foodie_detail f,restaurant_detail r, locality l,review rw,city ct
                          where rw.foodie_id=f.foodie_id and rw.rest_id=r.rest_id and r.locality_id=l.locality_id and l.city_id=ct.city_id and rw.review_status='1' order by rw.review_date desc limit 4";
$result = mysql_query($query) or die(mysql_error());
$i = 0;
while ($row = mysql_fetch_array($result)) {

    $month_list = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
    $date1 = explode(" ", $row['review_date']);
    $date2 = explode("-", $date1[0]);
    $day = $date2[2];
    $month = $date2[1] + 0;
    $year = $date2[0];
    $foodie_name = $row['foodie_name'];
    $review_id = $row['review_id'];
    $rest_name=$row['rest_name'];
    $foodie_photo = $row['foodie_photo'];
    if ($foodie_photo == "") {
        $foodie_photo = "admin-panel/photo/not_avail.png";
    } else {
        $foodie_photo = "admin-panel/photo/foodie-photo/{$row['foodie_photo']}";
    }
    $i++;
    $data = truncate($row['review_text'], 250, " ");
$query1 = "select count(review_id) as total_comment from comment where review_id='{$review_id}' and comment_status='1'";
$result1 = mysql_query($query1) or die(mysql_error());
$row1 = mysql_fetch_array($result1);
$total_commment = $row1['total_comment'];
    echo " <div class='span3'>
                        <div class='testimonial-inner-box'>
                          <div class='frame'><img src='{$foodie_photo}' style='width:90px;height:80px;' alt='img'></div>
                          <div class='text'>
                            <h3>{$foodie_name}</h3>
                            <strong class='title'>{$rest_name}<br>{$month_list[$month]} {$day}, {$year}</strong>
                             
                            </div>
                          <blockquote class='testimonial-blockquote'>
                            <p> {$data}</p>
                            <a href='#' class='comment'>{$total_commment} Comments</a>
                            <a href='review-detail.php?qry={$review_id}' style='padding: 10px 12px;float:right;background: #a80000;text-transform:uppercase;color:#fff;text-decoration:none;'>Read more</a>
                          </blockquote>
                        </div>
                      </div>";
}
?>
                            </div>              
                        </div>
                    </div>                   

                    
<?php
$query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id and c.city_id='{$city}' group by rt.rest_id order by avg_rate desc limit 4";
$result = mysql_query($query) or die(mysql_error());
$record=  mysql_num_rows($result);
if($record>0)
{
    echo "<div class='container mbot2' style='padding-top: 20px;'>
                        <div class='grid_16 column'>
                            <div class='head'>
                                <h2>Featured Restaurants</h2>
                            </div>
                        </div>
                        <article class='mbot'>
                            <div class='grid_16 column'>";
}
$i = 0;
while ($row = mysql_fetch_array($result)) {
    $i++;
    $rest_id = $row['rest_id'];
    $rest_name = ucwords($row['rest_name']);
    $locality_name = ucwords($row['locality_name']);
    $city_name = ucwords($row['city_name']);

    $query1 = "select rp.rest_photo from restaurant_photo rp,restaurant_detail r where rp.rest_id=r.rest_id and r.rest_id='{$rest_id} group by r.rest_id'";
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
                                                <a href='' class='search-result-reviews'>
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

