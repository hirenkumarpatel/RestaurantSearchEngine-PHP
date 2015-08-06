<?php
session_start();
require './class/db-connection.php';
connection();
if(!isset($_SESSION['user_id']))
{
    header("location:index.php");
}
else
{
    $user_id=$_SESSION['user_id'];
    $query="select foodie_id from foodie_detail where foodie_id='{$user_id}'";
    $result=  mysql_query($query)or die(mysql_error());
    $row=  mysql_fetch_array($result);
    if($row)
    {
        $query="update foodie_detail set foodie_status='0' where foodie_id='$user_id'";
        $result=  mysql_query($query)or die(mysql_error());
        if($result)
        {
            session_destroy();
            setcookie("user_id","", time()-60*60*24*5);
            header("location:index.php");
            
        }
    }
}
?>

