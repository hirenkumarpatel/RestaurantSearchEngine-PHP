<?php

require './class/db-connection.php';
connection();
session_start();

$admin_id = $_POST['admin_id'];
$admin_name = $_POST['first_name'] . " " . $_POST['last_name'];
$admin_email = $_POST['admin_email'];
/*
 * $query = "select admin_email from admin where admin_id='{$admin_id}'";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_array($result);
if ($admin_email != $row['admin_email']) {
    
}*/

if ($_FILES['admin_photo']['name'] == "") {
    $admin_photo = "";
} else {
    $admin_photo = rand() . "-" . $_FILES['admin_photo']['name'];
}

if ($admin_photo == "") {
    $query = "update admin set admin_name='{$admin_name}' where admin_id='{$admin_id}'";
} else {
    $query = "update admin set admin_name='{$admin_name}',admin_photo='{$admin_photo}' where admin_id='{$admin_id}'";
}
echo "$query";
$result = mysql_query($query) or die(mysql_error());
if ($result) {
    if ($admin_photo != "") {
        move_uploaded_file($_FILES['admin_photo']['tmp_name'], "photo/admin-photo/" . $admin_photo);
    }
    header("location:admin-profile.php?qry=true");
} else {
    header("location:admin-profile.php?qry=false");
}
?>

