<?php
require './class/db-connection.php';
require './class/send-mail.php';
session_start();
connection();

$msg = "";
if ($_POST) {
    $user_name = mysql_real_escape_string($_POST['user_name']);
    $user_email = mysql_real_escape_string($_POST['user_email']);
    $user_password = md5(mysql_real_escape_string($_POST['user_password']));
    $user_con_password = md5(mysql_real_escape_string($_POST['user_con_password']));
    if (empty($user_email) or empty($user_password) or empty($user_con_password) or empty($user_name)) {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter all detail for registration.</div>";
    } else {
        $code = md5(uniqid($user_password));
        if ($user_password == $user_con_password) {
            $query = "insert into foodie_detail(foodie_name,foodie_email,foodie_password,code)values('{$user_name}','{$user_email}','{$user_password}','{$code}')";
            $result = mysql_query($query) or die(mysql_error());
            if ($result) {

                $mail_sent = sendMail("Global Cuisine", "akashinfotech16@gmail.com", "aiproject", $user_email, "Activation", "<div class='msg'>
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
                  <a href='http://localhost/RestaurantSearchEngine/user-verification.php?code=$code&email=$user_email' style='text-decoration:underline;color:#2585b2;border-radius:10em;border:1px solid #11729e;text-decoration:none;color:#fff;background-color:#2585b2;padding:5px 15px;font-size:16px;line-height:1.4em;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:normal;margin-left:0;white-space:nowrap' target='_blank'>
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
                    $msg = "<div  class='success-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>You have successfully Registered<br>Please Confirm Your Mail sent to You.</div>";
                } else {
                    $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Problem in Sending Mail Please check your Internet Connection</div>";
                }
               
            } else {
               
            }
        }
        else
        {
            $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Your Password doe not match to confirm password</div>";
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
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Register to Global Cuisine</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>
                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">


                        <div style="display: block;width: 292px;">

<?php
echo $msg;
?>

                            <form method="POST" class="ld-form"  >

                                <label class="z-label"><b>Full Name</b></label>
                                <input type="text" name="user_name"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>


                                <label class="z-label"><b>Email Address</b></label>
                                <input type="text" name="user_email"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Password</b></label>
                                <input type="password" name="user_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <label class="z-label" ><b>Confirm Password</b></label>
                                <input type="password" name="user_con_password" style="width: 270px; margin-bottom: 20px;font-size: 16px;"><br>

                                <input type="submit" id="ld-submit-global" class=" btn btn-red right" value="Register" style="width:90px;">




                            </form>
                        </div>



                    </div>


                </div></div></div>
    </body>
</html>

