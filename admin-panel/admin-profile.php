<?php
session_start();
require './class/db-connection.php';
connection();
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
if (isset($_SESSION['admin'])) {
    $admin_id = $_SESSION['admin'];
    $query = "select * from admin where admin_id='{$admin_id}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {

        $admin_name = explode(" ", $row['admin_name']);
        $first_name = $admin_name[0];
        $last_name = $admin_name[1];
        $admin_password = $row['admin_password'];
        $admin_email = $row['admin_email'];
        $admin_photo = $row['admin_photo'];
    }
}
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
                            <li><a href="admin-profile.php">Account</a> <span class="divider"></span></li>
                            <li class="active">Edit Account</li>
                        </ul>
                        <!--/ Breadcrumb -->
                    </div>
                </div>
                <div class="container-fluid">

                    <?php echo $msg; ?>
                    <div class="row-fluid">
                        <!-- START Form Validation - Tooltip -->
                        <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post" enctype="multipart/form-data" action="admin-profile-edit.php">
                            <header><h4 class="title">Account</h4></header>
                            <section class="body">
                                <div class="body-inner">
                                    <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin']; ?>">
                                    <div class="control-group">
                                        <label class="control-label">First Name</label>
                                        <div class="controls">
                                            <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Last Name</label>
                                        <div class="controls">
                                            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Email Address</label>
                                        <div class="controls">
                                            <input type="text" name="admin_email" value="<?php echo $admin_email; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Profile Picture</label>
                                        <div class="controls">
                                            <div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img src="" style="height:50px;width:50px;"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                                <span class="btn btn-file"><span class="fileupload-new">Select Photo</span><span class="fileupload-exists">Change</span><input type="file" name="admin_photo"></span>
                                                <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>


                                        </div>
                                    </div>                                                                       
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Change</button>
                                        <a class="btn" href="dashboard.php" class="btn">Cancel</a>
                                    </div><!--/ Form Action -->
                                </div>
                            </section>
                        </form>
                        <!--/ END Form Validation - Tooltip -->
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