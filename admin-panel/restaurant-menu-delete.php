<?php
session_start();
require 'class/db-connection.php';
connection();
$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from restaurant_menu where menu_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:restaurant-menu-display.php?qry=true");
} else {
    header("location:restaurant-menu-display.php?qry=false");
}
?>

