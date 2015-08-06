<?php

require 'class/db-connection.php';
connection();
session_start();
$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from foodie_detail where foodie_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:foodie-display.php?qry=true");
} else {
    header("location:foodie-display.php?qry=false");
}
?>

