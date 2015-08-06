<?php
session_start();
require 'class/db-connection.php';
connection();
$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from city where city_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:city-display.php?qry=success");
} else {
    header("location:city-display.php?qry=fail");
}
?>

