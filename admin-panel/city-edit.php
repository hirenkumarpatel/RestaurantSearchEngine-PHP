
<?php
require './class/db-connection.php';
connection();
session_start();

$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:city-display.php");
}
$query = "select * from city where city_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting City :" . mysql_error());
$row = mysql_fetch_array($result) or die("Error in Selecting City :" . mysql_error());

if ($row) {
  $city_id = $row['city_id'];
  $city_name = $row['city_name'];
  $state_id = $row['state_id'];
}


if ($_POST) {
  $city_id = mysql_real_escape_string($_POST['city_id']);
  $city_name = mysql_real_escape_string($_POST['city_name']);
  $state_id = $_POST['state1'];
  echo "<script>alert('state id :.{$state_id}');</script>";


  $query = "update city set city_name='{$city_name}',state_id='{$state_id}' where city_id='{$city_id}'";
  $result = mysql_query($query);
  if ($result) {
    header("location:city-display.php?qry=success");
  } else {
    header("location:city-display.php?qry=fail");
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
              <li><a href="city-display.php">City</a> <span class="divider"></span></li>
              <li class="active">Edit City</li>
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
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
            <header><h4 class="title">City Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">City ID</label>
                  <div class="controls">
                    <input type="text" name="city_id" readonly="readonly" value="<?php echo $city_id; ?>">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">City Name</label>
                  <div class="controls">
                    <input type="text" name="city_name" class="validate[required]" value="<?php echo $city_name; ?>">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">State Name</label>
                  <div class="controls">

                    <?php
                    $query = "select * from state";
                    $result = mysql_query($query) or die("Error in Selecting State :" . mysql_error());

                    echo '<select name="state1">';
                    while ($row = mysql_fetch_array($result)) {
                      $select = $row['state_id'] == $state_id ? "selected" : "";

                      echo "<option $select value='{$row['state_id']}' >{$row['state_name']}</option>";
                    }
                    echo '
                    </select>';
                    ?>
                  </div>
                </div>



                <input type="hidden" name="state_id" value="<?php echo $state_id; ?>">

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