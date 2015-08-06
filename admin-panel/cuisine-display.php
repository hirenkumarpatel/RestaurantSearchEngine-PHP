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
      $msg = "<div class='  alert alert-success ' >
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
              <li><a href="cuisine-display.php">Cuisine</a> <span class="divider"></span></li>
              <li class="active">View Cuisine</li>
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
                <h4 class="title pull-left"><span class="icon icon-food"> </span>  Cuisine</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <a class="btn" href="cuisine-add.php">Add Cuisine</a>

                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="cuisinetable">
                    <thead>
                      <tr>  
                        <th width="10%">Cuisine ID</th>
                        <th width="15%">Image</th>
                        <th width="40%">Cuisine Name</th>
                        <th width="15%">Status</th>
                        <th width="25%">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */


                      $query = "select * from cuisine";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                        $cuisine_photo = "rest/rest-cuisine/" . $row['cuisine_photo'];
                        $cuisine_status = $row['cuisine_status'];
                        if ($cuisine_photo == "" or $cuisine_photo == "rest/rest-cuisine/") {
                          $cuisine_photo = "rest/rest-cuisine/dish.png";
                        }
                        if ($cuisine_status == 0) {
                          $status = "<span class='label label-important'>Disable</span>";
                        } else {
                          $status = "<span class='label label-success'>Enable</span>";
                          $tooltip = 'Deactivate';
                        }
                        echo "<tr>"
                        . "<td>{$row['cuisine_id']}"
                        . "<td><img src='{$cuisine_photo}' style='height:60px;width:80px;'>"
                        . "<td>{$row['cuisine_name']}"
                        . "<td><a href='cuisine-change-status.php?qry={$row['cuisine_id']}'>{$status}</a>&nbsp"
                        . "<td><a href='cuisine-edit.php?qry={$row['cuisine_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
                        . "<a href='cuisine-delete.php?qry={$row['cuisine_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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