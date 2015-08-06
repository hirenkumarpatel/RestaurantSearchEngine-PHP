<?php

require './class/db-connection.php';
connection();

if ($_GET) {
  if (isset($_GET['qry'])) {
    $code = $_GET['qry'];
    $query = "select * from restaurant_detail where code='$code'";
    $result = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row) {
      
      $rest_id = $row['rest_id'];
      $query1 = "update restaurant_detail set rest_status='1' where rest_id='{$rest_id}'";
      $result1 = mysql_query($query1) or die(mysql_error());
      if ($result1) {
        echo "<script>alert('you have succsessfully changed status');</script>";
        header("location:index.php");
      }
    }
  }
}
?>