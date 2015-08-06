
<?php 
require './class/db-connection.php';
connection();
session_start();
$msg  = '';
$qry = mysql_real_escape_string($_GET['qry']);
if(!isset($_GET['qry'])|| empty($_GET['qry']))
{
  header("location:comment-display.php");
}
$query="select * from comment where comment_id={$qry}";
$result=mysql_query($query)or die("Error in Changing Status :".  mysql_error());
if($result)
{
    $row=  mysql_fetch_array($result);
    if($row['comment_status']==0 or $row['comment_status']==-1 )
    {
        $query="update comment set comment_status='1' where comment_id={$qry}";
        
    }
    else
    {
        $query="update comment set comment_status='-1' where comment_id={$qry}";
    }
    
    $result1=mysql_query($query)or header("location:comment-display.php?qry=false");
    if($result1)
    {
        header("location:comment-display.php?qry=true");
    }
    else
    {
        header("location:comment-display.php?qry=false");
    }
}
?>

