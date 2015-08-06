<?php
require './class/db-connection.php';

session_start();
connection();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
} else {
    $foodie_id = $_SESSION['user_id'];
}

$msg = "";
if ($_POST) {
    
    $user_id = $_POST['user_id'];
    $user_password =  md5(mysql_real_escape_string($_POST['user_password']));
    $user_new_password = md5(mysql_real_escape_string($_POST['user_new_password']));
    $user_con_password = md5(mysql_real_escape_string($_POST['user_con_password']));
    if (empty($user_new_password) or empty($user_password) or empty($user_con_password)) {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter all detail.</div>";
    } else {
        $query = "select foodie_id from foodie_detail where foodie_id='{$user_id}' and foodie_password='{$user_password}'";
       
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        if ($row > 0) {
            if ($user_new_password == $user_con_password) {
                $query = "update foodie_detail set foodie_password='{$user_new_password}' where foodie_id='{$_SESSION['user_id']}'";
                $result = mysql_query($query) or die(mysql_error());
                if($result)
                {
                    header("location:index.php");
                }
            } else {
                $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Your Password doe not match to confirm password</div>";
            }
        } else {
            $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Invalid Password.</div>";
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

                            </div></a>
                    </div>
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Change Password</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>
                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">


                        <div style="display: block;width: 292px;">

                            <?php
                            echo $msg;
                            ?>

                            <form method="POST" class="ld-form"  >


                                <label class="z-label"><b>Current Password</b></label>
                                <input type="password" name="user_password"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>

                                <label class="z-label" ><b>New Password</b></label>
                                <input type="password" name="user_new_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Confirm Password</b></label>
                                <input type="password" name="user_con_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <input type="submit" id="ld-submit-global" class=" btn btn-red right" value="Change Password" style="width:120px;font-size: 12px;">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">




                            </form>
                        </div>



                    </div>


                </div></div></div>
    </body>
</html>

