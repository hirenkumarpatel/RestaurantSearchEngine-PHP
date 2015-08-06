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
if ($_POST) {

    $admin_id = $_POST['admin_id'];
    $admin_password = md5($_POST['admin_password']);
    $admin_new_password = md5($_POST['admin_new_password']);
    $admin_con_password = md5($_POST['admin_con_password']);
    echo "pass:{$admin_password}";

    $query = "select admin_password from admin where admin_id='{$admin_id}' and admin_password='{$admin_password}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    echo"admin_db _pas:{$row['admin_password']}";
    if ($row) {
        if ($admin_new_password == $admin_con_password and $admin_password != "") {

            $query = "update admin set admin_password='{$admin_new_password}' where admin_id='{$admin_id}'";
            $result = mysql_query($query) or die(mysql_error());
            if ($result) {
                header("location:admin-change-password.php?qry=true");
            } else {
                header("location:admin-change-password.php?qry=false");
            }
        }
    } else {
        header("location:admin-change-password.php?qry=false");
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
                            <li><a href="">Account</a> <span class="divider"></span></li>
                            <li class="active">Edit Password</li>
                        </ul>
                        <!--/ Breadcrumb -->
                    </div>
                </div>
                <?php echo $msg; ?>
               
                <!-- START Row -->

                <div class="row-fluid">
                    <!-- START Form Validation - Tooltip -->
                    <form class="span12 widget shadowed dark form-horizontal bordered" id="form_validate_tooltip" method="post">
                        <header><h4 class="title">Change Password</h4></header>
                        <section class="body">
                            <div class="body-inner">

                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="password" name="admin_password" class="validate[required]">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">New Password</label>
                                    <div class="controls">
                                        <input type="password" name="admin_new_password" class="validate[required]">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm Password</label>
                                    <div class="controls">
                                        <input type="password" name="admin_con_password" class="validate[required]">
                                    </div>
                                </div>
                                <input type="hidden" name="admin_id" value="<?php echo $_SESSION['admin']; ?>">


                                <!-- Form Action -->
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Change</button>
                                    <a class="btn" href="" class="btn">Cancel</a>
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