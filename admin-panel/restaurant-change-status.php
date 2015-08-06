
<?php 
require './class/db-connection.php';
connection();
session_start();
$msg  = '';
$qry = mysql_real_escape_string($_GET['qry']);
if(!isset($_GET['qry'])|| empty($_GET['qry']))
{
  header("location:restaurant-display.php");
}
$query="select * from restaurant_detail where rest_id={$qry}";
$result=mysql_query($query)or die("Error in Changing Selecting Status :".  mysql_error());
if($result)
{
    $row=  mysql_fetch_array($result);
    if($row['rest_status']==0)
    {
        $query="update restaurant_detail set rest_status='1' where rest_id={$qry}";
        
    }
    else
    {
        $query="update restaurant_detail set rest_status='0' where rest_id={$qry}";
    }
    $result1=mysql_query($query)or header("location:restaurant-display.php?qry=false");
    if($result1)
    {
        header("location:restaurant-display.php?qry=true");
    }
    else
    {
        header("location:restaurant-display.php?qry=false");
    }
}
?>

