<?php

require 'class/db-connection.php';
connection();
session_start();
$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from cuisine where cuisine_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:cuisine-display.php?qry=true");
} else {
    header("location:cuisine-display.php?qry=false");
}
?>

