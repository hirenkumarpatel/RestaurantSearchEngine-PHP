<?php
require './class/db-connection.php';
include './class/send-mail.php';
connection();
ob_start();
session_start();
$msg = "";
$msg = "";

if ($_POST) {
    $user_email = mysql_real_escape_string($_POST['user_email']);
    if (empty($user_email)) {
        $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>Please enter email address related to your account</div>";
    } else {
        $query = "select * from foodie_detail where foodie_email='{$user_email}'";
        $result = mysql_query($query) or die(mysql_error());
        $row = mysql_fetch_array($result);
        if ($row) {
            $code = md5(uniqid());
            $query1 = "update foodie_detail set code='{$code}' where foodie_email='{$user_email}'";
            $result1 = mysql_query($query1);

            if ($result1) {
                
                  $mail_sent = sendMail("Global Cuisine", "akashinfotech16@gmail.com", "aiproject", $user_email, "Reset Password", "<div class='msg'>
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
                  Password Reset	</h2>
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
                  Someone recently requested that the password be reset for <strong>Global Cuisine</strong>.	</p>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  To reset your password please click this button:	</p>
                  <div style='direction:ltr;margin:0 0 20px 0;font-size:14px;text-align:center'>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0'>
                  <a href='http://localhost/RestaurantSearchEngine/user-verify-mail.php?code=$code&email=$user_email' style='text-decoration:underline;color:#2585b2;border-radius:10em;border:1px solid #11729e;text-decoration:none;color:#fff;background-color:#2585b2;padding:5px 15px;font-size:16px;line-height:1.4em;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:normal;margin-left:0;white-space:nowrap' target='_blank'>
                  Reset password	</a>
                  </p>
                  </div>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  If this is a mistake just ignore this email - your password will not be changed.	</p>
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
                 
                $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'><strong>Please confirm your email address.</strong><br>A confirmation email was sent to <strong> {$user_email}</strong>. Confirmation will enable resetting of Password on your account. &nbsp;<br>If you don't get mail,try again..</div>";
            }
        } else {
            $msg = "<div  class='error-message-highlight-small mbot hidden' style='display: block;font-size:16px;'>User not found!</div>";
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
                    <div id="dialog-head" style="width: 240px;"><span id="dialog-head-text">Forgot Password?</span><div class="clear"></div></div></div><div id="dialog-busy" style="display:none;">
                    <div id="busy-text" style="display:block;"></div></div>

                <div id="dialog-body" style=" display: block;width: 292px;">
                    <div class="column clearfix">


                        <div style="display: block;width: 292px;">
                            <p>Please enter the email address you signed up with and we'll send you a password reset link.</p>
<?php
echo $msg;
?>

                            <form method="POST" class="ld-form"  >

                                <label class="z-label"><b>Email Address</b></label>
                                <input type="text" name="user_email"   style="width: 270px; margin-bottom: 10px;font-size: 16px;"><br>

                                <input type="submit" id="ld-submit-global" class=" btn btn-red  right" value="Reset Password" style="width:150px;">




                            </form>
                        </div>



                    </div>


                </div></div></div>
    </body>
</html>
