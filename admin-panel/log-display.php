<?php
require './class/db-connection.php';
connection();
session_start();
?>
<!DOCTYPE html>
<head>
  <?php
  include './themepart/headerscripts.php';
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
              <li><a href="log-display.php">Activity Log</a> <span class="divider"></span></li>
              <li class="active">View Log</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          <!-- START Row -->
           <div class="row-fluid">
            <!-- START Datatable 1 -->
            <div class="span12 widget dark stacked">
              <header>
                <h4 class="title pull-left"><span class="icon icone-user"></span>Logs</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <button class="btn dropdown-toggle" data-toggle="dropdown">Maintainance</button>
                  
                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" email="usertable">
                    <thead>
                      <tr>  
                        <th>Log ID</th>
                       <th>Email</th>
                        <th >IP Address</th>
                        <th>Date/Time</th>
                         <th >Status</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
$query = "select * from admin_log_track order by log_date desc ";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
  $log_id=$row['log_id'];
  $log_email = $row['log_email'];
  $log_ip = $row['log_ip'];
  $log_status = $row['log_status'];
  $log_date = $row['log_date'];
  if ($log_status == 0) {
    $status = "<span class='label label-important'>Failed</span>";
    
  } else {
    $status = "<span class='label label-success'>Successfull</span>";
    
  }
  echo "<tr>"
  . "<td>{$log_id}"
  . "<td>{$log_email}"
  . "<td>{$log_ip}"
   . "<td>{$log_date}"
  . "<td>{$status}"
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