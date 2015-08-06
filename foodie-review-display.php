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
            $query = "select * from restaurant_detail r,review wl,locality l,city c 
where wl.rest_id=r.rest_id and r.locality_id=l.locality_id and r.city_id=c.city_id and wl.foodie_id='{$_SESSION['user_id']}'";
            $result = mysql_query($query) or die(mysql_error());
            $record = mysql_num_rows($result);
            ?>
            <section>
                <div class="container">


                    <div class="grid_15 column alpha pos-relative">


                        <div>
                            <div class="tabs-container nf-filters clearfix brstd mtop0">
                                <div class="nf-heading ttupper nf-heading-small bb0 pb5 left">Reviews</div>

                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="p-relative">


                            <div class="res-reviews-container">
                                <?php
                                while ($row = mysql_fetch_array($result)) {

                                    $review_id = $row['review_id'];
                                    $rest_id = $row['rest_id'];
                                    $rest_name = ucwords($row['rest_name']);
                                    $locality_name = ucwords($row['locality_name']);
                                    $city_name = ucwords($row['city_name']);
                                    $review_text = $row['review_text'];

                                    $query1 = "select rest_photo from restaurant_photo where rest_id='{$rest_id}' limit 1";
                                    $result1 = mysql_query($query1) or die(mysql_error());
                                    $row1 = mysql_fetch_array($result1);
                                    if ($row1) {
                                        $rest_photo = "admin-panel/rest/rest-photo/{$row1['rest_photo']}";
                                    } else {
                                        $rest_photo = "admin-panel/rest/rest-photo/rest_not_avail.png";
                                    }

                                    echo "<div class='act feedroot res-review stupendousact'>
                                    <div class='act-body'>

                                        <div class='actn-cont'>

                                            <div class='actn'>
                                                <div class='actn-im'>
                                                    <a href=''><img src='{$rest_photo}'></a>
                                                </div>
                                                <div class='actn-data'>
                                                    <div class='actn-data-l'>
                                                        <a class='actn-e-name js_jewel_popup' href=''>{$rest_name}</a>
                                                        <div class='clear'></div>
                                                        <div>
                                                            <a class='cblack' >
                                                                {$locality_name}, {$city_name}
                                                            </a>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class='clear'></div>
                                            </div>

                                            <div class='mtop0 rev-text-sm'>
                                                <div class='rev-text-expand'>
                                                    
                                                    {$review_text} 
                                                        
                                                </div>
                                                
                                                <div class='clear'></div>
                                            </div>";

                                    $query1 = "select c.*,f.foodie_name,f.foodie_photo from comment c,foodie_detail f where c.foodie_id=f.foodie_id and c.review_id='{$review_id}'";
                                    $result1 = mysql_query($query1) or die(mysql_error());
                                    $record1=  mysql_num_rows($result1);
                                    if($record1>0)
                                    {
                                        echo "<div style='margin-top:20px;' >
                                                <div class='review_comments_container'>";
                                    }
                                    while ($row1 = mysql_fetch_array($result1)) {

                                        $foodie_name = $row1['foodie_name'];
                                        $comment_text = $row1['comment_text'];
                                        $foodie_photo = $row1['foodie_photo'];
                                        if ($foodie_photo == "") {
                                            $foodie_photo = "admin-panel/photo/not_avail.png";
                                        } else {
                                            $foodie_photo = "admin-panel/photo/foodie-photo/{$foodie_photo}";
                                        }


                                        echo "<div class='review_comment_item clearfix'>
                                                        <div class='left review_comment_profile_img'>
                                                            <a href='' class='review-comment-item-img'>
                                                                <img src='{$foodie_photo}' alt=''>
                                                            </a>
                                                        </div>
                                                        <div class='js_review_comment_right review-comment-right'>
                                                            <div>
                                                                <a href=''  class='js_jewel_popup name'>{$foodie_name}</a>&nbsp;

                                                                <span class='review_comment_text'>
                                                                    {$comment_text}
                                                                </span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>"; 
                                                    
                                                
                                    }
                                    echo"</div>
                                            </div>";




                                    echo"
                                           
                                        </div>
                                    </div>
                                    <div class='clear'></div>
                                </div>
                                 <div class='clear'></div>
                            </div>";
                                }
                                ?>


                            </div>


                        </div>
                        <div class="clear"></div>
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

