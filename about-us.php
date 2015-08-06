<?php
session_start();
require './class/db-connection.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
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
            <div class="about-page">
                <div class="span12">
              <div class="heading">
                <h1>About Us</h1>
              </div>
            </div>
        <div class="container">
            
          <div class="row-fluid about-section-1">
            <div class="span5">
              <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                  <li data-target="#myCarousel" data-slide-to="3" class=""></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <div class="item active left">
                    <div class="frame"><img src="images/about-img.jpg" alt="img"></div>
                  </div>
                  <div class="item next left">
                    <div class="frame"><img src="images/about-img.jpg" alt="img"></div>
                  </div>
                  <div class="item">
                    <div class="frame"><img src="images/about-img.jpg" alt="img"></div>
                  </div>
                  <div class="item">
                    <div class="frame"><img src="images/about-img.jpg" alt="img"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="span7">
              <p>Global Cuisine is your one-stop shop to locate, access information about restaurants and nightlife establishments in India's metropolitans and other popular cities. Based on the popular Food Guide and Nightlife Guide, Global Cuisine further provides the user with other essential details. Besides featuring the basic elements like the address, phone number, ratings, reviews, the portal tips the user on the special features of each establishment. For visual reference, establishment our presented with pictures, information and menus.For better user interactive, one can register on Global Cuisine build their profile on the site. With aspects like user-reviews, user-ratings, and an option to list one's favourite joints in the city Global cuisine gives the user a personal feel and encourages interactivity.</p>
              <p>Our site features dining places in India, which are categorized by cuisine, district, and price range to allow users to quickly and easily find their favorite restaurants. Users can learn more by going through each restaurant's gourmet reviews and photos, and even bookmark their favorite ones. We welcome all food lovers to participate in our community by posting restaurant reviews and sharing dining experience with each other. </p>
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