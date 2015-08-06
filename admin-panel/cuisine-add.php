
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

if ($_POST) {
  $cuisine_name = mysql_real_escape_string($_POST['cuisine_name']);
  if ($_FILES["cuisine_photo"]["name"] == "") {
    $path = "";
  } else {
    $path = rand() . "-" . $_FILES["cuisine_photo"]["name"];
  }
  $cuisine_photo = $path;

  $query = "insert into cuisine(cuisine_name,cuisine_photo)values('{$cuisine_name}','{$cuisine_photo}')";
  $result = mysql_query($query) or die(mysql_error());
  if ($result) {

    move_uploaded_file($_FILES["cuisine_photo"]["tmp_name"], "rest/rest-cuisine/" . $path);
    header("location:cuisine-display.php?qry=true");
  } else {
    header("location:cuisine-display.php?qry=false");
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
              <li><a href="cuisine-display.php">Cuisine</a> <span class="divider"></span></li>
              <li class="active">New Cuisine</li>
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
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data">
            <header><h4 class="title">Cuisine Form</h4></header>
            <section class="body">
              <div class="body-inner">

                <div class="control-group">
                  <label class="control-label">Cuisine Name</label>
                  <div class="controls">
                    <input type="text" name="cuisine_name" class="validate[required]">
                  </div>
                </div>


                <div class="control-group">
                  <label class="control-label">Category Image</label>
                  <div class="controls">
                    <input type="file" name="cuisine_photo" class="span8 ">
                  </div>
                </div>


                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Insert</button>
                  <a class="btn" href="cuisine-display.php" class="btn">Cancel</a>
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