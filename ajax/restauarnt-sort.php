<?php

session_start();
require '../class/db-connection.php';
connection();
if (isset($_GET['rest_sort'])) {
    $rest_sort = mysql_real_escape_string($_GET['rest_sort']);
    //$qry=$_GET['qry'];
    if (empty($rest_sort)) {
        //header("location:restaurant-display.php");
    }
    if ($rest_sort == 'ra') {
        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id  group by rt.rest_id order by avg_rate";
      $result = mysql_query($query) or die(mysql_error());
      $record = mysql_affected_rows();
      echo "<script>alert('sorting on ra');</script>";
        
    } elseif ($rest_sort == 'rd') {
        
    $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id  group by rt.rest_id order by avg_rate desc";
      $result = mysql_query($query) or die(mysql_error());
      $record = mysql_affected_rows();
        
    }
     elseif ($rest_sort == 'ca') {
              $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id  group by rt.rest_id order by r.rest_cost desc";
      $result = mysql_query($query) or die(mysql_error());
      $record = mysql_affected_rows();

    }
     elseif ($rest_sort == 'cd') {
        $query = "select *,avg(rt.rate)as avg_rate from restaurant_detail r,locality l,city c,state s,rating rt
                  where r.locality_id=l.locality_id and r.city_id=c.city_id and c.state_id=s.state_id and rt.rest_id=r.rest_id  group by rt.rest_id order by r.rest_cost desc";
      $result = mysql_query($query) or die(mysql_error());
      $record = mysql_affected_rows();
    }
}
echo "helo";
    ?>
  