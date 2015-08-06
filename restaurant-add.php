
<?php
require './class/db-connection.php';
include './class/send-mail.php';
connection();

$msg = '';
if ($_POST) {

    $rest_city = $_POST['rest_city'];
    $rest_locality = $_POST['rest_locality'];
    $rest_name = mysql_real_escape_string($_POST['rest_name']);
    $rest_address = mysql_real_escape_string($_POST['rest_address']);
    $rest_contact = mysql_real_escape_string($_POST['rest_contact']);

    $rest_time1 = mysql_real_escape_string($_POST['rest_time1']);
    $rest_time2 = mysql_real_escape_string($_POST['rest_time2']);
    $rest_time3 = mysql_real_escape_string($_POST['rest_time3']);
    $rest_time4 = mysql_real_escape_string($_POST['rest_time4']);
    $rest_cost = mysql_real_escape_string($_POST['rest_cost']);
    $rest_payment = implode(",", $_POST['rest_payment']);
    $rest_reservation = $_POST['rest_reservation'];
    $rest_cuisine = implode(",", $_POST['rest_cuisine']);
    $rest_owner = mysql_real_escape_string($_POST['rest_first_name']) . " " . mysql_real_escape_string($_POST['rest_last_name']);
    $rest_email = mysql_real_escape_string($_POST['rest_email']);
    $rest_mobile = mysql_real_escape_string($_POST['rest_mobile']);
    $rest_website = mysql_real_escape_string($_POST['rest_website']);
    $rest_password = mysql_real_escape_string($_POST['rest_password']);
    $con_password = mysql_real_escape_string($_POST['rest_con_password']);
    $code = md5(uniqid($rest_password));
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
            . "rest_owner,rest_email,rest_mobile,rest_website,rest_password,code)"
            . "values('{$rest_name}','{$rest_address}','{$rest_contact}','{$rest_cost}',"
            . "'{$rest_payment}','{$rest_reservation}','{$rest_time1}','{$rest_time2}',"
            . "'{$rest_time3}','{$rest_time4}','{$rest_city}','{$rest_locality}','{$rest_name}',"
            . "'{$rest_cuisine},','{$air_con}','{$wifi}','{$live_music}','{$candle_light}','{$parking}',"
            . "'{$bar}','{$dine_in}','{$delivery}','{$take_away}','{$catering}','{$pure_veg}',"
            . "'{$rest_owner}','{$rest_email}','{$rest_mobile}','{$rest_website}','{$rest_password}','{$code}')";


    $result = mysql_query($query) or die(mysql_error());
    if ($result) {


        move_uploaded_file($_FILES["restaurant_photo"]["tmp_name"], $path);
       
        
        $mail_sent = sendMail("Global Cuisine", "akashinfotech16@gmail.com", "aiproject", $rest_email, "Activation", "<div class='msg'>
                  <table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#DDDDDD' style='width:100%;background:#dddddd'>
                  <tbody><tr>
                  <td>
                  <table border='0' cellspacing='0' cellpadding='0' align='center' width='550' style='width:100%;padding:10px'>
                  <tbody><tr>
                  <td>
                  <div style='direction:ltr;max-width:600px;margin:0 auto'>
                  <table border='0' cellspacing='0' cellpadding='0' bgcolor='#ffffff' style='width:100%;background-color:#fff;text-align:left;margin:0 auto;max-width:1024px;min-width:320px'>
                  <tbody><tr>
                  <td>
                  <table width='100%' border='0' cellspacing='0' cellpadding='0' height='8' style='width:100%;background-color:#43a4d0;height:8px'>
                  <tbody><tr>
                  <td></td>
                  </tr>
                  </tbody></table>
                  <table width='100%' border='0' cellspacing='0' cellpadding='0' style='width:100%;background-color:#efefef;padding:0;border-bottom:1px solid #ddd'>
                  <tbody><tr>
                  <td>
                  <h2 style='padding:0;margin:5px 20px;font-size:16px;line-height:1.4em;font-weight:normal;color:#464646;font-family:&quot;Helvetica Neue&quot,Helvetica,Arial,sans-serif'>
                  Account Activation	</h2>
                  </td>
                  <td style='vertical-align:middle' height='32' width='32' valign='middle' align='right'>
                    &nbsp;
                  </td>
                  </tr>
                  </tbody></table>
                  <table style='width:100%' width='100%' border='0' cellspacing='0' cellpadding='20' bgcolor='#ffffff'>
                  <tbody><tr>
                  <td>
                  <table style='width:100%' border='0' cellspacing='0' cellpadding='0'>
                  <tbody><tr>
                  <td valign='top' style='width:60px'>
                    <img src=''></td>
                  <td valign='top' style='padding:0 0 0 20px'>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  Congratulations you have successfully registered in <strong>Global Cuisine</strong>.	</p>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  To activate your account please click this button:	</p>
                  <div style='direction:ltr;margin:0 0 20px 0;font-size:14px;text-align:center'>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0'>
                  <a href='http://localhost/RestaurantSearchEngine/restaurant-verification.php?qry=$code' style='text-decoration:underline;color:#2585b2;border-radius:10em;border:1px solid #11729e;text-decoration:none;color:#fff;background-color:#2585b2;padding:5px 15px;font-size:16px;line-height:1.4em;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:normal;margin-left:0;white-space:nowrap' target='_blank'>
                  Confirm Registration	</a>
                  </p>
                  </div>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  It is mandetory to confirm your mail or you will not be able to access your account	</p>
                  </td>
                  </tr>
                  </tbody></table>
                  </td>
                  </tr>
                  </tbody></table>
                  <table border='0' cellspacing='0' width='100%' cellpadding='20' bgcolor='#efefef' style='width:100%;background-color:#efefef;text-align:left;border-top:1px solid #dddddd'>
                  <tbody>
                  </tbody></table>
                  </td>
                  </tr>
                  </tbody></table>
                  <table width='100%' border='0' cellspacing='0' cellpadding='0' height='3' style='width:100%;background-color:#43a4d0;height:3px'>
                  <tbody><tr>
                  <td></td>
                  </tr>
                  </tbody></table>
                  </div>
                  </td>
                  </tr>
                  </tbody></table>

                  </td>
                  </tr>
                  </tbody></table>
                  </div>"); 
        
        
        if ($mail_sent) {
            echo "<div class='alert-success'>You have successfully registered with RestaurantSearch Engine.<br>Please check your Email to Activate your account.</div>";
        } else {
            echo "<div class='alert-error'>Error in sending mail</div>";
        }
        header("location:index.php?qry=true");
    } else {
        header("location:index.php?qry=false");
    }
}
?>


<html>


    <head>
        <meta charset="utf-8">
        <title>User Registration|RestaurantSearchEngine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include './theme-part/header-script.php'; ?>
    </head>

    <body>
        <!--Wrapper Start-->
        <div id="wrapper"> 
            <!--Header Start-->
            <?php include './theme-part/header.php'; ?>
            <!--Header End--> 

            <!--Banner Start-->
            <section id="banner" class="height">
                <div class="contact-banner"><img src="images/inner-banner-5.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 

            <!--Content Area Start-->
            <section id="content" class="container"> 
                <!--Blog Page Section Start-->
                <section class="blog-page-section">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading">
                                <h1>Restaurant Registration</h1>
                            </div>
                        </div>
                        <!--Blog Post End--> 

                    </div>
                </section>
                <!--Blog Page Section End--> 

                <!--Registration Start-->
                <section >
                    <div class="row-fluid">
                        <div class="span12" >
                            <article class="span12 mbtm  first">
                                <div class="woocommerce">
                                    <form   method="post">
                                        <div id="customer_details" class="col2-set">
                                            <div class="col-1">
                                                <h3>Restaurant Information</h3>
                                                <p  class="form-row form-row-wide">
                                                    <label>city <abbr title="required" class="required">*</abbr></label>
                                                    <?php
                                                    $query = "select * from city";
                                                    $result = mysql_query($query) or die("Error in Selecting city :" . mysql_error());

                                                    echo '<select name="rest_city">';
                                                    while ($row = mysql_fetch_array($result)) {
                                                        $select = $row['city_id'] == $city_id ? "selected" : "";
                                                        echo "<option $select value='{$row['city_id']}' >{$row['city_name']}</option>";
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </p>
                                                <p  class="form-row form-row-wide">
                                                    <label>Restaurant Name</label>
                                                    <input type="text" placeholder="Restaurant Name"  name="rest_name" class="input-text">
                                                </p>
                                                <p  class="form-row form-row-first validate-required validate-email">
                                                    <label>Area/Locality <abbr title="required" required="">*</abbr></label>
                                                    <?php
                                                    $query = "select * from locality order by city_id";
                                                    $result = mysql_query($query);

                                                    echo "<select name='rest_locality'>";
                                                    while ($row = mysql_fetch_array($result)) {
                                                        $select = $row['locality_id'] == $locality_id ? "selected" : "";

                                                        echo "<option $select value='{$row['locality_id']}' >{$row['locality_name']}</option>";
                                                    }
                                                    echo "</select>";
                                                    ?>
                                                </p>
                                                <p class="form-row form-row-last validate-required">
                                                    <label>Phone <abbr title="required" class="required">*</abbr></label>
                                                    <input type="text"placeholder="Phone Number" name="rest_contact" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                                <p  class="form-row notes">
                                                    <label>Address</label>
                                                    <textarea rows="2" cols="5" placeholder="Restaurants complete address" name="rest_address" required=""></textarea>
                                                </p>
                                                <p  class="form-row form-row-wide">
                                                    <label>Facility</label>

                                                    <input type="checkbox" name="rest_dine_in" value="dine_in">
                                                    <label class="checkbox" style="margin-right:25px;">Dine in</label>
                                                    <input type="checkbox"name="rest_delivery" value="delivery">
                                                    <label class="checkbox"style="margin-right:25px;">Delivery</label>
                                                    <input type="checkbox" name="rest_catering"value="catering">
                                                    <label class="checkbox"style="margin-right:25px;">Catering</label>
                                                    <input type="checkbox" name="rest_take_away"value="take_away">
                                                    <label class="checkbox">Take Away</label>

                                                </p>
                                                <p  class="form-row form-row-wide">
                                                    <label>Features</label>
                                                    <input type="checkbox" name="rest_air_con" value="air_con">
                                                    <label class="checkbox" style="margin-right:25px;">Air-Con</label>
                                                    <input type="checkbox"name="rest_wifi" value="wifi">
                                                    <label class="checkbox"style="margin-right:25px;">Wifi</label>
                                                    <input type="checkbox" name="rest_live_music"value="live_music">
                                                    <label class="checkbox"style="margin-right:25px;">Live Music</label>
                                                    <input type="checkbox" name="rest_candle_light"value="candle_light">
                                                    <label class="checkbox">Candle Light</label>
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <input type="checkbox" name="rest_pure_veg" value="pure_veg">
                                                    <label class="checkbox" style="margin-right:25px;">Pure Veg.</label>
                                                    <input type="checkbox"name="rest_bar" value="bar">
                                                    <label class="checkbox"style="margin-right:25px;">Bar</label>
                                                    <input type="checkbox" name="rest_parking"value="parking">
                                                    <label class="checkbox"style="margin-right:25px;">Parking</label>
                                                </p>
                                                <p class="form-row form-row-first ">
                                                    <label>Cost of Dish</label>
                                                    <input type="text" autocomplete="no" required="" name="rest_cost" placeholder="Appro. cost for 2 person" class="input-text" pattern="[0-9]{1,4}">
                                                </p>
                                                <p  class="form-row form-row-last validate-required">
                                                    <label>Reservation Scheme </label>
                                                    <select name="rest_reservation">
                                                        <option value="Not Required">Not Required</option>
                                                        <option value="Recommended">Recommended</option>
                                                        <option value="Must">Must</option>
                                                    </select>
                                                </p>
                                                <div class="clear"></div>

                                            </div>
                                            <div class="col-2">
                                                <p>
                                                    <label>&nbsp;</label>
                                                    <label>&nbsp;</label>
                                                </p>

                                                <p  class="form-row form-row-wide">
                                                    <label>cuisine <abbr title="required" class="required input-text" >*</abbr></label>
                                                    <?php
                                                    $query = "select * from cuisine";
                                                    $result = mysql_query($query) or die("Error in Selecting cuisine :" . mysql_error());

                                                    echo "<select name='rest_cuisine[]' id='select2_2' placeholder='select Cuisine' multiple>";
                                                    while ($row = mysql_fetch_array($result)) {
                                                        $select = $row['cuisine_id'] == $cuisine_id ? "selected" : "";

                                                        echo "<option $select value='{$row['cuisine_id']}' >{$row['cuisine_name']}</option>";
                                                    }
                                                    echo "</select>";
                                                    ?>

                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row form-row-first">
                                                    <label>Morning Timing</label>
                                                    <input id="timepicker1" type="text" class="input-small timepicker" name="rest_time1" required="">

                                                </p>
                                                <p class="form-row form-row-first">
                                                    <label>To</label>
                                                    <input id="timepicker2" type="text" class="input-small timepicker" name="rest_time2" required="">
                                                </p>

                                                <div class="clear"></div>
                                                <p class="form-row form-row-first">
                                                    <label>Evening Timing</label>
                                                    <input id="timepicker3" type="text" class="input-small timepicker" name="rest_time3" required="">
                                                </p>
                                                <p class="form-row form-row-first">
                                                    <label>To</label>
                                                    <input id="timepicker4" type="text" class="input-small timepicker" name="rest_time4" required="">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label>Payment Option </label>
                                                    <input type="checkbox" name="rest_payment[]"value="CreditCard">
                                                    <label class="checkbox" style="margin-right:25px;">Credit Card</label>
                                                    <input type="checkbox" name="rest_payment[]"value="Cash">
                                                    <label class="checkbox" style="margin-right:25px;">Cash</label>
                                                </p>
                                                <h3>Owner Information</h3>
                                                <p  class="form-row form-row-first validate-required">
                                                    <label >First Name <abbr title="required" class="required">*</abbr></label>
                                                    <input type="text"  placeholder="First Name" name="rest_first_name" class="input-text" required="">
                                                </p>
                                                <p class="form-row form-row-last validate-required">
                                                    <label class="" for="rest_last_name">Last Name <abbr title="required" class="required">*</abbr></label>
                                                    <input type="text"  placeholder="Last Name" name="rest_last_name" class="input-text" required="">
                                                </p>
                                                <div class="clear"></div>

                                                <p id="account_username_field" class="form-row ">
                                                    <label class="" for="account_username">Email Address</label>
                                                    <input type="text" placeholder="Email Address"  name="rest_email" class="input-text" required="" pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$">
                                                </p>
                                                <p id="account_password_field" class="form-row form-row-first">
                                                    <label class="" for="account_password">Account password</label>
                                                    <input type="password" placeholder="Password" id="account_password" name="rest_password" class="input-text">
                                                </p>
                                                <p id="account_password-2_field" class="form-row form-row-last">
                                                    <label class="hidden" for="account_password-2">Confirm password</label>
                                                    <input type="password" placeholder="Confirm password" id="account_password-2" name="rest_con_password" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                                <p  class="form-row form-row-first">
                                                    <label>Website</label>
                                                    <input type="text" placeholder="website" name="rest_website" class="input-text">
                                                </p>
                                                <p class="form-row form-row-last">
                                                    <label>Mobile Number</label>
                                                    <input type="text" placeholder="Mobile Number" name="rest_mobile" class="input-text">
                                                </p>
                                                <div class="clear"></div>
                                            </div>
                                        </div>

                                        <div id="order_review" style="position: relative;">
                                            <div id="payment">
                                                <div class="form-row place-order">
                                                    <input type="submit" value="Submit Information" id="place_order" class="button alt">
                                                    <div>
                                                        <div class="clear"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            </article>
                        </div>
                    </div>
                </section>
                <!--Checkout End--> 

            </section>
            <!--Content Area End--> 

            <!--Footer Area Start-->
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


<script>
    $(function() {
        if (jQuery().select2) {
            $("#select2_1").select2({
                placeholder: "Select a State"
            });
            $("#select2_2").select2({
                placeholder: "Select a State",
                allowClear: true
            });
            $("#select2_3").select2({
                minimumInputLength: 2
            });
            $("#select2_4").select2({
                tags: ["red", "green", "blue", "yellow", "purple", "brown"]
            });
        }
    });
</script>
</html>