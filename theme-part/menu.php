<?php
mysql_connect("localhost", "root", "")or die(mysql_error());
mysql_select_db("restaurantsearchengine")or die(mysql_error());

?>
<div class="navbar navbar-inverse nav-bar">
    <div class="navbar-inner nav-bar-inner">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <div class="nav-collapse collapse top-nav" >
            <ul class="nav">
                <li class="dropdown active"> <a class="dropdown-toggle" href="index.php"> Home </a>

                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#" >Restaurant </a>
                    <ul class="dropdown-menu">
                        <li><a href="restaurant-display.php">Restaurant Detail</a></li>
                        <li><a href="top-restaurant.php">Top Restaurants</a></li>
                        <li><a href="restaurant-add.php">Add Restaurant</a></li>

                    </ul>
                </li>

                <li class="dropdown"> <a class="dropdown-toggle" href="" >Cuisine</a>
                    <ul class="dropdown-menu">

                        <?php
                        $query = "select * from cuisine";
                        $result = mysql_query($query) or die(mysql_error());
                        while ($row = mysql_fetch_array($result)) {
                            $cuisine_name=  ucwords($row['cuisine_name']);
                            echo "<li><a href='restaurant-display.php?cuisine1={$row['cuisine_id']}'>{$cuisine_name}</a></li>";
                        }
                        ?>

                    </ul>
                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href=""> Review </a>
                    <ul class="dropdown-menu">
                        <li><a href="review-list.php">Review Detail</a></li>
                    </ul>
                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href="faq.php">FAQs</a>

                </li>
                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#" > About </a>
                    <ul class="dropdown-menu">

                        <li><a href="about-us.php">About Us</a></li>

                    </ul>
                </li>
                <li class="dropdown"> <a class="dropdown-toggle" href="#" > Contact </a>
                    <ul class="dropdown-menu">

                        <li><a href="contact-us.php">Contact Us</a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <!--/.nav-collapse --> 
    </div>
    <!-- /.navbar-inner --> 
</div>