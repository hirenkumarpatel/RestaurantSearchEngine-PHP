<?php
session_start();
require './class/db-connection.php';
connection();
if($_GET)
{
        $qry=  mysql_real_escape_string($_GET['qry']);
        if(empty($qry))
        {
            header("location:index.php");
        }
        $query="delete from foodie_been_there where rest_id='{$qry}' and foodie_id='{$_SESSION['user_id']}'";
        $result=mysql_query($query)or die(mysql_error());
        if($result)
        {
            header("location:foodie-been-there-display.php");
        }
}
?>
