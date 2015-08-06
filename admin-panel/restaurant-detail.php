<?php
require './class/db-connection.php';
connection();
session_start();
?>
<html>
  <head>
    <?php
   
    include './themepart/headerscripts.php';
    $qry;
    $msg = "";
    $qry = mysql_real_escape_string($_GET['qry']);
    if (!isset($_GET['qry']) || empty($_GET['qry'])) {
      header("location:restaurant-display.php");
    }
    if ($_GET) {
      $qry = $_GET['qry'];
      if ($qry == 'true') {
        $msg = "<div class='alert alert-success '>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                         Your Operation has been Completed Successfully..
                                    </div>";
      } else if ($qry == 'false') {
        $msg = "<div class='alert alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                       <strong>Error!</strong> Your Operation has been Failed " . mysql_error() . "
                                    </div>";
      }
    }
    ?>
  </head>

  <body>
    <!-- START Template Wrapper -->
    <div id="wrapper" class="fixed-header fixed-sidebar">
      <!-- START Template Canvas -->
      <div id="canvas">
        <?php
        include './themepart/header.php';
        include './themepart/sidebar.php';
        ?>
        <!-- START Template Main Content -->
        <section id="main">
          <!-- START Content -->
          <div class="navbar navbar-static-top">
          <div class="navbar-inner">
            <!-- Breadcrumb -->
            <ul class="breadcrumb">
              <li><a href="restaurant-display.php">Restaurant</a> <span class="divider"></span></li>
              <li class="active">Restaurant Detail</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
          <div class="container-fluid">
            <!-- START Row -->
             <?php echo $msg; ?>
            <div class="row-fluid">
              <!-- START Datatable 1 -->
             
              <div class="span12 widget dark stacked">
                <header>
                  <h4 class="title pull-left"><span class="icon icone-user"></span>Restaurant Detail</h4>
                  <!-- START Button Group -->
                  <div class="btn-group pull-right">
                    <a class="btn1 btn1-blue" href="restaurant-display.php"><span class="icone-undo"></span> Back</a>

                  </div>
                  <!--/ END Button Group -->

                </header>
                <section class="body">
                  <?php
                  ?>
                  <div class="body-inner no-padding">
                    <table class="table table-bordered table-striped table-hover ">
                      <thead>
                        <tr>  
                          <th width="14%">Type</th>
                          <th width="22%">Value</th>                           

                        </tr>
                      </thead>
                      <tbody>
<?php


$query = "select * from restaurant_detail  where rest_id='{$qry}'";
$result = mysql_query($query) or die("Error in Selecting query :" . mysql_error());
$row = mysql_fetch_array($result);
if ($row) {
  $rest_id = $row['rest_id'];
  $rest_name = $row['rest_name'];
  $rest_address = $row['rest_address'];
  $rest_contact = $row['rest_contact'];
  $rest_cost = $row['rest_cost'];
  $rest_payment = $row['rest_payment'];
  $rest_reservation = $row['rest_reservation'];
  $rest_time1 = $row['rest_time1_on'] . " To " . $row['rest_time1_off'];
  $rest_time2 = $row['rest_time2_on'] . " To " . $row['rest_time2_off'];
  $rest_city_id = $row['city_id'];
  $rest_locality_id = $row['locality_id'];
  $rest_seo_name = $row['rest_seo_name'];
  $rest_mobile = $row['rest_mobile'];
  $rest_dine_in = $row['rest_dine_in'] == 1 ? "Available" : "Not Available";
  $rest_delivery = $row['rest_delivery'] == 1 ? "Available" : "Not Available";
  ;
  $rest_Catering = $row['rest_catering'] == 1 ? "Available" : "Not Available";
  $rest_take_away = $row['rest_take_away'] == 1 ? "Available" : "Not Available";

  $rest_aircon = $row['rest_air_con'] == 1 ? "Available" : "Not Available";
  $rest_wifi = $row['rest_wifi'] == 1 ? "Available" : "Not Available";
  ;
  $rest_livemusic = $row['rest_live_music'] == 1 ? "Available" : "Not Available";
  $rest_candlelight = $row['rest_candle_light'] == 1 ? "Available" : "Not Available";
  $rest_parking = $row['rest_parking'] == 1 ? "Available" : "Not Available";
  $rest_bar = $row['rest_bar'] == 1 ? "Available" : "Not Available";
  $rest_pure_veg = $row['rest_pure_veg'] == 1 ? "Available" : "Not Available";
  $rest_regdate = $row['rest_reg_date'];
  $rest_owner = $row['rest_owner'];
  $rest_email = $row['rest_email'];
  $rest_website = $row['rest_website'];
  $rest_password = $row['rest_password'];
  $rest_status = $row['rest_status'];
  $rest_visitcounter = $row['rest_visit_counter'];
  $rest_cuisine_id = explode(",", $row['rest_cuisine_id']);
  //$rest_photo = explode(",", $row['rest_photo']);


  $rest_locality_name = "";
  $query = "select locality_name from locality where locality_id='{$rest_locality_id}'";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  if ($row) {
    $rest_locality_name = $row['locality_name'];
  }

  $rest_city_name = "";
  $query = "select city_name from city where city_id='{$rest_city_id}'";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result) ;
  if ($row) {
    $rest_city_name = $row['city_name'];
  }

  $rest_cuisine_name = "";
  foreach ($rest_cuisine_id as $value) {
    $query = "select cuisine_id, cuisine_name from cuisine where cuisine_id='{$value}'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
    if ($row) {
      $rest_cuisine_name = $rest_cuisine_name . $row['cuisine_name'] . " , ";
      //echo "<script>alert({$row['cuisine_name']});</script>";
    }
  }

  echo "<tr></tr>"
  . "<tr><td>ID</td><td>{$rest_id}</td></tr>"
  . "<tr><td>Name</td><td>{$rest_name}</td></tr>"
  . "<tr><td>Address</td><td>{$rest_address}</td></tr>"
  . "<tr><td>Contact</td><td>{$rest_contact}</td></tr>"
  . "<tr><td>Cost</td><td>{$rest_cost}</td></tr>"
  . "<tr><td>Payment_mode</td><td>{$rest_payment}</td></tr>"
  . "<tr><td>Reservation_scheme</td><td>{$rest_reservation}</td></tr>"
  . "<tr><td>Time1</td><td>{$rest_time1}</td></tr>"
  . "<tr><td>Time2</td><td>{$rest_time2}</td></tr>"
  . "<tr><td>City</td><td>{$rest_city_name}</td></tr>"
  . "<tr><td>Location</td><td>{$rest_locality_name}</td></tr>"
  . "<tr><td>SEO_Name</td><td>{$rest_seo_name}</td></tr>"
  . "<tr><td>Mobile</td><td>{$rest_mobile}</td></tr>"
  . "<tr><td>Cuisine</td><td>{$rest_cuisine_name}</td></tr>"
  . "<tr><td>Dine In</td><td>{$rest_dine_in}</td></tr>"
  . "<tr><td>Delivery</td><td>{$rest_delivery}</td></tr>"
  . "<tr><td>Catering</td><td>{$rest_Catering}</td></tr>"
  . "<tr><td>Take Away</td><td>{$rest_take_away}</td></tr>"
  . "<tr><td>Air conditioned</td><td>{$rest_aircon}</td></tr>"
  . "<tr><td>Wi-Fi</td><td>{$rest_wifi}</td></tr>"
  . "<tr><td>Live-Music</td><td>{$rest_livemusic}</td></tr>"
  . "<tr><td>Candle-light</td><td>{$rest_candlelight}</td></tr>"
  . "<tr><td>Parking</td><td>{$rest_parking}</td></tr>"
  . "<tr><td>Bar</td><td>{$rest_bar}</td></tr>"
  . "<tr><td>Pure Veg.</td><td>{$rest_pure_veg}</td></tr>"
  . "<tr><td>Registered-Date</td><td>{$rest_regdate}</td></tr>"
  . "<tr><td>Owner</td><td>{$rest_owner}</td></tr>"
  . "<tr><td>Email_Id</td><td>{$rest_email}</td></tr>"
  . "<tr><td>Website</td><td>{$rest_website}</td></tr>"
  . "<tr><td>Status</td><td>{$rest_status}</td></tr>"
  . "<tr><td>Visitor_counter</td><td>{$rest_visitcounter}</td></tr>"
  . "<tr><td>Password</td><td>{$rest_password}</td></tr>"
  . "<tr><td>Photo<td>";
          
          /*                   * ************   Photo  ***************** */

                  $query = "select * from restaurant_photo where rest_id='{$qry}'";
                  $result = mysql_query($query) or die("Error in Selecting query :" . mysql_error());

                  $rest_photo = "";
                  echo" <ul class='thumbnails gallery'>";
                  while ($row = mysql_fetch_array($result)) {

                    $rest_photo = "rest/rest-photo/" . $row['rest_photo'];
                    //echo $rest_photo . "<br>";
          
                    echo "<li>"
                    . "<div class='thumbnail'>"
                    . " <div class='overlay-slide'>"
                    . "<a href='$rest_photo' rel='prettyPhoto' title='Photo description'><div class='overlay-zoom zoom-black'></div></a>"
                    . "<img style='height:70px;width:70px;' src='{$rest_photo}'>"
                    . "</div>"
                    . "</div>"
                    . "</li>";
                  }
                  echo "</ul>";
                  /*                   * ************* end db photo      **************** */
                  

          echo "</tr>"
           . "<tr><td>Menu<td>";
          
          /*                   * ************   Menu  ***************** */

                  $query = "select * from restaurant_menu where rest_id='{$qry}'";
                  $result = mysql_query($query) or die("Error in Selecting query :" . mysql_error());

                  $rest_menu = "";
                  echo" <ul class='thumbnails gallery'>";
                  while ($row = mysql_fetch_array($result)) {

                    $rest_menu = "rest/rest-menu/" . $row['rest_menu'];
                    //echo $rest_menu . "<br>";

                    echo "<li>"
                    . "<div class='thumbnail'>"
                    . " <div class='overlay-slide'>"
                    . "<a href='' rel='prettyPhoto' title='Photo description'><div class='overlay-zoom zoom-black'></div></a>"
                    . "<img style='height:70px;width:70px;' src='{$rest_menu}'>"
                    . "</div>"
                    . "</div>"
                    . "</li>";
                  }
                  echo "</ul>";
                  echo "</tr>";
}
?>
                      </tbody>                  
                    </table>
                  </div>
                </section>


              </div>
              <!--/ END Datatable 1 -->
            </div>
            <!--/ END Row -->

          </div>
          <!--/ END Content -->

        </section>
        <!--/ END Template Main Content -->
<?php
include './themepart/footer.php';
?>
      </div>
      <!--/ END Template Canvas -->
    </div>
    <!--/ END Template Wrapper -->

<?php
include './themepart/footerscripts.php';
?>  

  </body>
</html>


