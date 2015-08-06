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
    $qry = mysql_real_escape_string($_GET['qry']);

    if ($qry == 'true') {
      $msg = "<div class='alert alert-success '>
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
              <li><a href="foodie-display.php">Foodie</a> <span class="divider"></span></li>
              <li class="active">View Foodie</li>
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
                <h4 class="title pull-left"><span class="icon icone-user"></span>Foodies</h4>
                <!-- START Button Group -->
                <!--<div class="btn-group pull-right">
                    <a class="btn" href="foodie-add.php">New Foodie</a>
                  
                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="usertable">
                    <thead>
                      <tr>  
                        <th>Foodie ID</th>
                        <th>Photo</th>
                        <th>User Name</th>
                        <th >Email</th>
                        <th >Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = "select * from foodie_detail";
                      $result = mysql_query($query);

                      while ($row = mysql_fetch_array($result)) {
                        $foodie_id = $row['foodie_id'];
                        $foodie_photo = $row['foodie_photo'];
                        $foodie_name = $row['foodie_name'];
                        $foodie_email = $row['foodie_email'];
                        $foodie_status = $row['foodie_status'];
                        if ($foodie_photo == "") {
                          $foodie_photo = "photo/not_avail.png";
                        }
                        else
                        {
                           $foodie_photo = "photo/foodie-photo/{$foodie_photo}"; 
                        }
                        if ($foodie_status == 0) {
                          $status = "<span class='label label-important'>Blocked</span>";
                                                  
                        } else {
                          $status = "<span class='label label-success'>Active</span>";
                                                  
                        }
                        echo "<tr>"
                        . "<td>{$foodie_id}"
                        . "<td><img src='{$foodie_photo}' class='avatar1'>"
                        . "<td>{$foodie_name}"
                        . "<td>{$foodie_email}"
                        . "<td><a href='foodie-change-status.php?qry={$foodie_id}'>{$status}</a>"
                        . "<td><a href='foodie-delete.php?qry={$foodie_id}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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


</html>