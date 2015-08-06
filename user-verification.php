<?php

require './class/db-connection.php';
connection();
if(empty($_GET['code'])or empty($_GET['email']))
{
    header("location:index.php");
}
if ($_GET) {
  if (isset(mysql_real_escape_string($_GET['code'])) and isset(mysql_real_escape_string($_GET['email']))) {
    $code = $_GET['code'];
    $email=$_GET['email'];
    $query = "select * from foodie_detail where code='$code' and foodie_email='{$email}'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
      $foodie_name = $row['foodie_name'];
      $foodie_id = $row['foodie_id'];
      
      $query1 = "update foodie_detail set foodie_status='1' where foodie_id='{$foodie_id}'";
      $result1 = mysql_query($query1) or die(mysql_error());
      if ($result1) {

        header("location:index.php?");
      }
    }
  }
  
}

?>

