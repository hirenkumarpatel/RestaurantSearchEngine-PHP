<?php
require './class/db-connection.php';
connection();
session_start();
?>
<!DOCTYPE html>
<head>
  <?php
include './themepart/headerscripts.php';
  $qry;
  $msg = "";
  if ($_GET) {
    $qry = $_GET['qry'];
    if ($qry == 'true') {
      $msg = "<div class=' alert alert-success '>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                         Your Operation has been Completed Successfully..
                                    </div>";
    } else if ($qry == 'false') {
      $msg = "<div class='alert alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                       <strong>Error!</strong> Your Operation has been Failed " . mysql_error() . "
                                    </div>";
    }
  }
  ?>

</head>
<body>
  <!-- START Template Wrapper -->
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
              <li class="active">View Photo</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          <!-- START Row -->
          <?php echo $msg; ?>
          <div class="row-fluid">
            <!-- START Datatable 1 -->

            <div class="span12 widget dark stacked">
              <header>
                <h4 class="title pull-left"><span class="icon icone-user"></span>Restaurant-Photos</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <a class="btn" href="restaurant-photo-add.php">Add Photo</a>

                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="cuisinetable">
                    <thead>
                      <tr>  
                        <th width="15%">Photo ID</th>
                        <th width="25%">Photo</th>
                        <th width="25%">Restaurant Name</th>
                        <th width="30%">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */


                      $query = "select * from restaurant_photo,restaurant_detail where restaurant_photo.rest_id=restaurant_detail.rest_id";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                        $restaurant_photo = "rest/rest-photo/" . $row['rest_photo'];

                        if ($restaurant_photo == "" or $restaurant_photo == "rest/rest-photo/") {
                          $restaurant_photo = "rest/rest-photo/no_photo.png";
                        }

                        echo "<tr>"
                        . "<td>{$row['rest_photo_id']}"
                        . "<td><img src='{$restaurant_photo }' style='height:60px;width:80px;'>"
                        . "<td>{$row['rest_name']}"
                        . "<td> <a href='restaurant-photo-edit.php?qry={$row['rest_photo_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
                        . "<a href='restaurant-photo-delete.php?qry={$row['rest_photo_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
                        . "</tr>";
                      }
                      ?>
                    </tbody>

                  </table>
                </div>
              </section>
            </div>
            <!--/ END Datatable 1 -->
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



</body>


</html>