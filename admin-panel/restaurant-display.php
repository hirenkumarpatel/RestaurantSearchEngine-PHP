<?php
require'./class/db-connection.php';
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
                <li><a href="restaurant-display.php">Restaurant</a> <span class="divider"></span></li>
                <li class="active">View Restaurant</li>
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
                <h4 class="title pull-left"><span class="icon icone-user"></span>Restaurant</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <a class="btn " style="padding:6px 14px;" href="restaurant-add.php"><span class="icone-plus"></span> New Restaurant</a>

                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="Restauranttable">
                    <thead>
                      <tr>  
                        <th width="5%">ID</th>
                        <th width="20%">Restaurant Name</th>
                        <th width="15%">Owner Name</th>
                        <th width="15%">Register Date</th>
                        <th width="10%">Status</th>

                        <th>Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */


                      $query = "select * from restaurant_detail r,locality l,city c,state s where  r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                        $rest_id = $row['rest_id'];
                        $rest_name = $row['rest_name'];
                        $rest_owner = $row['rest_owner'];
                        $rest_reg_date = $row['rest_reg_date'];
                        $rest_status = $row['rest_status'];
                        $status_img = "";
                        $status_title = "";
                        if ($rest_status == 1) {

                          $status = "<span class='label label-success'>Active</span>";
                        } else {

                          $status = "<span class='label label-important'>Blocked</span>";
                        }


                        echo "<tr>"
                        . "<td>{$rest_id}"
                        . "<td>{$rest_name}"
                        . "<td>{$rest_owner}"
                        . "<td>{$rest_reg_date}"
                        . "<td><a href='restaurant-change-status.php?qry={$row['rest_id']}'>{$status}</a>"
                        . "<td><a href='restaurant-detail.php?qry={$row['rest_id']}'  class='btn1 btn1-green'><span class='icone-zoom-in'></span> View</a>&nbsp;"
                        . "<a href='restaurant-mail.php?qry={$row['rest_id']}'class='btn1 btn1-blue'><span class='icone-envelope-alt'></span> Mail</a>&nbsp;"
                        . "<a href='restaurant-edit.php?qry={$row['rest_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
                        . "<a href='restaurant-delete.php?qry={$row['rest_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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

