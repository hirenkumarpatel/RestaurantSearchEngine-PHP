<?php
include './top_css.php';
echo "<div id='content'>";
include './active_session_user.php';


require './HirenInfotech_connectdb.php';
$qry;
$lowlimit=0;
$highlimit=5;

if(isset($_GET['qry']))
{
    $qry=$_GET['qry'];
    echo "Page :$qry<br>";
    $lowlimit=$qry*5-4;
    $highlimit=$lowlimit+4;
}

$query="select e_id,e_speciality,e_name,e_email,e_contact,e_doj from employee";
$result=mysql_query($query);
$recordcount=  \mysql_affected_rows();

$pagecount=$recordcount/5;
if($recordcount%5!=0)
{
    $pagecount++;
}
 
 
$query="select e_id,e_speciality,e_name,e_email,e_contact,e_doj from employee limit {$lowlimit},{$highlimit}";
$result=mysql_query($query);
echo"<table border='2'>";
echo"<tr bgcolor='#454845'><font color='white'><th>NAME<th>SPECIALITY<th>EMAIL<th> CONTACT NO<th> DOJ<th>DELETE<th>UPDATE</tr></font>";
while ($row = mysql_fetch_array($result)) 
{
   
    $spec=  explode(",", $row["e_speciality"]);
    $speclen=  count($spec);
    
    echo "<tr>";
    echo '<td rowspan='.($speclen) .'>'.$row["e_name"];
    echo '<td>'.$spec[0];
    echo '<td rowspan='.$speclen.'>'.$row["e_email"].'<td rowspan='.$speclen.'>'.$row["e_contact"].'<td rowspan='.$speclen.'>'.$row["e_doj"];
    echo "<td rowspan=$speclen><a href='deleteemployee.php?qry={$row['e_id']}'><img src='./images/delete.png'></a>";
    echo "<td rowspan=$speclen><a href='modify_employee_form.php?qry={$row['e_id']}'><img src='./images/update.png'></a>";
    
    echo "</tr>";
    for($i=1;$i<$speclen;$i++) {
        
        echo '<tr><td>'.$spec[$i].'</td></tr>';
    }
}
echo "<tr><td><a href='insert_employee_form.php' style='text-decoration:none;'><b style='background:#454845;padding:8px;'>New Employee</b></a>";
echo"<td colspan=6 align='right'>";
for($i=1;$i<=$pagecount;$i++)
{
    echo "<a href='show_employee.php?qry={$i}' style='text-decoration:none;'><b style='background:#454845;padding:8px;'>$i</a></b>&nbsp";
}
echo "</tr>";
echo '</table>';
include './Bottom_css.php';
?>
