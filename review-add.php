<?php
session_start();
require './class/db-connection.php';
connection();
mysql_query("update visit set hit=hit+1 where visit_id='{$_SESSION['visitor']}'");
if(!isset($_SESSION['foodie_id']))
{
  header("location:foodie-login.php");
}
else {
  $foodie_id=$_SESSION['foodie_id'];
  
  $rest_id=$_POST['rest_id'];
  $review_text=$_POST['review_text'];
  $query="insert into review (review_text,rest_id,foodie_id)values('{$review_text}','{$rest_id}','{$foodie_id}')";
  $result=  mysql_query($query)or die(mysql_error());
  if($result)
  {
   
    header("location:index.php");
  }
}
?>
