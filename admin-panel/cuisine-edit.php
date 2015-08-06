
<?php
require './class/db-connection.php';
connection();
session_start();


$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  //header("location:cuisine-display.php");
}
$query = "select * from cuisine where cuisine_id='{$qry}' limit 0,1";
$result = mysql_query($query) or die("Error in Selecting Cuisine :" . mysql_error());
$row = mysql_fetch_array($result) or die("Error in Selecting Cuisine :" . mysql_error());
;
if ($row) {
  $cuisine_id = $row['cuisine_id'];
  $cuisine_name = $row['cuisine_name'];
  $cuisine_photo = $row['cuisine_photo'];
}


if ($_POST) {
  $cuisine_id = $_POST['cuisine_id'];
  $cuisine_name = mysql_real_escape_string($_POST['cuisine_name']);
  $cuisine_photo = $_FILES['cuisine_photo']["name"];
  if ($cuisine_photo == "") {
    $query = "update cuisine set cuisine_name='{$cuisine_name}' where cuisine_id='{$cuisine_id}'";
    $result = mysql_query($query) or die("Error in Editing Cuisine :" . mysql_error());
    if ($result) {
      header("location:cuisine-display.php?qry=true");
    }
  } else {
    $path = rand() . "-" . $_FILES["cuisine_photo"]["name"];

    $query = "update cuisine set cuisine_name='{$cuisine_name}',cuisine_photo='{$path}' where cuisine_id='{$cuisine_id}'";
    $result = mysql_query($query);
    if ($result) {
      move_uploaded_file($_FILES["cuisine_photo"]["tmp_name"], "rest/rest-cuisine/" . $path);
      header("location:cuisine-display.php?qry=true");
    } else {
      header("location:cuisine-display.php?qry=false");
    }
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
              <li><a href="cuisine-display.php">Cuisine</a> <span class="divider"></span></li>
              <li class="active">Edit Cuisine</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
        <?php echo $msg; ?>
          <div class="row-fluid">
            <!-- START Form Validation - Tooltip -->
            <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
              <header><h4 class="title">Cuisine Form</h4></header>
              <section class="body">
                <div class="body-inner">

                  <div class="control-group">
                    <label class="control-label">Cuisine ID</label>
                    <div class="controls">
                      <input type="text" name="cuisine_id" readonly="readonly" value="<?php echo $cuisine_id; ?>">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Cuisine Name</label>
                    <div class="controls">
                      <input type="text" name="cuisine_name" class="validate[required]" value="<?php echo $cuisine_name; ?>">
                    </div>
                  </div>


                  <div class="control-group">
                    <label class="control-label">Category Image</label>
                    <div class="controls">
                      <img src="<?php echo "rest/rest-cuisine/" . $cuisine_photo; ?>" style="width:220px;height:180px;"><br>
                      <input type="file" name="cuisine_photo" class="span8 ">
                    </div>
                  </div>
                  <input type="hidden" name="cuisine_id" value="<?php echo $qry; ?>">

                  <!-- Form Action -->
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Edit</button>
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