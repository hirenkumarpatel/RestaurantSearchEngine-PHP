<?php
session_start();
require './class/db-connection.php';
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
connection();

if ($_SESSION['user_id']) {

    $query = "select * from foodie_detail where foodie_id='{$_SESSION['user_id']}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
        $foodie_id = $_SESSION['user_id'];
        $foodie_name = $row['foodie_name'];
        $foodie_address = $row['foodie_address'];
        $foodie_email = $row['foodie_email'];
        $foodie_contact = $row['foodie_contact'];
    }
} else {
    header("location:index.php");
}

?>
<!doctype html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <title>Restaurant Search Engine</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/zomato-style.css"/>

        <?php
        include './theme-part/header-script.php';
        ?>

    </head>

    <body>
        <!--Wrapper Start-->
        <div id="wrapper"> 
            <!--Header Start-->
            <header id="header"> 
                <div class="container">
                    <?php
                    include './theme-part/header.php';
                    ?>
                </div>
            </header>
            <!--Banner Start-->
            <section id="banner" class="height">
                <div class="contact-banner"><img src="images/inner-banner-3.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 
            <!--Content Area Start-->
            <section id="content" class="container"> 
                <!--Blog Page Section Start-->
                <section class="blog-page-section">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="heading">
                                <h1>User Profile</h1>
                            </div>
                        </div>
                        <!--Blog Post End--> 
                        <div class="container">
                            <div class="grid_16 column mbot2 clearfix pos-relative">
                                <div class="mtop1">
                                    <p class="error-message-highlight hidden" id="form-error" style=""></p>

                                    <div class="grid_16 column alpha section">
                                        <div class="grid_16 column alpha section sj-user-settings-container">

                                            <!-- Edit Profile -->

                                            <div class="ipadding even sj-user-settings" id="profile-edit">


                                                <!-- Change Password Settings -->


                                                <div class="sj-user-sub-section password-label"><div><a  class="change-password-link" href="<?php echo"user-change-password.php"; ?>">Change password</a></div></div>



                                                <!-- End Change Password Settings -->

                                                <form  method="POST"  enctype="multipart/form-data" action="user-profile-edit.php">
                                                    <div class="grid_8 column alpha">
                                                        <p>
                                                            <label class="z-label" for="name">Full name*</label>
                                                            <input type="text" id="name" name="foodie_name" class="" value="<?php echo $foodie_name; ?>">

                                                        </p>
                                                        <p>
                                                            <label class="z-label" for="city">City*</label>
                                                            <input type="text" name="foodie_address"  value="<?php echo $foodie_address; ?>">


                                                        </p>

                                                        <div class="sj-user-sub-section password-label">
                                                            <div><a href="<?php echo "user-account-delete.php"; ?>" id="delete-my-profile">Delete my account</a></div>
                                                            <div class="sj-user-sm pt5">Please note that this action is irreversible and all the data associated with your account will be permanently deleted in 30 days</div>
                                                        </div>


                                                    </div>
                                                    <div class="grid_8 column omega">

                                                        <p>
                                                            <label class="z-label" for="website_link">Email Address</label>
                                                            <input type="text" id="website_link" name="foodie_email" class="" value="<?php echo $foodie_email; ?>">

                                                        </p>


                                                        <p>
                                                            <label class="z-label" for="mobile">Mobile Number</label>
                                                            <input type="text" id="mobile" class="" name="foodie_contact" value="<?php echo $foodie_contact; ?>">
                                                            <input type="hidden" name="foodie_id" value="<?php echo $foodie_id; ?>">
                                                        </p>
                                                        <p>
                                                            <label class="z-label" for="website_link">Profile Picture</label>
                                                            <img src="<?php echo $foodie_photo; ?>" style="height:60px;width:50px;">
                                                            <input type="file"  name="foodie_photo" >

                                                        </p>
                                                        <p class="ta-right mtop2 submit-container"><input type="submit" id="submit" name="submit" class="btn" value="Save"></p>
                                                    </div>
                                                    <div class="clear"></div>
                                                </form>

                                            </div>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
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

    </div>
    <!--/ END Row -->
</div>
<!--/ END Content -->

</section>
<!--/ END Template Main Content -->

</body>



</html>