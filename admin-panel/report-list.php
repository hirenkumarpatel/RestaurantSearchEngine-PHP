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
                            <li><a href="#">Reports</a> </li>

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
                                <h4 class="title pull-left"><span class="icon icone-file"></span>Reports</h4>
                                <!-- START Button Group -->

                                <!--/ END Button Group -->

                            </header>
                            <section class="body">
                                <div class="body-inner no-padding">
                                    <table class="table table-bordered table-striped table-hover " id="datatable1" name="statetable">
                                        <thead>
                                            <tr>  
                                                <th width="5%">No.</th>
                                                <th width="40%">Report Name</th>
                                                <th width="10%">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Restaurants List by Area</td>
                                                <td><a href='rpt-restaurant-area.php' target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                             
                                            <tr>
                                                <td>2</td>
                                                <td>Restaurants List by Cuisine</td>
                                                <td><a href='rpt-restaurant-cuisine.php' class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Restaurants List by Facility</td>
                                                <td><a href='rpt-restaurant-facility.php'target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Restaurants List by Feature</td>
                                                <td><a href='rpt-restaurant-feature.php' class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Restaurants List by Status</td>
                                                <td><a href='rpt-restaurant-status.php' class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Restaurants List by Cost</td>
                                                <td><a href='rpt-restaurant-cost.php'target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Restaurants List by Payment </td>
                                                <td><a href='rpt-restaurant-payment.php'target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Restaurants List by Photo Availability</td>
                                                <td><a href='rpt-restaurant-photoavail.php' target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>8</td>
                                                <td>Restaurants List by Menu Availability</td>
                                                <td><a href='rpt-restaurant-menuavail.php' target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
                                            <tr>
                                                <td>9</td>
                                                <td>Foodie List by Status and Address</td>
                                                <td><a href='rpt-foodie-city-status.php' target="_blank" class='btn1 btn1-blue'><span class='icone-zoom-in'></span>View</a></td>
                                            </tr>
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