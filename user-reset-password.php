<?php
require './class/db-connection.php';
connection();
ob_start();
$msg="";
if (isset($_GET['email'])) {
    $user_email = $_GET['email'];
    $msg = "<div class='msg msg-success'>
                <p>Enter New Password below.</p>
             </div>";
}
if ($_POST) {

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_con_password = $_POST['user_con_password'];
    if(empty($user_password)or empty($user_con_password))
    {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter all details.</div>";
       
    } elseif ($user_password == $user_con_password) {
        $user_password = md5($user_password);

        $query = "update foodie_detail set foodie_password='{$user_password}' where foodie_email='{$user_email}'";
        $result = mysql_query($query) or die(mysql_error());
        if ($result) {
            header("location:user-login.php?qry=pw-rst");
        }
    } else {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Your password does not match to confirm password.</div>";
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
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Reset Password</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>
                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">


                        <div style="display: block;width: 292px;">

                            <?php
                            echo $msg;
                            ?>

                            <form method="POST" class="ld-form"  >

                                <label class="z-label" ><b>Password</b></label>
                                <input type="password" name="user_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Confirm Password</b></label>
                                <input type="password" name="user_con_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <input type="submit" id="ld-submit-global" class=" btn btn-red right" value="Reset Password" style="width:150px;">
                                <input type='hidden' name='user_email' value='<?php echo $user_email; ?>'>

                            </form>
                        </div>

                    </div>


                </div></div></div>
    </body>
</html>




