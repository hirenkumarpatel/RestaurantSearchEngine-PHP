
<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:restaurant-photo-display.php");
}

$query = "select rp.*,rd.rest_id,rd.rest_name from restaurant_photo rp,restaurant_detail rd where rp.rest_id=rd.rest_id and rp.rest_photo_id='{$qry}'limit 0,1";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);

if ($row) {
    $rest_photo_id = $row['rest_photo_id'];
    $rest_photo = "rest/rest-photo/" .$row['rest_photo'];
    $rest_id = $row['rest_id'];
    $rest_name=$row['rest_name'];
}
 
  if ($_POST) {
    $rest_photo_id = $_POST['rest_photo_id'];
    $rest_id = mysql_real_escape_string($_POST['rest_id']);
    $rest_photo = $_FILES['rest_photo']["name"];
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    if ($rest_photo == "") {
     
        header("location:restaurant-photo-display.php?qry=true");
      
    } else {
      $path = rand() . "-" . $_FILES["rest_photo"]["name"];

      $query = "update restaurant_photo set rest_photo='{$path}' where rest_photo_id='{$rest_photo_id}'";
      $result = mysql_query($query);
      if ($result) {
        move_uploaded_file($_FILES["rest_photo"]["tmp_name"], "rest/rest-photo/" . $path);
        header("location:restaurant-photo-display.php?qry=true");
      } else {
        header("location:restaurant-photo-display.php?qry=false");
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
              <li><a href="restaurant-photo-display.php">Restaurant</a> <span class="divider"></span></li>
              <li class="active">Edit Photo</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
          <div class="container-fluid">
            
          <!-- START Row -->
        <?php echo $msg; ?>
          <div class="row-fluid">
            <!-- START Form Validation - Tooltip -->
            <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
              <header><h4 class="title">Cuisine Form</h4></header>
              <section class="body">
                <div class="body-inner">

                  <div class="control-group">
                    <label class="control-label">Photo ID</label>
                    <div class="controls">
                      <input type="text" name="rest_photo_id" readonly="readonly" value="<?php echo $rest_photo_id; ?>">
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label">Restaurant Name</label>
                    <div class="controls">
                      <input type="text" name="rest_name" class="validate[required]" readonly="readonly" value="<?php echo $rest_name; ?>">
                      <input type="hidden" name="rest_id" class="validate[required]" value="<?php echo $rest_id; ?>">
                    </div>
                  </div>


                  <div class="control-group">
                    <label class="control-label">Restaurant Photo</label>
                    <div class="controls">
                      <img src="<?php echo $rest_photo; ?>" style="width:220px;height:180px;"><br>
                      <input type="file" name="rest_photo" class="span8 ">
                    </div>
                  </div>
                 

                  <!-- Form Action -->
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a class="btn" href="restaurant-photo-display.php" class="btn">Cancel</a>
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