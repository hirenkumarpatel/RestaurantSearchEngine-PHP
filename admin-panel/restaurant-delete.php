<?php

require './class/db-connection.php';
connection();
session_start();
$qry = mysql_real_escape_string($_GET['qry']);
if (!isset($_GET['qry']) || empty($_GET['qry'])) {
  header("location:restaurant-display.php");
}
$query = "delete from restaurant_detail where rest_id='{$qry}'";
$result = mysql_query($query);
if ($result) {
  header("location:restaurant-display.php?qry=true");
} else {
  header("location:restaurant-display.php?qry=false");
}
?>

