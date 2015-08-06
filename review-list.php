<?php
session_start();
require './class/db-connection.php';
include './class/data-truncate.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
?>
<!doctype html>
<html lang="en">


  <head>
    <meta charset="utf-8">
    <title>Restaurant Search Engine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <div class="contact-banner"><img src="images/inner-banner-3.jpg" alt="img"></div>
      </section>
      <!--Banner End--> 
      <!--Content Area Start-->
      <section id="content" class="container"> 
        <!--Blog Page Section Start-->
        <section class="blog-page-section">
          <div class="row-fluid">
            <div class="span12">
              <div class="heading">
                <h1>Review</h1>
              </div>
            </div>
            <!--Blog Post End-->
            <div class="row-fluid">
              <div class="span8">
                <div class="post-box-outer">
                  <?php
                  $query = "select f.foodie_name,f.foodie_photo,r.rest_name,l.locality_name,rw.* 
                              from foodie_detail f,restaurant_detail r, locality l,review rw
                              where rw.foodie_id=f.foodie_id and rw.rest_id=r.rest_id and r.locality_id=l.locality_id order by rw.review_date desc";
                  $result = mysql_query($query) or die(mysql_error());
                  echo "<ul>";
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

                    $query1 = "select count(review_id) as total_comment from comment where review_id='{$review_id}' and comment_status='1'";
$result1 = mysql_query($query1) or die(mysql_error());
$row1 = mysql_fetch_array($result1);
$total_commment = $row1['total_comment'];
 
$query1 = "select count(review_id) as total_view from review_visit where review_id='{$review_id}'";
$result1 = mysql_query($query1) or die(mysql_error());
$row1 = mysql_fetch_array($result1);
$total_view = $row1['total_view'];
                    echo "<li>
                  <div class='post-box'>
                    <div class='post-frame'> 
                      <div class='post-date'><img src='{$foodie_photo}' style='height:83px;width:80px;'> <strong class='date'>{$day}/{$month}/{$year}</strong> </div>
                    </div>
                    <div class='post-detail'>
                      <h2>{$foodie_name} has reviewed on {$rest_name}</h2>
                      <ul>
                        <li class='admin'>{$foodie_name}</li>
                        <li class='view'>{$total_view} Views</li>
                        <li class='comment'>{$total_commment} Comments</li>
                        
                      </ul>
                    </div>
                    <p>{$data}</p>
                    <a href='review-detail.php?qry={$review_id}' class='btn btn-read'style='float:right'>Read More</a> </div>
                </li>";
                  }
                  echo "</ul>";
                  ?>
                  <div class="pagination pagination-area">
                    <ul>
                      <li><a href="#">&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li><a href="#">&gt;</a></li>
                    </ul>
                  </div>
                </div>

              </div>
              <!--Blog Post End--> 
              <!--Widget Area Start-->
              <div class="span4">
                <div class="widget-area">
                  <ul>
                    <li>
                      <div class="header">
                        <h2>Search our site</h2>
                      </div>
                      <div class="unique-box">
                        <form action="#" class="widget-form">
                          <div class="form-group">
                            <input name="" type="text" placeholder="Search..." class="widget-input">
                            <input name="" type="submit" value="" class="btn-search">
                          </div>
                        </form>
                      </div>
                    </li>




                    <li>
                      <div class="widget-calendar">
                        <div id="calendar_wrap">
                          <table id="wp-calendar">
                            <caption>
                              may 2013
                            </caption>
                            <thead>
                              <tr>
                                <th title="Monday" scope="col">M</th>
                                <th title="Tuesday" scope="col">T</th>
                                <th title="Wednesday" scope="col">W</th>
                                <th title="Thursday" scope="col">T</th>
                                <th title="Friday" scope="col">F</th>
                                <th title="Saturday" scope="col">S</th>
                                <th title="Sunday" scope="col">S</th>
                              </tr>
                            </thead>
                            <tfoot>
                              <tr>
                                <td id="prev" colspan="3"><a title="View posts for January 2013" href="#">« Jan</a></td>
                                <td class="pad">&nbsp;</td>
                                <td class="pad" id="next" colspan="3">&nbsp;</td>
                              </tr>
                            </tfoot>
                            <tbody>
                              <tr>
                                <td class="pad" colspan="6">&nbsp;</td>
                                <td>1</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                                <td>7</td>
                                <td>8</td>
                              </tr>
                              <tr>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td>12</td>
                                <td>13</td>
                                <td>14</td>
                                <td>15</td>
                              </tr>
                              <tr>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                                <td>21</td>
                                <td>22</td>
                              </tr>
                              <tr>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td id="today">26</td>
                                <td>27</td>
                                <td>28</td>
                                <td>29</td>
                              </tr>
                              <tr>
                                <td>30</td>
                                <td colspan="6" class="pad">&nbsp;</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="calender-bottom"> <strong class="title"><span class="red">Chinesse Food Festival</span> held in evening. The opening was right at 6:00 pm while closing was right on 4:00am. </strong> </div>
                      </div>
                    </li>
                    <li>
                      <div class="header">
                        <h2>Subscribe to our special offers</h2>
                        <span class="icon-6"></span> </div>
                      <div class="unique-box">
                        <form action="#" class="subscribe-form">
                          <input name="" type="text" class="name-input" placeholder="Name">
                          <input name="" type="text" class="name-input" placeholder="Email Address">
                          <input name="" type="submit" class="submit-btn" value="Submit">
                        </form>
                      </div>
                    </li>


                  </ul>
                </div>
              </div>
              <!--Widget Area End-->  
            </div>
          </div>
        </section>
        <!--Blog Page Section End--> 
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

  <!-- Mirrored from html.crunchpress.net/kc/kc_fullview/ by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 20 Jan 2014 07:23:41 GMT -->
</html>


