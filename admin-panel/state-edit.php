
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  //header("location:state-display.php");
}
$query = "select * from state where state_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting State :" . mysql_error());
$row = mysql_fetch_array($result) or die("Error in Selecting State :" . mysql_error());

if ($row) {
  $state_id = $row['state_id'];
  $state_name = $row['state_name'];
}


if ($_POST) {
  $state_id = mysql_real_escape_string($_POST['state_id']);
  $state_name = mysql_real_escape_string($_POST['state_name']);

  $query = "update state set state_name='{$state_name}' where state_id='{$state_id}'";
  $result = mysql_query($query);
  if ($result) {
    header("location:state-display.php?qry=true");
  }
 else {
     header("location:state-display.php?qry=false");
  }
}
?>

<!DOCTYPE html>


<head>
  <title>Edit</title>
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
              <li><a href="state-display.php">State</a> <span class="divider"></span></li>
              <li class="active">Edit State</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
         
<?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
            <header><h4 class="title">State Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">State ID</label>
                  <div class="controls">
                    <input type="text" name="state_id" readonly="readonly" value="<?php echo $state_id; ?>">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">State Name</label>
                  <div class="controls">
                    <input type="text" name="state_name" class="validate[required]" value="<?php echo $state_name; ?>">
                  </div>
                </div>


                <input type="hidden" name="state_id" value="<?php echo $qry; ?>">

                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Edit</button>
                  <a class="btn" href="state-display.php" class="btn">Cancel</a>
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