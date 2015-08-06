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
if (!isset($_SESSION['user_id']) and isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $query = "select foodie_name from foodie_detail where foodie_id='{$_SESSION['user_id']}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
        $_SESSION['user_name'] = $row['foodie_name'];
    }
}
if (isset($_SESSION['user_id'])) {
    header("location:index.php");
}

if ($_POST) {
    $user_email = mysql_real_escape_string($_POST['user_email']);
    $user_password = mysql_real_escape_string($_POST['user_password']);

    if (empty($user_email) or empty($user_password)) {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter your email address and Password</div>";
    } else {
        $result = mysql_query("select foodie_id,foodie_email,foodie_password,"
                . "foodie_status,foodie_name,foodie_id from foodie_detail"
                . " where foodie_email='{$user_email}' and foodie_status='1'") or mysql_error();

        $row = mysql_fetch_array($result);
        if ($row > 0) {

            if (md5($user_password) == $row['foodie_password']) {
                $_SESSION['user_name'] = $row['foodie_name'];
                $_SESSION['user_id'] = $row['foodie_id'];

                if (isset($_POST['remember_me'])) {
                    setcookie("user_id", $row['foodie_id'], time() + 60 * 60 * 1 * 24);
                }
                header("location:index.php");
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
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Log in to Global Cuisine</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>
                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">
                        <!--<div style="display: block;width: 292px;">-->

                            <?php
                            echo $msg;
                            ?>

                        <form method="POST">
                                <label class="z-label"><b>Email Address</b></label>
                                <input type="text" name="user_email"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Password</b></label>
                                <input type="password" name="user_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <input style="margin-right: 5px;" type="checkbox"  name="remember_me" checked="">
                                <label style="font-size: 16px;" >Remember me on this computer</label><br><br>

                                <input type="submit" id="ld-submit-global" class=" btn btn-red right" value="Log in" style="width:90px;">
                                <div class="clear"></div>
                                <div style="padding: 10px 0px; margin-top: -40px;">
                                    <a class="ld-forgotpass" href="user-forget-password.php">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
