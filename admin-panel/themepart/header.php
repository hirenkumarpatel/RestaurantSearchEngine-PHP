<?php
include '../class/data-truncate.php';
if (!isset($_SESSION['admin'])) {
    header("location:index.php");
} else {

    $admin_id = $_SESSION['admin'];
    $query = "select * from admin where admin_id='{$admin_id}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
        $admin_name = $row['admin_name'];
        $admin_photo = $row['admin_photo'];
        if ($admin_photo == "") {
            $admin_photo = "photo/not_avail.png";
        } else {
            $admin_photo = "photo/admin-photo/" . $admin_photo;
        }
    }
}
?>
<!-- START Template Header -->
<header id="header">
    <!-- START Logo -->
    <div class="logo hidden-phone hidden-tablet">
        <!--<a href="">Restaurant Search Engine</a>-->
        <img src="img/logo-img-white.png">

    </div>
    <!--/ END Logo -->

    <!-- START Mobile Sidebar Toggler -->
    <a href="#" class="toggler" data-toggle="sidebar"><span class="icon icone-reorder"></span></a>
    <!--/ END Mobile Sidebar Toggler -->

    <!-- START Toolbar -->
    <ul class="toolbar" id="toolbar">
        <!-- START Task -->

        <!--/ END Task -->

        <!-- START Notification -->
        <?php
        ?>
        <li class="notification">
            <a href="#" data-toggle="dropdown">
               
                <span class="icon iconm-bell-2"></span>
            </a>
            <!-- START Dropdown Menu -->
            <div class="dropdown-menu" role="menu">
                <header>Notifications <small></small></header>
                <ul class="body">
                    <?php
                    
                    $query = "select count(r.rest_id)as total_rest from restaurant_detail r where rest_status='-1'";
                    $result = mysql_query($query) or die(mysql_error());
                    $row1 = mysql_fetch_array($result); 
                    if($row1>0)
                    {
                        echo "<li>
                        <span class='icon icone-food'></span>
                        <a href='#' class='text'>
                            <strong>{$row1['total_rest']}</strong> new  restaurant registered to your site.<br>
                            
                        </a>
                       
                    </li>";
                    }
                    
                     $query = "select count(foodie_id)as total_foodie from foodie_detail  where foodie_status='-1'";
                    $result = mysql_query($query) or die(mysql_error());
                     $row = mysql_fetch_array($result); 
                    if($row>0)
                    {   echo "<li>
                        <span class='icon icone-user'></span>
                        <a href='#' class='text'>
                            <strong>{$row['total_foodie']}</strong> new  foodie registered to your site.<br>
                            
                        </a>
                       
                    </li>";
                    }
                    ?>


                </ul>
                <footer>
                    <a href="#">Clear Notifications</a>
                </footer>
            </div>
            <!--/ END Dropdown Menu -->
        </li>
        <!--/ END Notification -->

        <!-- START Message -->

        <?php
        $query = "select f.foodie_name,f.foodie_photo,r.rest_name,rw.* 
                    from foodie_detail f,restaurant_detail r,review rw
                    where rw.foodie_id=f.foodie_id and rw.rest_id=r.rest_id and rw.review_status='0' order by rw.review_date desc";
        $result = mysql_query($query) or die(mysql_error());
        $record = mysql_num_rows($result);
        ?>


        <li class="message">
            <a href="#" data-toggle="dropdown">
                <span class="badge"><?php echo $record; ?></span>
                <span class="icon iconm-bubbles-2"></span>
            </a>
            <!-- START Dropdown Menu -->
            <div class="dropdown-menu" role="menu">
                <header>
                    Reviews 

                </header>
                <ul class="body">
                    <?php
                    while ($row = mysql_fetch_array($result)) {
                        $foodie_name = $row['foodie_name'];
                        $foodie_photo = $row['foodie_photo'];
                        $date1 = explode(" ", $row['review_date']);
                        $date2 = explode("-", $date1[0]);
                        $day = $date2[2];
                        $month = $date2[1];
                        $year = $date2[0];
                        if ($foodie_photo == "") {
                            $foodie_photo = "photo/not_avail.png";
                        } else {
                            $foodie_photo = "photo/foodie-photo/{$foodie_photo}";
                        }
                        $data = truncate($row['review_text'], 30, " ");
                        echo "<li>
                        <span class='avatar'><img src='{$foodie_photo}' alt=''></span>
                        <a href='#' class='text'>
                            <strong>{$foodie_name}</strong><br>{$data}<br><small>{$day}/{$month}/{$year}</small>
                        </a>
                       
                    </li>";
                    }
                    ?>


                </ul>
                <footer>
                    <a href="#">View All Message</a>
                </footer>
            </div>
            <!--/ END Dropdown Menu -->
        </li>
        <!--/ END Message -->

        <!-- START Profile -->
        <li class="profile">
            <a href="#" data-toggle="dropdown">
                <span class="avatar"><img src="<?php echo $admin_photo; ?>" alt="Admin"></span>
                <span class="text hidden-phone"><?php echo $admin_name; ?><span class="role">Admin</span></span>
                <span class="arrow icone-caret-down"></span>
            </a>
            <!-- START Dropdown Menu -->
            <div class="dropdown-menu" role="menu">
                <header>
                    Your Profile 

                </header>
                <ul class="body">

                    <li>
                        <a href="admin-profile.php" class="text"><span class="icon icone-pencil"></span> Edit Profile</a>

                    </li>
                    <li>
                        <a href="admin-change-password.php" class="text"><span class="icon icone-pencil"></span> Change Password</a>

                    </li>
                </ul>
                <footer>
                    <a href="admin-logout.php" class="text"><span class="icon icone-off"></span> Logout</a>
                </footer>
            </div>
            <!--/ END Dropdown Menu -->
        </li>
        <!--/ END Profile -->
    </ul>
    <!--/ END Toolbar -->
</header>
<!--/ END Template Header -->
