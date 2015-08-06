<?php

require './class/db-connection.php';
connection();
for($i=1;$i<=12;$i++)
{
    
    $query="select count(visit_date)as visit from visit where visit_date between '2014-{$i}-1 00:00:01' and '2014-{$i}-31 23:59:59' ";
    $result=  mysql_query($query)or die(mysql_error());
    $row=  mysql_fetch_array($result);
    $month_visit[]=  number_format($row['visit'],1);
}

?>
