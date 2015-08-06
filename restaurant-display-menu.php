<?php
session_start();
require './class/db-connection.php';
connection();
$foodie_id = 0;
if (isset($_SESSION['user_id'])) {
    $foodie_id = $_SESSION['user_id'];
}
$lowlimit = 0;
$highlimit = 3;
$page=1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    echo "Page :$page<br>";
    $lowlimit = $page * 3 - 3;
    $highlimit = $lowlimit + 3;
}


include "./class/data-truncate.php";
if(isset($_SESSION['visitor']))
{
    mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
}

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
                $owner_website = $row['rest_website'];
                $rest_address = ucwords($row['rest_address']);
                

                $rest_contact = $row['rest_contact'];
                $rest_visit_counter=$row['rest_visit_counter'];
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
                echo "<div class='grid_4 grid-sm-4 column omega res-rating-cont-main'>
                            <div class='rating-info rrw-container rrw-container-112288 ' itemprop='aggregateRating' itemscope='' >
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
                                    <a href='foodie-favorite.php?qry={$rest_id}' data-icon='Æ' title='Add to favorite' > </a>
                                </div>

                                <div class='res-act-button left'>
                                    <a href='foodie-wish-list.php?qry={$rest_id}' title='Add to wishlist'  data-icon='w'> </a>
                                </div>

                                <div class='res-act-button left'>
                                    <a href='foodie-been-there.php?qry={$rest_id}' title='Add as been there' data-icon='E' > </a>
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
                echo"<div class='rating-bar' data-average='{$rate_value}' data-id={$rest_id}></div>";

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

                echo"<div class=' right res-stats-cont' style='margin-right:150px;'>
                            <div class='res-main-stats clearfix pos-relative'>

                                <div class='res-main-stats-stat'>
                                   
                                        <div class='res-main-stats-num'>{$rest_review}</div>
                                        <div class='res-main-stats-text'>reviews&nbsp;</div>
                                   
                                </div>
                                <div class='res-main-stats-stat'>
                                   
                                        <div class='res-main-stats-num'>{$total_favorite}</div>
                                        <div class='res-main-stats-text'>favorites&nbsp;</div>
                                   
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
                                <li class=''><h2><a href='restaurant-display-detail.php?qry={$rest_id}'>info</a></h2></li>
                                <li class='selected' ><h2><a href='restaurant-display-menu.php?qry={$rest_id}'>Menu</a></h2></li>
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
            }
            $query1 = "select rest_menu from restaurant_menu where rest_id='{$rest_id}'";
            $result1 = mysql_query($query1) or die(mysql_error());
            $record = mysql_num_rows($result1);
            $pagecount = $record / 3;
            if ($record % 3 != 0) {
                $pagecount++;
            }
            $query1 = "select rest_menu from restaurant_menu where rest_id='{$rest_id}' limit {$lowlimit},{$highlimit}";
            $result1 = mysql_query($query1) or die(mysql_error());
            echo"<div class='container' id='mainframe'>
                <section class='section'>
                    <div class='grid_16 column'>
                        <div class='grid_16 container-content mbot2 brstd'>
                            <div id='thumbsContainer'>";
            echo "<div class='span9'>

                <div id='menu-image'>
                    <center>";
            while ($row1 = mysql_fetch_array($result1)) {
              echo "<img src='admin-panel/rest/rest-menu/{$row1['rest_menu']}' style='min-height:400px;width:300px;'>&nbsp;";
            }
            echo " </center></div>";
            ?>

            <div class="pagination-bottom " style="margin-right: 20px;">
                    <div class="right">
                        <ul data-only_page_str="" class="pagination-control res-menu-paginator">
<?php
for ($i = 1; $i <=$pagecount; $i++) {
    if($page== $i)
    {
        echo "<li><a href='restaurant-display-menu.php?qry={$rest_id}&page={$i}'  style='color:#919191 ;font-size: 14px;font-weight: bold;width:10px;max-height:30px;'>{$i}</a></li>";
    }
 else {
        echo "<li><a href='restaurant-display-menu.php?qry={$rest_id}&page={$i}'  style='color: #CB202D;font-size: 14px;font-weight: bold;width:10px;max-height:30px;'>{$i}</a></li>";
    }
    
    
}
?>


                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>


            </div>


<?php
echo "<div class='clear'></div>

                            </div>
                        </div>
                    </div>
                    
                <a href='restaurant-menu-edit.php?qry={$rest_id}' style='padding: 10px 12px;float:right;background: #a80000;text-transform:uppercase;color:#fff;float:left;text-decoration:none;'>Edit Menu</a></section>

            </div>



            <div class = 'clear'></div>


            <div class = 'clear ieclear'></div>

            <div class = 'clear ieclear'></div>";
?>
            <section id = "content" class = 'container'>
                <!--Blog Page Section Start-->
                <section class = "blog-page-section">
                    <div class = "row-fluid">
                        <div class = "span12">
                            <div class = "heading">
                                <h1>Reviews</h1>
                            </div>
                        </div>


                    </div>
                </section>
<?php
$query = "select f.foodie_name,f.foodie_photo,r.rest_name,l.locality_name,rw.* 
                    from foodie_detail f,restaurant_detail r, locality l,review rw
                    where rw.foodie_id=f.foodie_id and rw.rest_id=r.rest_id and r.locality_id=l.locality_id and rw.rest_id='{$rest_id}' order by rw.review_date desc";
$result = mysql_query($query) or die(mysql_error());

echo "<section class='testimonial-page'>
                        <div class='row-fluid'>
                            <ul>";
while ($row = mysql_fetch_array($result)) {
    $review_id = $row['review_id'];
    $foodie_photo = $date1 = explode(" ", $row['review_date']);
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

echo "</ul>
                        </div>
                    </section>";
?>
                <?php
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
                ?></section>
                <?php
                include './theme-part/footer.php';
                ?>
            <!--Footer Area End-->


        </div>
        <!--Wrapper End--> 
<?php
include './theme-part/footer-script.php';
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