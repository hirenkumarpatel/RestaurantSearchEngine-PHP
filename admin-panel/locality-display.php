<?php
require './class/db-connection.php';
connection();
session_start();


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
                                       <strong>Error:</strong> Your Operation has been Failed " . mysql_error() . "
                                    </div>";
  }
}
?>
<!DOCTYPE html>
<head>


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
              <li><a href="locality-display.php">Locality</a> <span class="divider"></span></li>
              <li class="active">View Locality</li>
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
                <h4 class="title pull-left"><span class="icon icone-user"></span>Locality</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                  <a class="btn" href="locality-add.php">Add Locality</a>

                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="Localitytable">
                    <thead>
                      <tr>  
                        <th width="10%">Locality ID</th>
                        <th width="25%">Locality Name</th>
                        <th width="20%">City Name</th>
                        <th width="25%">State Name</th>
                        <th width="15%">Action</th>

                      </tr>
                    </thead>
                    <tbody>
<?php
/*   data base connectivity */


$query = "select * from locality,city,state where locality.city_id=city.city_id and city.state_id=state.state_id";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  $locality_id = $row['locality_id'];
  $locality_name = $row['locality_name'];
  $city_name = $row['city_name'];
  $state_name = $row['state_name'];


  echo "<tr>"
  . "<td>{$locality_id}"
  . "<td>{$locality_name}"
  . "<td>{$city_name}"
  . "<td>{$state_name}"
  . "<td><a href='locality-edit.php?qry={$row['locality_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
  . "<a href='locality-delete.php?qry={$row['locality_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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

