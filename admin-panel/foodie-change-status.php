
<?php 
require './class/db-connection.php';
connection();
session_start();
$msg  = '';
$qry = mysql_real_escape_string($_GET['qry']);
if(!isset($_GET['qry'])|| empty($_GET['qry']))
{
  header("location:foodie-display.php");
}
$query="select * from foodie_detail where foodie_id={$qry}";
$result=mysql_query($query);
if($result)
{
    $row=  mysql_fetch_array($result);
    if($row['foodie_status']==0)
    {
        $query="update foodie_detail set foodie_status='1' where foodie_id={$qry}";
        
    }
    else
    {
        $query="update foodie_detail set foodie_status='0' where foodie_id={$qry}";
    }
    $result1=mysql_query($query)or header("location:foodie-display.php?qry=false");
    if($result1)
    {
        header("location:foodie-display.php?qry=true");
    }
    else
    {
        header("location:foodie-display.php?qry=false");
    }
}
?>

