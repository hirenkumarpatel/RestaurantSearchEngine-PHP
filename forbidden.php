<?php
session_start();
require './class/db-connection.php';
connection();

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
                <div class="contact-banner"><img src="images/inner-banner-4.jpg" alt="img"></div>
            </section>
            <!--Banner End--> 
         <section id="content" class="container"> 
    <!--Blog Page Section Start-->
    <section class="blog-page-section">
      <div class="row-fluid">
        <div class="span12">
          <div class="heading">
            <h1>403 Page</h1>
          </div>
        </div>
        <!--Blog Post End--> 
        
      </div>
    </section>
    <!--Blog Page Section End--> 
    
    <!--404 Page Start-->
    <section class="error-page">
      <div class="container">
        <div class="row-fluid">
          <div class="span12">
            <div class="error-page-inner"> <img src="images/error-page-img.png" alt="img">
              <form action="#" class="error-page-form">
                <h1>Access Restricted....</h1>
                <strong class="title">Forbidden!</strong>
               </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--404 Page End--> 
    
  </section>
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