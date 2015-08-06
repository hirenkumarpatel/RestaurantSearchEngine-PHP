<?php
require './class/db-connection.php';
connection();
session_start();

$msg = '';

if ($_POST) {
  $state_name = mysql_real_escape_string($_POST['state_name']);

  $query = "insert into state(state_name)values('{$state_name}')";
  $result = mysql_query($query) or die(mysql_error());
  if ($result) {
    header("location:state-display.php?qry=true");
  } else {

    header("location:state-display.php?qry=false");
  }
}
?>

<!DOCTYPE html>


<head>
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
        <div class="navbar navbar-static-top">
          <div class="navbar-inner">
            <!-- Breadcrumb -->
            <ul class="breadcrumb">
              <li><a href="state-display.php">State</a> <span class="divider"></span></li>
              <li class="active">New State</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <!-- START Content -->
        <div class="container-fluid">
          <!-- START Row -->

          <!--/ END Page/Section header -->
        </div>
        <!--/ END Row -->

        <!-- START Row -->
        <?php echo $msg; ?>
        <div class="row-fluid">

          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post">
            <header><h4 class="title">State Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">State Name</label>
                  <div class="controls">
                    <input type="text" name="state_name" class="validate[required]">
                  </div>
                </div>

                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Insert</button>
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