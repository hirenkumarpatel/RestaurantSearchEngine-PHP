
<?php
require './class/db-connection.php';
session_start();
connection();

$msg = '';

if ($_POST) {
  
  $city_name = mysql_real_escape_string($_POST['city_name']);
  $state_id = mysql_real_escape_string($_POST['state_id']);
  $query = "insert into city(city_name,state_id)values('{$city_name}','{$state_id}')";
  $result = mysql_query($query) or die();
  if ($result) {
   

    header("location:city-display.php?qry=success");
  } else {

    header("location:city-display.php?qry=fail");
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
        <!-- START Content -->
        <div class="navbar navbar-static-top">
          <div class="navbar-inner">
            <!-- Breadcrumb -->
            <ul class="breadcrumb">
              <li><a href="city-display.php">City</a> <span class="divider"></span></li>
              <li class="active">New City</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
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
            <header><h4 class="title">City Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">City Name</label>
                  <div class="controls">
                    <input type="text" name="city_name" class="validate[required]">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">State Name</label>
                  <div class="controls">

                    <?php
                    $query = "select * from state";
                    $result = mysql_query($query) or die("Error in Selecting State :" . mysql_error());

                    echo '<select name="state_id">';
                    while ($row = mysql_fetch_array($result)) {
                     echo "<option  value='{$row['state_id']}' >{$row['state_name']}</option>";
                    }
                    echo '</select>';
                    ?>
                  </div>
                </div>
                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Insert</button>
                  <a class="btn" href="city-display.php" class="btn">Cancel</a>
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