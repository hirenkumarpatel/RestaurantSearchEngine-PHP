<?php
require './class/db-connection.php';
connection();
session_start();
$msg = '';

$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:restaurant-menu-display.php");
}

$query = "select rm.*,rd.rest_id,rd.rest_name from restaurant_menu rm,restaurant_detail rd where rm.rest_id=rd.rest_id and rm.menu_id='{$qry}'limit 0,1";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);

if ($row) {
    $menu_id = $row['menu_id'];
    $rest_menu = "rest/rest-menu/" .$row['rest_menu'];
    $rest_id = $row['rest_id'];
    $rest_name=$row['rest_name'];
}
 
  if ($_POST) {
    $menu_id = $_POST['menu_id'];
    $rest_id = mysql_real_escape_string($_POST['rest_id']);
    $rest_menu = $_FILES['rest_menu']["name"];
   
    if ($rest_menu == "") {
     
        header("location:restaurant-menu-display.php?qry=true");
      
    } else {
      $path = rand() . "-" . $_FILES["rest_menu"]["name"];

      $query = "update restaurant_menu set rest_menu='{$path}' where menu_id='{$menu_id}'";
      $result = mysql_query($query);
      if ($result) {
        move_uploaded_file($_FILES["rest_menu"]["tmp_name"], "rest/rest-menu/" . $path);
        header("location:restaurant-menu-display.php?qry=true");
      } else {
        header("location:restaurant-menu-display.php?qry=false");
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
              <li><a href="restaurant-menu-display.php">Restaurant</a> <span class="divider"></span></li>
              <li class="active">Edit Menu</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
          <div class="container-fluid">
          
        <?php echo $msg; ?>
          <div class="row-fluid">
            <!-- START Form Validation - Tooltip -->
            <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" >
              <header><h4 class="title">Menu Form</h4></header>
              <section class="body">
                <div class="body-inner">

                  <div class="control-group">
                    <label class="control-label">Photo ID</label>
                    <div class="controls">
                      <input type="text" name="menu_id" readonly="readonly" value="<?php echo $menu_id; ?>">
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
                    <label class="control-label">Restaurant Menu</label>
                    <div class="controls">
                      <img src="<?php echo $rest_menu; ?>" style="width:220px;height:180px;"><br>
                      <input type="file" name="rest_menu" class="span8 ">
                    </div>
                  </div>
                 

                  <!-- Form Action -->
                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <a class="btn" href="restaurant-menu-display.php" class="btn">Cancel</a>
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