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
        <link rel="stylesheet" type="text/css" href="css/zomato-style.css"/>
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
            <!--Header End--> 

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
                                <h1>FAQ <span>(How we can help you)</span></h1>
                            </div>
                        </div>
                    </div>
                </section>

                <!--Faq Start-->
                <section class="faq-page">
                    <div class="container">
                        <div class="row-fluid"> 
                            <!--Faq Tabs Start-->
                           
                                        <?php
                                        $num_list = array("","One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten");
                                        echo "<div class='accordion faq-accordion' id='accordion2'>";
                                        $query="select * from faq";
                                        $result=  mysql_query($query)or die(mysql_error());
                                        $i=1;
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<div class='accordion-group'>
                                                <div class='accordion-heading'> <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapse{$num_list[$i]}'><strong class='question'>Q</strong>{$row['faq_que']}<strong class='icon-open-close'>+</strong></a> </div>
                                                <div id='collapse{$num_list[$i]}' class='accordion-body collapse in'>
                                                    <div class='accordion-inner'>
                                                        <div class='accordion-inner-data'>
                                                            <div class='left-data' style='width:67px;text-align: center;vertical-align: middle;'> 
                                                                
                                                                <strong style='font-size: 16px;'>A</strong> </div>
                                                            <div class='right-data'>
                                                                <div class='top'>
                                                                    <p>{$row['faq_ans']}</p>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                                                    $i++;
                                        }   
                                           
                                        echo"</div>";
                                        ?>
                                    
                            <!--Faq Tabs End--> 

                        
                        </div>
                    </div>
                </section>
                <!--Faq End--> 

                <!--Blog Page Section End--> 
            </section>
            <!--Content Area End--> 

            <?php
            include './theme-part/footer.php';
            ?>

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