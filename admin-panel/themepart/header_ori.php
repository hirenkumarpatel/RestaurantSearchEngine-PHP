<?php
if(!isset($_SESSION['admin']))
{
    header("location:index.php");
  
  
}
else
{
   
    $admin_id=$_SESSION['admin'];
    $query="select * from admin where admin_id='{$admin_id}'";
    $result=mysql_query($query)or die(mysql_error());
    $row=mysql_fetch_array($result);
    if($row)
    {
        $admin_name=$row['admin_name'];
        $admin_photo=$row['admin_photo'];
        if($admin_photo == "")
        {
            $admin_photo="photo/not_avail.png";
        }
        else {
          $admin_photo="photo/admin-photo/".$admin_photo;
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
    

    <!-- START Notification -->
    <li class="notification">
      <a href="#" data-toggle="dropdown">
        <span class="badge">5</span>
        <span class="icon iconm-bell-2"></span>
      </a>
       START Dropdown Menu 
      <div class="dropdown-menu" role="menu">
        <header>Notifications <small>5 New</small></header>
        <ul class="body">
          <li>
            <span class="icon icone-hdd"></span>
            <a href="#" class="text">
              <strong>Hard Disk</strong> Lorem ipsum dolor sit<br>
              <small>A few second ago</small>
            </a>
            <span class="action"><a class="close" href="#">&times;</a></span>
          </li>
        
       
        </ul>
        <footer>
          <a href="#">Clear Notifications</a>
        </footer>
      </div>
       
    </li>
    <!--/ END Notification -->

  

    <!-- START Profile -->
    <li class="profile">
      <a href="#" data-toggle="dropdown">
        <span class="avatar"><img src="<?php echo $admin_photo;?>" alt="Admin"></span>
        <span class="text hidden-phone"><?php echo $admin_name; ?><span class="role">Admin</span></span>
       
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
            <a href="admin-change-password.php" class="text"><span class="icon icone-pencil"></span>Change Password</a>
            
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
