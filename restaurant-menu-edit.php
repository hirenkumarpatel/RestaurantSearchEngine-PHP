<?php
session_start();
require './class/db-connection.php';
connection();
if (!isset($_SESSION['restaurant_id'])) {
    header("location:owner-login.php");
} else {

    if ($_GET) {
        $qry = mysql_real_escape_string($_GET['qry']);
        if (empty($qry) or $qry != $_SESSION['restaurant_id']) {
            header("location:index.php");
        }
    }
    if (isset($_FILES['uploaded_files'])) {
        //For each file get the $key so you can check them by their key value
        foreach ($_FILES['uploaded_files']['name'] as $key => $value) {

            //If the file was uploaded successful and there is no error
            if (is_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key]) && $_FILES['uploaded_files']['error'][$key] == 0) {

                //Create an unique name for the file using the current timestamp, an random number and the filename			
                $filename = $_FILES['uploaded_files']['name'][$key];
                $filename = time() . rand(0, 999) . $filename;

                $query="insert into restaurant_menu(rest_menu,rest_id)values('{$filename}','{$_SESSION['restaurant_id']}')";
                $result=  mysql_query($query)or die(mysql_error());
                if($result)
                {
                    move_uploaded_file($_FILES['uploaded_files']['tmp_name'][$key], 'admin-panel/rest/rest-menu/' . $filename);
                }
                    
                
            } else {
                echo 'The file was not uploaded.';
            }
        }
        header("location:restaurant-display-menu.php?qry={$_SESSION['restaurant_id']}");
        
    }
}
?>
<html>


    <head>
        <meta charset="utf-8">
        <title>Edit|RestaurantSearchEngine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/jquery.js" type="text/javascript"></script>

        <?php include './theme-part/header-script.php'; ?>
        <script type="text/javascript">
            $(document).ready(function() {

                $('.add_field').click(function() {

                    var input = $('#input_clone');
                    var clone = input.clone(true);
                    clone.removeAttr('id');
                    clone.val('');
                    clone.appendTo('.input_holder');

                });

                $('.remove_field').click(function() {

                    if ($('.input_holder input:last-child').attr('id') != 'input_clone') {
                        $('.input_holder input:last-child').remove();
                    }

                });

            });

        </script>
    </head>

    <body>
        <!--Wrapper Start-->
        <div id="wrapper"> 
            <!--Header Start-->
            <?php include './theme-part/header.php'; ?>
            <!--Header End--> 

            <!--Banner Start-->
            <section id="banner" class="height">
                <div class="contact-banner"><img src="images/inner-banner-5.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 

            <!--Content Area Start-->
            <section id="content" class="container"> 
                <!--Blog Page Section Start-->
                <section class="blog-page-section">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading">
                                <h1>Update Restaurant Menu</h1>
                            </div>
                        </div>
                        <!--Blog Post End--> 

                    </div>
                </section>
                <section style="width:100%;">
                    <ul class="gallery_fun" style="width:100%;">
                        <?php
                        $query = "select * from restaurant_menu rm where rm.rest_id='{$_SESSION['restaurant_id']}'";
                        $result = mysql_query($query) or die(mysql_error());
                        while ($row = mysql_fetch_array($result)) {
                            echo "<li style='width:285px;margin-bottom:20px;float:left;'>
                            <div class='frame'><a href=''><img src='admin-panel/rest/rest-menu/{$row['rest_menu']}' alt='img' style='height:207px;width:268px;'></a></div>
                          </li>";
                        }
                        ?>

                    </ul>
                    
                </section>
                <section style="width:100%;">
                    <div style="margin-top:  10px;display: inline-table;">

                        <a class="add_field" style="padding: 10px 12px;cursor: pointer;background: #a80000;text-transform:uppercase;color:#fff;text-decoration:none;"> + Add Menu</a> &nbsp;&nbsp;&nbsp;
                        <a class="remove_field" style="padding: 10px 12px;cursor: pointer;background: #a80000;text-transform:uppercase;color:#fff;text-decoration:none;"> - Remove Menu</a>
                        
                        <form action="" method="POST" enctype="multipart/form-data" >
                            <input type="submit" value="Upload Menu" style="padding: 10px 12px;cursor: pointer;background: #a80000;text-transform:uppercase;color:#fff;text-decoration:none;font-size: 14px;margin:-30px 280px;height:40px;vertical-align: middle;">
                            <div class="input_holder">
                               <!--<input type="file" name="uploaded_files[]" id="input_clone" style="margin:10px 0px;"/>-->
                                <div class="fileupload pull-left fileupload-new" data-provides="fileupload" id="input_clone">
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="width: 100px; height: 120px; line-height: 50px;margin:20px 0px;"></div>                                
                                    <input type="file" name="uploaded_files[]"  style="padding: 0px;">
                                </div>
                               
                            </div>
                            
                        </form>
                    </div>
                </section>

            </section>
            <!--Content Area End--> 

            <!--Footer Area Start-->
            <?php
            include './theme-part/footer.php';
            ?>
            <!--Footer Area End--> 

        </div>
        <?php include './theme-part/footer-script.php'; ?>
        <script src="admin-panel/assets/bootstrap-fileupload/js/bootstrap-fileupload.min.js"></script>
    </div>
    <!--/ END Row -->
</div>
<!--/ END Content -->

</section>
<!--/ END Template Main Content -->

</body>

</html>

