<?php
session_start();
require 'class/db-connection.php';
connection();
$qry;
if (isset($_GET['qry'])) {
    $qry = $_GET['qry'];
}
$query = "delete from state where state_id={$qry}";
$result = mysql_query($query);
if ($result) {

    header("location:state-display.php?qry=true");
} else {
    header("location:state-display.php?qry=false");
}
?>

