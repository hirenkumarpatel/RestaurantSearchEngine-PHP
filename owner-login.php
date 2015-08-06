<?php
require './class/db-connection.php';
connection();
session_start();
$msg = "";
if (isset($_GET['qry'])) {
    if ($_GET['qry'] == 'pw-rst') {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Your password has been reset.</div>";
    }
}
if (isset($_SESSION['restaurant_id'])) {
    header("location:restaurant-display-detail.php?qry={$_SESSION['restaurant_id']}");
}

if ($_POST) {
    $restaurant_email = mysql_real_escape_string($_POST['restaurant_email']);
    $restaurant_password = mysql_real_escape_string($_POST['restaurant_password']);

    if (empty($restaurant_email) or empty($restaurant_password)) {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter your email address and Password</div>";
    } else {
        $result = mysql_query("select rest_id,rest_email,rest_password from restaurant_detail where rest_email='{$restaurant_email}'") or die(mysql_error());

        $row = mysql_fetch_array($result);
        if ($row > 0) {

            if (md5($restaurant_password) == $row['rest_password']) {
                $_SESSION['restaurant_owner'] = $row['rest_owner'];
                $_SESSION['restaurant_id'] = $row['rest_id'];

                header("location:restaurant-display-detail.php?qry={$_SESSION['restaurant_id']}");
            } else {
                $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Invalid Password</div>";
            }
        } 
       
        else {
            
            $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>User not Found</div>";
        }
    }
}
?>
<html>
    <head>

        <link rel="stylesheet" href="css/zomato-style.css"/>

    </head>
    <body  style='background:#f1f1f1;color:#444;'>


        <div id="dialog-screen">

            <div id="dialog-container" style="display: block; width: 330px; visibility: visible; height:auto;top:20%;margin:auto;">
                <div class="dialog-head-container clearfix">
                    <div id="dialog-close">
                        <a href="index.php">
                            <div data-icon="x">
                            </div>
                        </a>

                    </div>
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Are you owner?</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>
                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">
                        <!--<div style="display: block;width: 292px;">-->

                            <?php
                            echo $msg;
                            ?>

                        <form method="POST">
                                <label class="z-label"><b>Email Address</b></label>
                                <input type="text" name="restaurant_email"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Password</b></label>
                                <input type="password" name="restaurant_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>
                                
                                <input type="submit" id="ld-submit-global" class=" btn btn-red right" value="Log in" style="width:90px;">
                                <div class="clear"></div>
                                <div style="padding: 10px 0px; margin-top: -40px;">
                                    <a class="ld-forgotpass" href="restaurant-forget-password.php">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
