<?php
require './class/db-connection.php';
connection();
ob_start();
if (isset($_GET['email'])) {
  $admin_email = $_GET['email'];
  $msg = "<div class='msg msg-success'>
                <p>Enter New Password below.</p>
             </div>";
}
if ($_POST) {
  echo "<pre>";
  echo "</pre>";
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];
  $admin_con_password = $_POST['admin_con_password'];
  
  if(empty ($admin_password) or empty($admin_con_password)) {
    $msg = "<div class='msg msg-error'>			
            <p><strong>Error</strong> :Your password can not be empty!</p></div>";
  }
  elseif ($admin_password == $admin_con_password) {
    $admin_password = md5($admin_password);
   
    $query = "update admin set admin_password='{$admin_password}' where admin_email='{$admin_email}'";
    $result = mysql_query($query) or die(mysql_error());
    if ($result) {
      header("location:index.php?qry=pw-reset");
     
    }
  }
 
  else {
    $msg = "<div class='msg msg-error'>			
            <p><strong>Error</strong> :Your password does not match to confirm password!</p></div>";
  }
}
?>

<html>
  <head>
    <link rel='stylesheet' href='css/style.css' type='text/css'/>
  </head>
  <body  style='background:#f1f1f1;color:#444;'>
    <div id='wrapper1'>     
      <?php echo $msg; ?>

      <form name='form' id='form' method='post'>
        <p>
          <label>
            New Password<br>
            <input type='password' name='admin_password'>
          </label>
        </p>
        <p>
          <label>
            Confirm Password<br>
            <input type='password' name='admin_con_password'>
          </label>
        </p>
        <p class='submit'>
          <input type='submit' id='login' class='btn2' value='Change Password'>
        </p>
    </div>
    <input type='hidden' name='admin_email' value='<?php echo $admin_email;?>'>
  </form>
</body>
</html>


