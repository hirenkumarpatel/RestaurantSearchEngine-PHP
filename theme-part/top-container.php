<?php
if (isset($_SESSION['city'])) {
    $city = $_SESSION['city'];
} else {


    $query = "select city_id from city";
    $result = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $city_list[] = $row['city_id'];
    }
    $_SESSION['city'] = array_rand($city_list, 1);
    $city = $_SESSION['city'];
}

if (isset($_SESSION['user_id'])) {
    $query = "select foodie_id,foodie_name,foodie_photo from foodie_detail where foodie_id='{$_SESSION['user_id']}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
        $foodie_name = $row['foodie_name'];
        $foodie_photo = $row['foodie_photo'];
        if ($foodie_photo == "") {
            $foodie_photo = "admin-panel/photo/not_avail.png";
        } else {
            $foodie_photo = "admin-panel/photo/foodie-photo/{$foodie_photo}";
        }
    }
}
?>
<div class="top-container" style="margin-top: 0px;">

    <table  style="width:100%;">
        <tr>
            <td>
                <div id="city_loader" style="margin-top: 16px;" >
                    <?php
                    $query = "select * from state";
                    $result = mysql_query($query) or die(mysql_error());
                    echo"<form>";
                    ?>
                    <select  style='background:#f1f1f1' name='city_id' onchange="city_loader('ajax/city-loader.php?city=' + this.value)">


                        <?php
                        while ($row = mysql_fetch_array($result)) {
                            echo"<optgroup label='{$row['state_name']}'>";
                            $query1 = "select * from city where state_id='{$row['state_id']}'";
                            $result1 = mysql_query($query1) or die(mysql_error());
                            while ($row1 = mysql_fetch_array($result1)) {
                                if ($_SESSION['city'] == $row1['city_id']) {
                                    $select = "selected='selected'";
                                } else {
                                    $select = "";
                                }
                                echo "<option value='{$row1['city_id']}' $select>{$row1['city_name']}</option>";
                            }
                            echo "</optgroup>";
                        }
                        echo "</select>";
                        echo "</form>"
                        ?>
                </div>
            </td>
            <td>
                <?php
                if (isset($_SESSION['user_id'])) {
                    echo "<header id='top-container' style='margin-top:-20px;min-height:50px;width:150px;float:right;'>";
                    echo"<ul class='toolbar' id='toolbar' style='min-width:300px;'>";
                    echo "<li class='profile'>
      <a href='#' data-toggle='dropdown'>
        <span class='avatar'><img src='{$foodie_photo}' alt='img' style='width:40px;height:50px;'></span>
        <span >{$foodie_name}
          </span>
        
      </a>
      
      <div class='dropdown-menu' role='menu'>
        <header>
          Your Profile 
          <ul class='toolbar'>
            <li><span class='action show'><a href='user-profile.php' class='label label-important' style='color:#fff;'>Edit</a></span></li>
          
          </ul>
        </header>
        <ul class='body' style='list-style-type:none;'>
          <li>
            <a href='foodie-favorite-display.php' class='text'><span class='icon' data-icon='Æ'></span><br>Favorite</a>
            
          </li>
          <li>
            <a href='foodie-wishlist-display.php' class='text'><span class='icon'  data-icon='w'></span><br>Wishlist</a>
            
          </li >
          <li >
            <a href='foodie-been-there-display.php' class='text'><span class='icon'  data-icon='E'></span><br>BeenThere</a>
            
          </li>
           <li >
            <a href='foodie-review-display.php' class='text'><span class='icon'  data-icon='r'></span><br>Reviews</a>
            
          </li>
          
        </ul>
        <footer>
          <a href='user-logout.php' class='text'><span class='icon icone-off'></span>LOGOUT</a>
        </footer>
      </div>
     
    </li>";
                } elseif (isset($_SESSION['restaurant_id'])) {

                    echo "<div style='margin-top:-30px;float:right;'>";
                    echo"<a  href='user-login.php' style='padding:10px;font-size:14px;background:#BF0101;color:#fff;border-radius:4px;text-transform:uppercase;margin-bottom:50px;text-decoration:none;'>Login</a>";
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo"<a  href='user-logout.php' style='padding:10px;font-size:14px;background:#BF0101;color:#fff;border-radius:4px;text-transform:uppercase;margin-bottom:50px;text-decoration:none;'>Logout</a>";

                    echo "</div>";
                } else {
                    echo "<div style='margin-top:-20px;float:right;'>";
                    echo"<a  href='user-login.php' style='padding:10px;font-size:14px;background:#BF0101;color:#fff;border-radius:4px;text-transform:uppercase;margin-bottom:50px;text-decoration:none;'>Login</a>";
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo"<a  href='user-registration.php' style='padding:10px;font-size:14px;background:#BF0101;color:#fff;border-radius:4px;text-transform:uppercase;margin-bottom:50px;text-decoration:none;'>SignUp</a>";

                    echo "</div>";
                }
                ?>
            </td>
        </tr>


    </table>

</div>
<script type="text/javascript">

    function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp = false;
        try {
            xmlhttp = new XMLHttpRequest();  // XMLHttpRequest object is used to exchange data with a server behind the scenes. 
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (e) {
                try {
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e1) {
                    xmlhttp = false;
                }
            }
        }

        return xmlhttp;
    }



    function city_loader(strURL)
    {
        var req = getXMLHTTP(); // fuction to get xmlhttp object
        if (req)
        {
            req.onreadystatechange =
                    function() {
                        if (req.readyState == 4)
                        { //data is retrieved from server
                            if (req.status == 200)
                            { // which reprents ok status     
                                window.open("restaurant-display.php", "_self");


                            }
                            else
                            {
                                alert("There was a problem while using XMLHTTP:\n");
                            }
                        }
                    }
            req.open("GET", strURL, true); //open url using get method
            req.send(null);
        }
    }
</script>
