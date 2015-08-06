<?php
require './class/db-connection.php';
connection();
ob_start();
session_start();
$msg = "";
$qry;
if (!isset($_SESSION['admin']) and isset($_COOKIE['admin'])) {
  $_SESSION['admin'] = $_COOKIE['admin'];
  echo "<html><body><script>alert('session created :{$_SESSION['admin']}');</script></body></html>";
}
if (isset($_SESSION['admin'])) {
  header("location:dashboard.php");
}


if (isset($_GET['qry'])) {
  $qry = $_GET['qry'];
  if ($qry == "pw-reset") {
    $msg = "<div class='msg msg-success'>
                <p>Your password has been reset.</p>
             </div>";
  }
}

if ($_POST) {
  $admin_email = $_POST['admin_email'];
  $admin_password = $_POST['admin_password'];

  $log_ip = $_SERVER['REMOTE_ADDR'];


  if (empty($admin_email) or empty($admin_password)) {
    $msg = "<div class='msg msg-error'><p><strong>Error</strong>:Field Values can not empty!</p></div>";
  } else {

    //admin login 
    $query = "select * from admin where admin_email='{$admin_email}'";
    $result = mysql_query($query) or $msg = "<div class='msg msg-error'><p><strong>Error</strong>:" . mysql_error() . "</p></div>";
    $row = mysql_fetch_array($result);
    if ($row) {
      if ($row['admin_password'] == md5($admin_password)) {

        $_SESSION['admin'] = $row['admin_id'];
        if (isset($_POST['remember_me'])) {
          setcookie("admin", $row['admin_id'], time() + 60 * 60 * 1);
        }
      } else {
        $msg = "<div class='msg msg-error'><p><strong>Error</strong>:Wrong Password!</p></div>";
      }
    } else {
      $msg = "<div class='msg msg-error'><p><strong>Error</strong>:User not found!</p></div>";
    }
    if (isset($_SESSION['admin'])) {
      //log  track detail
      $query = "insert into admin_log_track(log_email,log_ip,log_status)values('$admin_email','$log_ip','1')";
      $result = mysql_query($query) or die(mysql_error());
      header("location:dashboard.php");
    } else {
      $query = "insert into admin_log_track(log_email,log_ip,log_status)values('$admin_email','$log_ip','0')";
      $result = mysql_query($query) or die(mysql_error());
    }
  }
}
?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="css/style.css" type="text/css"/>

</head>
<body  style='background:#f1f1f1;color:#444;'>
  <div id='wrapper1'>     
<?php echo $msg; ?>

    <form name='form' id='form' method='post'>
      <p>
        <label>
          Enter Email Address<br>
          <input type='text' name='admin_email'>
        </label>
      </p>
      <p>
        <label>
          Enter Password<br>
          <input type='password' name='admin_password'>
        </label>
      </p>
      <p class="forgetmenot">
        <label for="rememberme" title="Select this option to stay signed in on this device.">
          <input name="remember_me" type="checkbox" checked="checked"> Stay signed in</label>
      </p>
      <p class="submit">
        <input type="submit" id="login" class=" btn2" value="Log In">
      </p>
    </form>

    <p id="nav">
      <a href="admin-forget-password.php"  style="color:#127ce9;"title="Password Lost and Found">Lost your password?</a>
    </p>
  </div>
  <script src="assets/jquery/js/jquery-1.10.1.min.js"></script>

  <script src="js/jshake.js"></script>
  <script>
    $(document).ready(function()
    {
      //$('#login').click(function()
      {
        $('#form').jshake();
      }//)
    });
  </script>
</body>
</html>