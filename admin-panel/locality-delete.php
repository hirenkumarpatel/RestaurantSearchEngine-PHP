<?php
require './class/db-connection.php';
connection();
session_start();

$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from locality where locality_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:locality-display.php?qry=true");
} else {
    header("location:locality-display.php?qry=false");
}
?>

