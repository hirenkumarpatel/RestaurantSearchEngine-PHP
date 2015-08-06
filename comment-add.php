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
  $review_id=$_POST['review_id'];
  $comment_text=$_POST['comment_text'];
  $query="insert into comment (comment_text,review_id,foodie_id)values('{$comment_text}','{$review_id}','{$foodie_id}')";
  $result=  mysql_query($query)or die(mysql_error());
  if($result)
  {
    header("location:review-detail.php?qry={$review_id}");
  }
}
?>
