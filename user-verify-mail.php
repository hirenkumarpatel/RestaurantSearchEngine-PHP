<?php
require './class/db-connection.php';
connection();
ob_start();
if (isset($_GET['code']) and isset($_GET['email'])) {
  $code = $_GET['code'];
  $user_email = $_GET['email'];
  $query = "select * from foodie_detail where foodie_email='{$user_email}' and code='{$code}'";
  $result = mysql_query($query) or die(mysql_error());
  $row=  mysql_fetch_array($result);
  if ($row) {
    header("location:user-reset-password.php?email={$user_email}");
  }
  else
  {
    echo "<html>
            <head><link rel='stylesheet' href='css/style.css' type='text/css'/></head>
            <body style='background:#f1f1f1;color:#444;'>
            
              <div id='wrapper1'><div class='msg msg-error'>			
                <p><span class='icone-remove-sign' style='font-size:28px;color:#dd3d36;height:100%;'></span>
                 <strong>Invalid acceess key.</strong><br>Please Provide valid access key sent to <strong> {$user_email}</strong>.<br>If you don't get mail,try again..
                </p>
              </div></div>
            </body></html>";

  }
}
  ?>

