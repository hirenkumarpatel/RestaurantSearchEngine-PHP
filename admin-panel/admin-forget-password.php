<?php
require './class/db-connection.php';
include './class/send-mail.php';
connection();
ob_start();
session_start();
$msg="";
$msg="<div class='msg msg-info'>
      <p><strong>Lost Password</strong><br>
      Follow this simple steps to reset your account</p>
      <ol>
        <li> Enter your email address</li>
        <li> Wait for your recovery details to be sent  </li>
        <li> Follow instructions and be re-united with your account </li>
      </ol>
    </div>";

if ($_POST) {
$admin_email = $_POST['admin_email'];

$query = "select * from admin where admin_email='{$admin_email}'";
$result = mysql_query($query) or die(mysql_error());
$row=  mysql_fetch_array($result);
if ($row) {
    $code = md5(uniqid());
    $query1 = "update admin set code='{$code}' where admin_email='{$admin_email}'";
    $result1 = mysql_query($query1);

    if ($result1) {
        
    $mail_sent = sendMail("RestaurantSearchEngine", "hirenpatel.project@gmail.com", "hiren patel185", $admin_email, "Reset Password", "<div class='msg'>
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
                  Someone recently requested that the password be reset for <strong>RestaurantSearchEngine</strong>.	</p>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0'>
                  To reset your password please click this button:	</p>
                  <div style='direction:ltr;margin:0 0 20px 0;font-size:14px;text-align:center'>
                  <p style='direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0'>
                  <a href='http://localhost/RestaurantSearchEngine/admin-panel/admin-verify-mail.php?code=$code&email=$admin_email' style='text-decoration:underline;color:#2585b2;border-radius:10em;border:1px solid #11729e;text-decoration:none;color:#fff;background-color:#2585b2;padding:5px 15px;font-size:16px;line-height:1.4em;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:normal;margin-left:0;white-space:nowrap' target='_blank'>
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
      
      $msg= "<div class='msg msg-warning'>			
            <p><span class='icone-exclamation-sign' style='font-size:28px;color:#e1b700;height:100%;'></span>
             <strong>Please confirm your email address.</strong><br>A confirmation email was sent to <strong> {$admin_email}</strong>. Confirmation will enable resetting of Password on your account. &nbsp;<br>If you don't get mail,try again..</p></div>";
            
      
      }
      
    }
 else {
    $msg = "<div class='msg msg-error'><p><strong>Error</strong>:User not found!<br>Please Provide Email address related to your account..</p></div>";  
    }
  }
  ?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="css/style.css" type="text/css"/>

</head>
<body  style="background:#f1f1f1;color:#444;">
  <div id='wrapper1'>     
    <?php
    echo $msg;
    ?>

    <form  name="form"  id="form" method="post">
      <p>
        <label>
          Enter Your Email Address<br>
          <input type="text" name="admin_email">
        </label>
      </p>
     <p class="submit">
        <input type="submit" id="login" class=" btn2" value="Reset Password">
      </p>
  </div>

</form>
