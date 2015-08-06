<?php
session_start();
require './class/db-connection.php';
connection();
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
      $msg = "<div class='alert alert-success'>
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
              <li><a href="city-display.php">City</a> <span class="divider"></span></li>
              <li class="active">View City</li>
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
                <h4 class="title pull-left"></span>City</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <a class="btn" href="city-add.php">New City</a>

                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="citytable">
                    <thead>
                      <tr>  
                        <th width="15%">City ID</th>
                        <th width="30%">City Name</th>
                        <th width="30%">State Name</th>
                        <th width="25%">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */

                      $query = "select * from city,state where city.state_id=state.state_id";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                        $city_id = $row['city_id'];

                        $city_name = $row['city_name'];
                        $state_name = $row['state_name'];


                        echo "<tr>"
                        . "<td>{$city_id}"
                        . "<td>{$city_name}"
                        . "<td>{$state_name}"
                        . "<td><a href='city-edit.php?qry={$row['city_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
                        . "<a href='city-delete.php?qry={$row['city_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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