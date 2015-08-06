<?php
require './class/db-connection.php';
connection();
session_start();
?>
<!DOCTYPE html>
<head>
  <?php
    include './themepart/headerscripts.php';  
    
    $qry;$msg="";
    if($_GET)
    {
        $qry=$_GET['qry'];
        if($qry=='true')
        {
             $msg = "<div class=' gritter-data alert alert-success ' data-time='5000'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                         Your Operation has been Completed Successfully..
                                    </div>";
        }
        else if($qry=='false')
        {
            $msg ="<div class='alert alert-error'>
                                        <button type='button' class='close' data-dismiss='alert'>×</button>
                                       <strong>Error!</strong> Your Operation has been Failed " .  mysql_error()."
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
              <li><a href="restaurant-menu-display.php">Restaurant</a> <span class="divider"></span></li>
              <li class="active">View Menu</li>
            </ul>
            <!--/ Breadcrumb -->
          </div>
        </div>
        <div class="container-fluid">
          <!-- START Row -->
           <?php echo $msg;?>
          <div class="row-fluid">
            <!-- START Datatable 1 -->
           
            <div class="span12 widget dark stacked">
              <header>
                <h4 class="title pull-left"><span class="icon icone-user"></span>Restaurant-Menus</h4>
                <!-- START Button Group -->
                <div class="btn-group pull-right">
                    <a class="btn" href="restaurant-menu-add.php">Add Menu</a>
                  
                </div>
                <!--/ END Button Group -->

              </header>
              <section class="body">
                <div class="body-inner no-padding">
                  <table class="table table-bordered table-striped table-hover " id="datatable1" name="cuisinetable">
                    <thead>
                      <tr>  
                        <th width="15%">Menu ID</th>
                        <th width="25%">Menu</th>
                        <th width="25%">Restaurant Name</th>
                        <th width="30%">Action</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      /*   data base connectivity */
                      
                      
                      $query = "select * from restaurant_menu,restaurant_detail where restaurant_menu.rest_id=restaurant_detail.rest_id";
                      $result = mysql_query($query) or die(mysql_error());
                      while ($row = mysql_fetch_array($result)) {
                      $restaurant_menu = "rest/rest-menu/".$row['rest_menu'];
                      
                      if ($restaurant_menu  == "" or $restaurant_menu  =="rest/rest-menu/") {
                      $restaurant_menu  = "rest/rest-menu/no_menu.png";
                      }
                      
                      echo "<tr>"
                      . "<td>{$row['menu_id']}"
                        . "<td><img src='{$restaurant_menu }' style='height:60px;width:80px;'>"
                          . "<td>{$row['rest_name']}"
                           . "<td><a href='restaurant-menu-edit.php?qry={$row['menu_id']}' class='btn1 btn1-violate'><span class='icone-edit'></span> Edit</a>&nbsp"
                          . "<a href='restaurant-menu-delete.php?qry={$row['menu_id']}' class='btn1 btn1-red'><span class='icone-trash'></span> Delete</a>"
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