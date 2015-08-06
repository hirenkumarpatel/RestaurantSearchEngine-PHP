
<?php
require './class/db-connection.php';
connection();
session_start();
include './class/send-mail.php';
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:restaurant-display.php");
}
$query = "select * from restaurant_detail where rest_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting Restaurant :" . mysql_error());
$row = mysql_fetch_array($result);

if ($row) {
  $rest_id = $row['rest_id'];
  $rest_name = $row['rest_name'];
  $rest_email=$row['rest_email'];
}


if ($_POST) {
  $rest_name = mysql_real_escape_string($_POST['rest_name']);
  $subject = mysql_real_escape_string($_POST['subject']);
  $message = mysql_real_escape_string($_POST['message']);
  
  $mail_sent = sendMail("RestaurantSearchEngine","hirenpatel.project@gmail.com", "hiren patel185", $rest_email, $subject, $message);
  $result = mysql_query($query);
  if ($result) {
    header("location:restaurant-display.php?qry=true");
  }
 else {
     header("location:restaurant-display.php?qry=false");
  }
}
?>

<!DOCTYPE html>


<head>
  <title>Send Mail</title>
<?Php
include './themepart/headerscripts.php';
?>
</head>
<body>
  <div id="wrapper" class="fixed-header fixed-sidebar">
    <!-- START Template Canvas -->
    <div id="canvas">
  <?php
  include './themepart/header.php';
  include './themepart/sidebar.php';
  ?>
      <!-- START Template Main Content -->
      <section id="main">
        <!-- START Content -->
        <div class="navbar navbar-static-top">
            <div class="navbar-inner">
              <!-- Breadcrumb -->
              <ul class="breadcrumb">
                <li><a href="restaurant-display.php">Restaurant</a> <span class="divider"></span></li>
                <li class="active">Send Mail</li>
              </ul>
              <!--/ Breadcrumb -->
            </div>
          </div>
        <div class="container-fluid">
        
        <?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
            <header><h4 class="title">Restaurant Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">Restaurant Name</label>
                  <div class="controls">
                    <input type="text" name="rest_name" readonly="readonly" value="<?php echo $rest_name; ?>">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Subject</label>
                  <div class="controls">
                    <input type="text" name="subject" class="validate[required]">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Message</label>
                <div class="controls">
                  <textarea name="message"class="validate[required]" ></textarea>
                </div>
                </div>
               <input type="hidden" name="rest_email" value="<?php echo $rest_email; ?>">

                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Send Mail</button>
                  <a class="btn" href="restaurant-display.php" class="btn">Cancel</a>
                </div><!--/ Form Action -->
              </div>
            </section>
          </form>
          <!--/ END Form Validation - Tooltip -->
        </div>
        <!--/ END Row -->
    </div>
    <!--/ END Content -->

  </section>
  <!--/ END Template Main Content -->
<?php
include './themepart/footer.php';
?>
</div>
<!--/ END Template Canvas -->
</div>
<!--/ END Template Wrapper -->
  <?php
  include './themepart/footerscripts.php';
  ?>
</body>
</html>