
<?php 
require './class/db-connection.php';
connection();
session_start();
$msg  = '';
$qry = mysql_real_escape_string($_GET['qry']);
if(!isset($_GET['qry'])|| empty($_GET['qry']))
{
  header("location:cuisine-display.php");
}
$query="select * from cuisine where cuisine_id={$qry}";
$result=mysql_query($query)or die("Error in Changing Selecting Status :".  mysql_error());
if($result)
{
    $row=  mysql_fetch_array($result);
    if($row['cuisine_status']==0)
    {
        $query="update cuisine set cuisine_status='1' where cuisine_id={$qry}";
        
    }
    else
    {
        $query="update cuisine set cuisine_status='0' where cuisine_id={$qry}";
    }
    $result1=mysql_query($query)or header("location:cuisine-display.php?qry=fail");
    if($result1)
    {
        header("location:cuisine-display.php?qry=true");
    }
    else
    {
        header("location:cuisine-display.php?qry=false");
    }
}
?>

