<?php
session_start();
require './class/db-connection.php';
connection();
include './class/send-mail.php';
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
if($_POST)
{
    $user_name=  mysql_real_escape_string($_POST['user_name']);
    $user_email=  mysql_real_escape_string($_POST['user_email']);
    $user_message=  mysql_real_escape_string($_POST['user_message']);
    sendMail($user_name+$user_email,"akashinfotech16@gmail.com","aiproject","akashinfotech16@gmail.com","Contact us", $user_message);
    
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Restaurant|RestaurantSearchEngine</title>
       <link rel="stylesheet"  type="text/css" href="css/zomato-style.css"/>
        <?php include './theme-part/header-script.php'; ?>
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
                <div class="contact-banner"><img src="images/inner-banner-1.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 
            <div class="about-page">
                <div class="span12">
              <div class="heading">
                <h1>Contact Us</h1>
              </div>
            </div>
        <div class="container">
            
         <div class="row-fluid">
        <div class="span8">
          <div class="contact-form">
            <div class="head">
              <h2>Leave Us a Message</h2>
              <span class="email">email</span> </div>
            <form  method="post">
              <ul class="form-list">
                <li class="span4">
                  <input type="text" required="" pattern="[a-zA-Z ]+" name="user_name" placeholder="Name*" class="contact-input">
                </li>
                <li class="span8">
                  <input type="text" required="" pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" name="user_email" placeholder="Email*" class="contact-input">
                </li>
                
                <li class="span12 margin-non">
                    <textarea rows="10" cols="10" name="user_message" class="textarea" placeholder="Message" required=""></textarea>
                </li>
                <li class="span2 margin-non">
                  <input type="submit" name="submit" value="Submit" class="btns  btn-continue">
                </li>
              </ul>
            </form>
          </div>
        </div>
        <div class="span4">
          <div class="address-box">
            <div class="head">
              <h3>Address</h3>
              <span class="location">location</span> </div>
            <div class="address-area">
              <ul>
                <li class="location">K6,SHREE KRISHNA CENTER NAVARANGPURA<br>
                  AHMEDABAD.</li>
                <li class="call"> <strong class="phone">+9130002198</strong></li>
                <li class="email"> <a href="#" class="email">info@akashinfotech.co.in</a> <span class="small">(And we will respond you right away)</span> </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
        </div>
        
      </div>
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