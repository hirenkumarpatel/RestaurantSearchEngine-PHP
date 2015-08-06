<?php
require './class/db-connection.php';
connection();
session_start();

$msg = '';

if ($_POST) {
  
  $locality_name = mysql_real_escape_string($_POST['locality_name']);
  $city_id = mysql_real_escape_string($_POST['city_id']);
  $query = "insert into locality(locality_name,city_id)values('{$locality_name}','{$city_id}')";
  $result = mysql_query($query);
  if ($result) {
   

    header("location:locality-display.php?qry=true");
  } else {

    header("location:locality-display.php?qry=false");
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
              <li><a href="locality-display.php">Locality</a> <span class="divider"></span></li>
              <li class="active">New Locality</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          
        <?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post">
            <header><h4 class="title">Locality Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">Locality Name</label>
                  <div class="controls">
                    <input type="text" name="locality_name" class="validate[required]">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">City Name</label>
                  <div class="controls">

                    <?php
                    $query = "select * from city";
                    $result = mysql_query($query) or die("Error in Selecting City :" . mysql_error());

                    echo '<select name="city_id">';
                    while ($row = mysql_fetch_array($result)) {
                     echo "<option  value='{$row['city_id']}' >{$row['city_name']}</option>";
                    }
                    echo '</select>';
                    ?>
                  </div>
                </div>
                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Insert</button>
                  <a class="btn" href="locality-display.php" class="btn">Cancel</a>
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