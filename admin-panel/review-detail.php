<?php
require './class/db-connection.php';
connection();
session_start();
?>
<html>
    <head>
        <?php
        include './themepart/headerscripts.php';
        $qry;
        $msg = "";
        $qry = mysql_real_escape_string($_GET['qry']);
        if (!isset($_GET['qry']) || empty($_GET['qry'])) {
            header("location:review-display.php");
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
                                <li><a href="review-display.php">Review</a> <span class="divider"></span></li>
                                <li class="active">Review Detail</li>
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
                                    <h4 class="title pull-left"><span class="icon icone-user"></span>Review Detail</h4>
                                    <!-- START Button Group -->
                                    <div class="btn-group pull-right">
                                        <a class="btn1 btn1-blue" href="review-display.php"><span class="icone-undo"></span> Back</a>

                                    </div>
                                    <!--/ END Button Group -->

                                </header>
                                <section class="body">

                                    <div class="body-inner no-padding">
                                        <table class="table table-bordered table-striped table-hover ">

                                            <tbody>
                                            <?php
                                            $query = "select * from review rw,foodie_detail fd, restaurant_detail rd where rw.review_id='{$qry}' and rw.rest_id=rd.rest_id and rw.foodie_id=fd.foodie_id";
                                            $result = mysql_query($query) or die("Error in Selecting query :" . mysql_error());
                                            $row = mysql_fetch_array($result);
                                            if ($row) {
                                                echo "<tr><td colspan='2' ><span style='float:right;margin-right:25px;'><b>{$row['foodie_name']}</b> has Reviewed on <b>{$row['rest_name']}</b></span></td></tr>";
                                                echo "<tr><td><span style='height:100%' content=' '><img src='img/tools/blog-icon.png' style='height:16px;width:16px;padding-right:5px;padding-bottom:10px;'></span>{$row['review_text']}</tr>";
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


