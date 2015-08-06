
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:locality-display.php");
}
$query = "select * from locality where locality_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting Locality :" . mysql_error());
$row = mysql_fetch_array($result);

if ($row) {
  $locality_id = $row['locality_id'];
  $locality_name = $row['locality_name'];
  $city_id=$row['city_id'];
}


if ($_POST) {
  $locality_id = mysql_real_escape_string($_POST['locality_id']);
  $locality_name = mysql_real_escape_string($_POST['locality_name']);
  $city_id=$_POST['city1'];
  echo "<script>alert('city id :.{$city_id}');</script>";


  $query = "update locality set locality_name='{$locality_name}',city_id='{$city_id}' where locality_id='{$locality_id}'";
  $result = mysql_query($query);
  if ($result) {
    header("location:locality-display.php?qry=true");
  }
 else {
     header("location:locality-display.php?qry=false");
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
              <li><a href="locality-display.php">Locality</a> <span class="divider"></span></li>
              <li class="active">Edit Locality</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
         
        <?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
            <header><h4 class="title">Locality Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">Locality ID</label>
                  <div class="controls">
                    <input type="text" name="locality_id" readonly="readonly" value="<?php echo $locality_id; ?>">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Locality Name</label>
                  <div class="controls">
                    <input type="text" name="locality_name" class="validate[required]" value="<?php echo $locality_name; ?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">City Name</label>
                  <div class="controls">

                      <?php
                      $query = "select * from city";
                        $result = mysql_query($query) or die("Error in Selecting State :" . mysql_error());

                        echo '<select name="city1">';
                       while ($row = mysql_fetch_array($result))
                        {
                         $select = $row['city_id'] == $city_id ? "selected" : "";
 
                         echo "<option $select value='{$row['city_id']}' >{$row['city_name']}</option>";

                        }
                        echo '
                    </select>';
                      ?>
                  </div>
                </div>



                <input type="hidden" name="city_id" value="<?php echo $city_id; ?>">

                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Edit</button>
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