<?php
session_start();
require './class/db-connection.php';
connection();
$qry=  mysql_real_escape_string($_GET['qry']);
if(!isset($qry)or empty($_qry))
{
    header("location:comment_display.php");
}
$query="delete from comment where comment_id='$qry'";
$result=  mysql_query($query)or die(mysql_error());
if($result){
    header("location:comment-display.php?qry=true");
}
else
{
    header("location:comment-display.php?qry=false");
}

?>
