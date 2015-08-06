<?php
require './class/db-connection.php';
session_start();
connection();

$msg = '';
if ($_POST) {
  $rest_id = $_POST['rest_id'];
  $rest_menu = $_FILES["rest_menu"]["name"];
  if (empty($rest_menu)) {
    $path = "";
  } else {
    $path = rand() . "-" . $_FILES["rest_menu"]["name"];
  }

  $rest_menu = $path;

  $query = "insert into restaurant_menu(rest_menu,rest_id)values('{$rest_menu}','{$rest_id}')";
  $result = mysql_query($query) or die(mysql_error());
  if ($result) {

    move_uploaded_file($_FILES["rest_menu"]["tmp_name"], "rest/rest-menu/" . $path);
    header("location:restaurant-menu-display.php?qry=true");
  } else {
    header("location:restaurant-menu-display.php?qry=false");
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
              <li><a href="restaurant-menu-display.php">Restaurant</a> <span class="divider"></span></li>
              <li class="active">New Menu</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
         
        <?php echo $msg; ?>
        <div class="row-fluid">
          <!-- START Form Validation - Tooltip -->
          <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data">
            <header><h4 class="title">Restaurant Form</h4></header>
            <section class="body">
              <div class="body-inner">
                <div class="control-group">
                  <label class="control-label">Restaurant Name</label>
                  <div class="controls">
                    <?php
                    $query = "select rest_id,rest_name from restaurant_detail";
                    $result = mysql_query($query);

                    echo '<select name="rest_id">';
                    while ($row = mysql_fetch_array($result)) {
                      $select = $row['rest_id'] == $rest_id ? "selected" : "";

                      echo "<option $select value='{$row['rest_id']}' >{$row['rest_name']}</option>";
                    }
                    echo '</select>';
                    ?>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Restaurant Menu</label>
                  <div class="controls">
                    <input type="file" name="rest_menu" class="span8 ">
                  </div>
                </div>                                                                       
                <!-- Form Action -->
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Insert</button>
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