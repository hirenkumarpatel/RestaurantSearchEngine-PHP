
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';
if ($_POST) {
  

  $rest_city = $_POST['rest_city'];
  $rest_locality = $_POST['rest_locality'];
  $rest_name = mysql_real_escape_string($_POST['rest_name']);
  $rest_address = mysql_real_escape_string($_POST['rest_address']);
  $rest_contact = mysql_real_escape_string($_POST['rest_contact']);
  $rest_map=  mysql_real_escape_string($_POST['rest_map']);
  $rest_time1 = $_POST['rest_time1'];
  $rest_time2 = $_POST['rest_time2'];
  $rest_time3 = $_POST['rest_time3'];
  $rest_time4 = $_POST['rest_time4'];
  $rest_cost = $_POST['rest_cost'];
  $rest_payment = implode(",", $_POST['rest_payment']);
  $rest_reservation = $_POST['rest_reservation'];
  $rest_cuisine = implode(",", $_POST['rest_cuisine']);
  $rest_owner = $_POST['rest_owner'];
  $rest_email = $_POST['rest_email'];
  $rest_mobile = $_POST['rest_mobile'];
  $rest_website = $_POST['rest_website'];
  $rest_password = $_POST['rest_password'];
  $con_password = $_POST['con_password'];


  if (isset($_POST['rest_catering'])) {
    $catering = 1;
  } else {
    $catering = 0;
  }
  if (isset($_POST['rest_dine_in'])) {
    $dine_in = 1;
  } else {
    $dine_in = 0;
  }
  if (isset($_POST['rest_delivery'])) {
    $delivery = 1;
  } else {
    $delivery = 0;
  }
  if (isset($_POST['rest_take_away'])) {
    $take_away = 1;
  } else {
    $take_away = 0;
  }

  if (isset($_POST['rest_air_con'])) {
    $air_con = 1;
  } else {
    $air_con = 0;
  }

  if (isset($_POST['rest_wifi'])) {
    $wifi = 1;
  } else {
    $wifi = 0;
  }
  if (isset($_POST['rest_bar'])) {
    $bar = 1;
  } else {
    $bar = 0;
  }
  if (isset($_POST['rest_live_music'])) {
    $live_music = 1;
  } else {
    $live_music = 0;
  }
  if (isset($_POST['rest_parking'])) {
    $parking = 1;
  } else {
    $parking = 0;
  }

  if (isset($_POST['rest_candle_light'])) {
    $candle_light = 1;
  } else {
    $candle_light = 0;
  }
  if (isset($_POST['rest_pure_veg'])) {
    $pure_veg = 1;
  } else {
    $pure_veg = 0;
  }
  if (isset($_POST['rest_time1'])) {
    $rest_time1 = $_POST['rest_time1'];
  }


  $query = "insert into restaurant_detail"
          . "(rest_name,rest_address,rest_contact,rest_cost,rest_payment,"
          . "rest_reservation,rest_time1_on,rest_time1_off,rest_time2_on,"
          . "rest_time2_off,city_id,locality_id,rest_seo_name,rest_cuisine_id,rest_air_con,"
          . "rest_wifi,rest_live_music,rest_candle_light,rest_parking,rest_bar,rest_dine_in,"
          . "rest_delivery,rest_catering,rest_take_away,rest_pure_veg,"
          . "rest_owner,rest_email,rest_mobile,rest_website,rest_password,rest_map)"
          . "values('{$rest_name}','{$rest_address}','{$rest_contact}','{$rest_cost}',"
          . "'{$rest_payment}','{$rest_reservation}','{$rest_time1}','{$rest_time2}',"
          . "'{$rest_time3}','{$rest_time4}','{$rest_city}','{$rest_locality}','{$rest_name}',"
          . "'{$rest_cuisine}','{$air_con}','{$wifi}','{$live_music}','{$candle_light}','{$parking}',"
          . "'{$bar}','{$dine_in}','{$delivery}','{$take_away}','{$catering}','{$pure_veg}',"
          . "'{$rest_owner}','{$rest_email}','{$rest_mobile}','{$rest_website}','{$rest_password}','{$rest_map}')";

  $result = mysql_query($query) or die(mysql_error());
  echo "$query";
  if ($result) {


    //move_uploaded_file($_FILES["restaurant_photo"]["tmp_name"], $path);
    header("location:restaurant-display.php?qry=true");
  } else {
    header("location:restaurant-display.php?qry=false");
  }
}
?>

<!DOCTYPE html>


<head>
  <?Php
  include './themepart/headerscripts.php';
  ?>
</head>
<body>
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
              <li class="active">New Restaurant</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
         
        <?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >-->
          <form class="span12 widget dark shadowed form-horizontal bordered" id="formwizard_validate_tooltip" method="post" enctype="multipart/form-data">
            <header><h4 class="title">Restaurant Form</h4></header>
            <section class="body">
              <div class="body-inner">
                <fieldset class="step" id="step1">
                  <div class="step-title">
                    <span class="icon icone-code-fork red"></span>
                    <h5>
                      STEP 1<br/>
                      <small>Restaurant Information</small>
                    </h5>
                  </div>
                  <div class="control-group">
                    <label class="control-label">City</label>
                    <div class="controls">

                      <?php
                      $query = "select * from city";
                      $result = mysql_query($query) or die("Error in Selecting city :" . mysql_error());

                      echo '<select name="rest_city">';
                      while ($row = mysql_fetch_array($result)) {
                        $select = $row['city_id'] == $city_id ? "selected" : "";

                        echo "<option $select value='{$row['city_id']}' >{$row['city_name']}</option>";
                      }
                      echo '
                    </select>';
                      ?>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Locality</label>
                    <div class="controls">

                      <?php
                      $query = "select * from locality";
                      $result = mysql_query($query);

                      echo '<select name="rest_locality">';
                      while ($row = mysql_fetch_array($result)) {
                        $select = $row['locality_id'] == $locality_id ? "selected" : "";

                        echo "<option $select value='{$row['locality_id']}' >{$row['locality_name']}</option>";
                      }
                      echo '
                    </select>';
                      ?>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Restaurant Name</label>
                    <div class="controls">
                      <input type="text" name="rest_name" class="validate[required]">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Address</label>
                    <div class="controls">
                      <textarea name="rest_address" class="validate[required]"></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Phone Number</label>
                    <div class="controls">
                      <input type="text" name="rest_contact"  class="validate[required]">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Facility</label>
                    <div class="controls">
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_dine_in" value="dine_in"> Dine in
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox"name="rest_delivery" value="delivery"> Delivery
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_catering"value="catering"> Catering
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_take_away"value="take_away"> Take Away
                      </label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Feature</label>
                    <div class="controls">
                      <table>
                        <tr>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_air_con" value="air_con"> Air-Con
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_wifi"  value="wifi"> Wifi
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_bar" value="bar"> Bar
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_live_music"value="live_music"> Live Music
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_candle_light" value="candle_light">Candle Light
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_parking" value="parking"> Parking
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_pure_veg" value="pure_veg"> Pure Veg.
                            </label>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Timing</label>
                    <table>
                      <tr>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker1" name="rest_time1" placeholder="Pick Morning Time" class="validate[required]">
                          </div>
                        </td>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker11" name="rest_time3" placeholder="Pick Morning Time"  class="validate[required]">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker12" name="rest_time2" placeholder="Pick Evening Time"  class="validate[required]">
                          </div>
                        </td>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker13" name="rest_time4" placeholder="Pick Evening Time" class="validate[required]">
                          </div>
                        </td>
                      </tr>


                    </table>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Cost of Dish</label>
                    <div class="controls">
                      <input type="text" name="rest_cost" class="validate['required']">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Payment Option</label>
                    <div class="controls">
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_payment[]"value="CreditCard"> Credit Card
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_payment[]" value="Cash"> Cash
                      </label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Reservation</label>
                    <div class="controls">
                      <select name="rest_reservation">
                        <option value="Not Required">Not Required</option>
                        <option value="Recommended">Recommended</option>
                        <option value="Must">Must</option>
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Cuisines</label>
                    <div class="controls">


                      <?php
                      $query = "select * from cuisine";
                      $result = mysql_query($query) or die("Error in Selecting cuisine :" . mysql_error());

                      echo '<select name="rest_cuisine[]" class="span8" id="select2_2" placeholder="select Cuisine" multiple>';
                      while ($row = mysql_fetch_array($result)) {
                        $select = $row['cuisine_id'] == $cuisine_id ? "selected" : "";

                        echo "<option $select value='{$row['cuisine_id']}' >{$row['cuisine_name']}</option>";
                      }
                      echo '
                    </select>';
                      ?>


                    </div>
                  </div>
                  
                   <div class="control-group">
                    <label class="control-label">Restaurant Map Location</label>
                    <div class="controls">
                     <textarea name="rest_map" class="validate[required] ui-wizard-content" id="form-validation-field-0"></textarea>
                    </div>
                  </div> 
                </fieldset>
                <fieldset class="step" id="step2">
                  <div class="step-title">
                    <span class="icon icone-lightbulb teal"></span>
                    <h5>
                      STEP 3<br/>
                      <small>Owner Information</small>
                    </h5>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Owner Name</label>
                    <div class="controls">
                      <input type="text" name="rest_owner" class="required">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                      <textarea name="rest_email" class="validate[required,custom[email]]"></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                      <input type="text" name="rest_mobile" >
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Website</label>
                    <div class="controls">
                      <input type="text" name="rest_website" >
                    </div>
                  </div>
                </fieldset>

                <fieldset class="step" id="step3">
                  <div class="step-title">
                    <span class="icon icone-lock teal"></span>
                    <h5>
                      STEP 2<br/>
                      <small>Security Information</small>
                    </h5>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Password</label>
                    <div class="controls">
                      <input type="text" name="rest_password" class="validate[required]">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Confirm Password</label>
                    <div class="controls">
                      <input type="text" name="con_password" class="validate[required]">
                    </div>
                  </div>
                </fieldset>
                <!-- Form Action -->
                <div class="form-actions">
                  <input class="btn" id="back-1" value="Back" type="reset">
                  <input type="submit" class="btn btn-primary"  value="Next">
                  <a class="btn" href="restaurant-display.php" class="btn">Cancel</a>
                </div><!--/ Form Action -->
              </div>
            </section>
          </form>
          <!--/ END Form Validation - Tooltip -->
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