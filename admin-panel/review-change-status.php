
<?php 
require './class/db-connection.php';
connection();
session_start();
$msg  = '';
$qry = mysql_real_escape_string($_GET['qry']);
if(!isset($_GET['qry'])|| empty($_GET['qry']))
{
  header("location:review-display.php");
}
$query="select * from review where review_id={$qry}";
$result=mysql_query($query)or die("Error in Changing Status :".  mysql_error());
if($result)
{
    $row=  mysql_fetch_array($result);
    if($row['review_status']==0 or $row['review_status']==-1 )
    {
        $query="update review set review_status='1' where review_id={$qry}";
        
    }
    else
    {
        $query="update review set review_status='-1' where review_id={$qry}";
    }
    
    $result1=mysql_query($query)or header("location:review-display.php?qry=false");
    if($result1)
    {
        header("location:review-display.php?qry=true");
    }
    else
    {
        header("location:review-display.php?qry=false");
    }
}
?>

