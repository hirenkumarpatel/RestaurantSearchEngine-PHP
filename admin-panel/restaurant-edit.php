
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:restaurant-display.php");
}
$query = "select * from restaurant_detail where rest_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting Restaurant :" . mysql_error());
$row = mysql_fetch_array($result);

if ($row) {
  $city_id = $row['city_id'];
  $locality_id = $row['locality_id'];
  $rest_name = mysql_real_escape_string($row['rest_name']);
  $rest_address = mysql_real_escape_string($row['rest_address']);
  $rest_contact = mysql_real_escape_string($row['rest_contact']);
  $rest_dine_in=  mysql_real_escape_string($row['rest_dine_in']);
  $rest_delivery=  mysql_real_escape_string($row['rest_delivery']);
  $rest_Catering=  mysql_real_escape_string($row['rest_catering']);
  $rest_take_away=  mysql_real_escape_string($row['rest_take_away']);
  $rest_air_con=  mysql_real_escape_string($row['rest_air_con']);
  $rest_wifi=  mysql_real_escape_string($row['rest_wifi']);
  $rest_live_music=  mysql_real_escape_string($row['rest_live_music']);
  $rest_candle_light=  mysql_real_escape_string($row['rest_candle_light']);
  $rest_parking=  mysql_real_escape_string($row['rest_parking']);
  $rest_pure_veg=  mysql_real_escape_string($row['rest_pure_veg']);
  $rest_bar=  mysql_real_escape_string($row['rest_bar']);
  $rest_time1 = $row['rest_time1_on'];
  $rest_time2 = $row['rest_time1_off'];
  $rest_time3 = $row['rest_time2_on'];
  $rest_time4 = $row['rest_time2_off'];
  $rest_cost = $row['rest_cost'];
  $rest_payment = explode(",", $row['rest_payment']);
  $rest_reservation = $row['rest_reservation'];
  $rest_cuisine = explode(",", $row['rest_cuisine_id']);
  $rest_owner = $row['rest_owner'];
  $rest_email = $row['rest_email'];
  $rest_mobile = $row['rest_mobile'];
  $rest_website = $row['rest_website'];
  $rest_map=$row['rest_map'];
  
  
  

}


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
  
 

  /* $rest_file_menu = $_FILES['rest_file_menu']['name'];
    $rest_file_photo = $_FILES['rest_file_photo']['name']; */
  //print_r($rest_cuisine);

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
$query = "update restaurant_detail set "
          . "rest_name='{$rest_name}',rest_address='{$rest_address}',rest_contact='{$rest_contact}',rest_cost='{$rest_cost}',rest_payment='{$rest_payment}',"
          . "rest_reservation='{$rest_reservation}',rest_time1_on='{$rest_time1}',rest_time1_off='{$rest_time2}',rest_time2_on='{$rest_time3}',"
          . "rest_time2_off='{$rest_time4}',city_id='{$rest_city}',locality_id='{$rest_locality}',rest_cuisine_id='{$rest_cuisine}',rest_air_con='{$air_con}',"
          . "rest_wifi='{$wifi}',rest_live_music='{$live_music}',rest_candle_light='{$candle_light}',rest_parking='{$parking}',rest_bar='{$bar}',rest_dine_in='{$dine_in}',"
          . "rest_delivery='{$delivery}',rest_catering='{$catering}',rest_take_away='{$take_away}',rest_pure_veg='{$pure_veg}',"
          . "rest_owner='{$rest_owner}',rest_email='{$rest_email}',rest_mobile='{$rest_mobile}',rest_website='{$rest_website}',rest_map='{$rest_map}' "
          . "where rest_id='{$qry}'";

  $result = mysql_query($query) or die(mysql_error());
  
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
  <title>Edit</title>
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
              <li class="active">Edit Restaurant</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          
        <!-- START Row -->
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
                      <input type="text" name="rest_name"  value="<?php echo $rest_name;?>"class="validate[required]">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Address</label>
                    <div class="controls">
                      <textarea name="rest_address" class="validate[required]"><?php echo $rest_address;?></textarea>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Phone Number</label>
                    <div class="controls">
                      <input type="text" name="rest_contact"  value="<?php echo $rest_contact;?>" class="validate[required]">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Facility</label>
                    <div class="controls">
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_dine_in" value="dine_in" <?php  if($rest_dine_in==1){echo "checked";}?>> Dine in
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox"name="rest_delivery" value="delivery"<?php  if($rest_delivery==1){echo "checked";}?>> Delivery
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_catering"value="catering"<?php  if($rest_Catering==1){echo "checked";}?>> Catering
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_take_away"value="take_away"<?php  if($rest_take_away==1){echo "checked";}?>> Take Away
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
                              <input type="checkbox" name="rest_air_con" value="air_con"<?php  if($rest_air_con==1){echo "checked";}?>> Air-Con
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_wifi"  value="wifi"<?php  if($rest_wifi==1){echo "checked";}?>> Wifi
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_bar" value="bar"<?php  if($rest_bar==1){echo "checked";}?>> Bar
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_live_music"value="live_music"<?php  if($rest_live_music==1){echo "checked";}?>> Live Music
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_candle_light" value="candle_light"<?php  if($rest_candle_light==1){echo "checked";}?>>Candle Light
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_parking" value="parking"<?php  if($rest_parking==1){echo "checked";}?>> Parking
                            </label>
                          </td>
                          <td>
                            <label class="checkbox inline styled">
                              <input type="checkbox" name="rest_pure_veg" value="pure_veg"<?php  if($rest_pure_veg==1){echo "checked";}?>> Pure Veg.
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
                            <input type="text" id="timepicker1" name="rest_time1" placeholder="Pick Morning Time" class="validate[required]" value="<?php echo $rest_time1;?>">
                          </div>
                        </td>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker11" name="rest_time3" placeholder="Pick Morning Time"  class="validate[required]"value="<?php echo $rest_time3;?>">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker12" name="rest_time2" placeholder="Pick Evening Time"  class="validate[required]"value="<?php echo $rest_time2;?>">
                          </div>
                        </td>
                        <td>
                          <div class="controls">
                            <input type="text" id="timepicker13" name="rest_time4" placeholder="Pick Evening Time" class="validate[required]"value="<?php echo $rest_time4;?>">
                          </div>
                        </td>
                      </tr>


                    </table>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Cost of Dish</label>
                    <div class="controls">
                      <input type="text" name="rest_cost" class="validate['required']"value="<?php echo $rest_cost;?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Payment Option</label>
                    <div class="controls">
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_payment[]"value="CreditCard"<?php  if(in_array("CreditCard", $rest_payment)>0){echo "checked";} ?>> Credit Card
                      </label>
                      <label class="checkbox inline styled">
                        <input type="checkbox" name="rest_payment[]" value="Cash"<?php  if(in_array("Cash", $rest_payment)>0){echo "checked";} ?>> Cash
                      </label>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Reservation</label>
                    <div class="controls">
                      <select name="rest_reservation">
                        <option value="Not Required"<?php  if($rest_reservation=="Not Required"){echo "selected";}?>>Not Required</option>
                        <option value="Recommended"<?php  if($rest_reservation=="Recommended"){echo "selected";}?>>Recommended</option>
                        <option value="Must"<?php  if($rest_reservation=="Must"){echo "selected";}?>>Must</option>
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
                        $select ="";
                        if(in_array($row['cuisine_id'], $rest_cuisine)>0)
                        {
                        $select="selected";
                          
                        }

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
                      <input type="text" name="rest_owner" class="required" value="<?php echo $rest_owner;?>">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Email</label>
                    <div class="controls">
                      <input type="text" name="rest_email" value="<?php echo $rest_email;?>" >
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                      <input type="text" name="rest_mobile" value="<?php echo $rest_mobile;?>" >
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Website</label>
                    <div class="controls">
                      <input type="text" name="rest_website" value="<?php echo $rest_website;?>" >
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