
<?php
session_start();
require './class/db-connection.php';
connection();
if (!isset($_SESSION['restaurant_id'])) {
    header("location:owner-login.php");
} else {

    if ($_GET) {
        $qry = mysql_real_escape_string($_GET['qry']);
        if (empty($qry) or $qry != $_SESSION['restaurant_id']) {
            header("location:index.php");
        } else {
            $query = "select * from restaurant_detail r,locality l , city c where r.rest_id='{$_SESSION['restaurant_id']}' and r.locality_id=l.locality_id and r.city_id=c.city_id";
            $result = mysql_query($query) or die(mysql_error());
            $row = mysql_fetch_array($result);
            if ($row > 0) {
                $rest_id = $row['rest_id'];
                $rest_name = $row['rest_name'];
                $locality_id = $row['locality_id'];
                $city_id = $row['city_id'];
                $rest_contact = $row['rest_contact'];
                $rest_address = $row['rest_address'];

                if ($row['rest_dine_in'] == 1) {
                    $rest_dine_in = "checked='checked'";
                } else {
                    $rest_dine_in = "";
                }
                if ($row['rest_delivery'] == 1) {
                    $rest_delivery = "checked='checked'";
                } else {
                    $rest_delivery = "";
                }
                if ($row['rest_catering'] == 1) {
                    $rest_catering = "checked='checked'";
                } else {
                    $rest_catering = "";
                }

                if ($row['rest_take_away'] == 1) {
                    $rest_take_away = "checked='checked'";
                } else {
                    $rest_take_away = "";
                }
                if ($row['rest_air_con'] == 1) {
                    $rest_air_con = "checked='checked'";
                } else {
                    $rest_air_con = "";
                }
                if ($row['rest_wifi'] == 1) {
                    $rest_wifi = "checked='checked'";
                } else {
                    $rest_wifi = "";
                }
                if ($row['rest_candle_light'] == 1) {
                    $rest_candle_light = "checked='checked'";
                } else {
                    $rest_candle_light = "";
                }
                if ($row['rest_live_music'] == 1) {
                    $rest_live_music = "checked='checked'";
                } else {
                    $rest_live_music = "";
                }
                if ($row['rest_pure_veg'] == 1) {
                    $rest_pure_veg = "checked='checked'";
                } else {
                    $rest_pure_veg = "";
                }
                if ($row['rest_parking'] == 1) {
                    $rest_parking = "checked='checked'";
                } else {
                    $rest_parking = "";
                }
                if ($row['rest_bar'] == 1) {
                    $rest_bar = "checked='checked'";
                } else {
                    $rest_bar = "";
                }

                $rest_cost = $row['rest_cost'];
                $rest_reservation = $row['rest_reservation'];
                $rest_cuisine_id = explode(",", $row['rest_cuisine_id']);
                $rest_time1 = $row['rest_time1_on'];
                $rest_time2 = $row['rest_time1_off'];
                $rest_time3 = $row['rest_time2_on'];
                $rest_time4 = $row['rest_time2_off'];
                $rest_payment1 = explode(",", $row['rest_payment']);
                $rest_owner = explode(" ", $row['rest_owner']);
                $rest_email = $row['rest_email'];
                $rest_website = $row['rest_website'];
                $rest_mobile = $row['rest_mobile'];
            }
        }
    }
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
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        $query="update restaurant_detail set rest_name='{$rest_name}',rest_address='{$rest_address}',rest_contact='{$rest_contact}',rest_cost='{$rest_cost}',rest_payment='{$rest_payment}',rest_reservation='{$rest_reservation}',rest_time1_on='{$rest_time1}',rest_time1_off='{$rest_time2}',rest_time2_on='{$rest_time3}',rest_time2_off='{$rest_time4}',city_id='{$city_id}',locality_id='{$locality_id}',rest_seo_name='{$rest_name}',rest_mobile='{$rest_mobile}',rest_cuisine_id='{$rest_cuisine}',rest_air_con='{$air_con}',rest_wifi='{$wifi}',rest_live_music='{$live_music}',rest_candle_light='{$candle_light}',rest_parking='{$parking}',rest_dine_in='{$dine_in}',rest_delivery='{$delivery}',rest_catering='{$catering}',rest_take_away='{$take_away}',rest_pure_veg='{$pure_veg}',rest_bar='{$bar}',rest_owner='{$rest_owner}',rest_email='{$rest_email}',rest_website='{$rest_website}' where rest_id='{$rest_id}'";
        $result=  mysql_query($query)or die(mysql_error());
        if($result)
        {
            echo "<script>alert('data updated');</script>";
            echo "$query";
            header("location:restaurant-display-detail.php?qry={$rest_id}");
        }
     else {
         echo "<script>alert(' error in data updated');</script>";
     }
    }
}
?>
<html>


    <head>
        <meta charset="utf-8">
        <title>Edit|RestaurantSearchEngine</title>
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
                                <h1>Update Restaurant Information</h1>
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
                                                    <input type="text" placeholder="Restaurant Name"  name="rest_name" class="input-text" value="<?php echo $rest_name; ?>">
                                                </p>
                                                <p  class="form-row form-row-first validate-required validate-email">
                                                    <label>Area/Locality <abbr title="required" class="required">*</abbr></label>
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
                                                    <input type="text"placeholder="Phone Number" name="rest_contact" class="input-text"value="<?php echo $rest_contact; ?>">
                                                </p>
                                                <div class="clear"></div>
                                                <p  class="form-row notes">
                                                    <label>Address</label>
                                                    <textarea rows="2" cols="5" placeholder="Restaurants complete address" name="rest_address"><?php echo $rest_address; ?></textarea>
                                                </p>
                                                <p  class="form-row form-row-wide">
                                                    <label>Facility</label>
                                                    <?php
                                                    echo"<input type='checkbox' name='rest_dine_in' value='dine_in' $rest_dine_in>
                                                    <label class='checkbox' style='margin-right:25px;'>Dine in</label>
                                                    <input type='checkbox'name='rest_delivery' value='delivery'$rest_delivery>
                                                    <label class='checkbox'style='margin-right:25px;'>Delivery</label>
                                                    <input type='checkbox' name='rest_catering'value='catering'$rest_catering>
                                                    <label class='checkbox'style='margin-right:25px;'>Catering</label>
                                                    <input type='checkbox' name='rest_take_away'value='take_away'$rest_take_away>
                                                    <label class='checkbox'>Take Away</label>";
                                                    ?>
                                                </p>
                                                <p  class="form-row form-row-wide">
                                                    <?php
                                                    echo " <label>Features</label>
                                                    <input type='checkbox' name='rest_air_con' value='air_con'$rest_air_con>
                                                    <label class='checkbox' style='margin-right:25px;'>Air-Con</label>
                                                    <input type='checkbox'name='rest_wifi' value='wifi'$rest_wifi>
                                                    <label class='checkbox'style='margin-right:25px;'>Wifi</label>
                                                    <input type='checkbox' name='rest_live_music'value='live_music'$rest_live_music>
                                                    <label class='checkbox'style='margin-right:25px;'>Live Music</label>
                                                    <input type='checkbox' name='rest_candle_light'value='candle_light'$rest_candle_light>
                                                    <label class='checkbox'>Candle Light</label>";
                                                    ?>
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <?php
                                                    echo "<input type='checkbox' name='rest_pure_veg' value='pure_veg'$rest_pure_veg>
                                                    <label class='checkbox' style='margin-right:25px;'>Pure Veg.</label>
                                                    <input type='checkbox'name='rest_bar' value='bar'$rest_bar>
                                                    <label class='checkbox'style='margin-right:25px;'>Bar</label>
                                                    <input type='checkbox' name='rest_parking'value='parking'$rest_parking>
                                                    <label class='checkbox'style='margin-right:25px;'>Parking</label>";
                                                    ?>
                                                </p>
                                                <p class="form-row form-row-first ">
                                                    <label>Cost of Dish</label>
                                                    <input type="text" autocomplete="no" name="rest_cost" placeholder="Appro. cost for 2 person" class="input-text" value="<?php echo $rest_cost; ?>">
                                                </p>
                                                <p  class="form-row form-row-last validate-required">
                                                    <label>Reservation Scheme </label>
                                                    <select name="rest_reservation">
                                                        <option value="Not Required"<?php $select = $rest_reservation == "Not Required" ? "selected" : ""; ?>>Not Required</option>
                                                        <option value="Recommended"<?php $select = $rest_reservation == "Recommended" ? "selected" : ""; ?>>Recommended</option>
                                                        <option value="Must"<?php $select = $rest_reservation == "Must" ? "selected" : ""; ?>>Must</option>
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
                                                    <label>cuisine <abbr title="required" class="required input-text">*</abbr></label>
                                                    <?php
                                                    $query = "select * from cuisine";
                                                    $result = mysql_query($query) or die("Error in Selecting cuisine :" . mysql_error());

                                                    echo "<select name='rest_cuisine[]' id='select2_2' placeholder='select Cuisine' multiple>";
                                                    while ($row = mysql_fetch_array($result)) {

                                                        if (in_array($row['cuisine_id'], $rest_cuisine_id)) {
                                                            $select = "selected='selected'";
                                                        } else {
                                                            $select = "";
                                                        }
                                                        echo "<option $select value='{$row['cuisine_id']}' >{$row['cuisine_name']}</option>";
                                                    }
                                                    echo "</select>";
                                                    ?>

                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row form-row-first">
                                                    <label>Morning Timing</label>
                                                    <input id="timepicker1" type="text" class="input-small timepicker" name="rest_time1" value="<?php echo $rest_time1; ?>">

                                                </p>
                                                <p class="form-row form-row-first">
                                                    <label>To</label>
                                                    <input id="timepicker2" type="text" class="input-small timepicker" name="rest_time2"value="<?php echo $rest_time2; ?>">
                                                </p>

                                                <div class="clear"></div>
                                                <p class="form-row form-row-first">
                                                    <label>Evening Timing</label>
                                                    <input id="timepicker3" type="text" class="input-small timepicker" name="rest_time3"value="<?php echo $rest_time3; ?>">
                                                </p>
                                                <p class="form-row form-row-first">
                                                    <label>To</label>
                                                    <input id="timepicker4" type="text" class="input-small timepicker" name="rest_time4"value="<?php echo $rest_time4; ?>">
                                                </p>
                                                <p class="form-row form-row-wide">
                                                    <label>Payment Option </label>
                                                    <input type="checkbox" name="rest_payment[]"value="CreditCard" <?php if (in_array("CreditCard", $rest_payment1)) {
                                                        echo "checked='checked'";
                                                    } else {
                                                        echo "";
                                                    } ?>>
                                                    <label class="checkbox" style="margin-right:25px;">Credit Card</label>
                                                    <input type="checkbox" name="rest_payment[]"value="Cash" <?php if (in_array("Cash", $rest_payment1)) {
                                                        echo "checked='checked'";
                                                    } else {
                                                        echo "";
                                                    } ?>>
                                                    <label class="checkbox" style="margin-right:25px;">Cash</label>
                                                </p>
                                                <h3>Owner Information</h3>
                                                <p  class="form-row form-row-first validate-required">
                                                    <label >First Name <abbr title="required" class="required">*</abbr></label>
                                                    <input type="text"  placeholder="First Name" name="rest_first_name" class="input-text"value="<?php echo $rest_owner[0]; ?>">
                                                </p>
                                                <p class="form-row form-row-last validate-required">
                                                    <label class="" for="rest_last_name">Last Name <abbr title="required" class="required">*</abbr></label>
                                                    <input type="text"  placeholder="Last Name" name="rest_last_name" class="input-text"value="<?php echo $rest_owner[1]; ?>">
                                                </p>
                                                <p id="account_username_field" class="form-row ">
                                                    <label class="" for="account_username">Email Address</label>
                                                    <input type="text" placeholder="Email Address"  name="rest_email" class="input-text" value="<?php echo $rest_email;?>">
                                                </p>
                                                <div class="clear"></div>

                                                <div class="clear"></div>
                                                <p  class="form-row form-row-first">
                                                    <label>Website</label>
                                                    <input type="text" placeholder="website" name="rest_website" class="input-text"value="<?php echo $rest_website; ?>">
                                                </p>
                                                <p class="form-row form-row-last">
                                                    <label>Mobile Number</label>
                                                    <input type="text" placeholder="Mobile Number" name="rest_mobile" class="input-text"value="<?php echo $rest_mobile; ?>">
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