<?php

session_start();
require './class/db-connection.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
if (!isset($_SESSION['user_id'])) {
  
    header("location:user-login.php");
} else {
    
    $foodie_id = $_SESSION['user_id'];
    if (isset($_GET['qry'])) {
        $rest_id = mysql_real_escape_string($_GET['qry']);
       
        if (empty($rest_id)) {
            header("location:restaurant-display.php");
        }
        $query = "select * from foodie_wish_list where foodie_id='{$foodie_id}' and rest_id='{$rest_id}'";
        $result = mysql_query($query) or die(mysql_error());
        $record=  mysql_num_rows($result);
       
        if ($record==0) {
            $query = "insert into foodie_wish_list(foodie_id,rest_id)values('{$foodie_id}','{$rest_id}')";
            $result = mysql_query($query) or die(mysql_error());
                     
        }
        header("location:restaurant-display-detail.php?qry={$rest_id}");
    }
}
?>