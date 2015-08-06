<?php
session_start();
require './class/db-connection.php';
connection();

echo "<script>alert('{$_FILES['foodie_photo']['name']}');</script>";
    $foodie_id = mysql_real_escape_string($_POST['foodie_id']);
    $foodie_name = mysql_real_escape_string($_POST['foodie_name']);
    $foodie_address = mysql_real_escape_string($_POST['foodie_address']);
    $foodie_email = mysql_real_escape_string($_POST['foodie_email']);
    $foodie_contact = mysql_real_escape_string($_POST['foodie_contact']);
    if ($_FILES['foodie_photo']['name'] == "") {
        $foodie_photo = "";
    } else {
        $foodie_photo = rand() . "-" . $_FILES['foodie_photo']['name'];
    }

    if ($foodie_photo == "") {
        $query = "update foodie_detail set foodie_name='{$foodie_name}',foodie_address='{$foodie_address}',foodie_email='{$foodie_email}',foodie_contact='{$foodie_contact}' where foodie_id='{$foodie_id}'";
    } else {
        $query = "update foodie_detail set foodie_name='{$foodie_name}',foodie_address='{$foodie_address}',foodie_email='{$foodie_email}',foodie_contact='{$foodie_contact}',foodie_photo='{$foodie_photo}' where foodie_id='{$foodie_id}'";
    }
    $result = mysql_query($query) or die(mysql_error());
    if ($result) {
        if ($foodie_photo != "") {
            move_uploaded_file($_FILES['foodie_photo']['tmp_name'], "admin-panel/photo/foodie-photo/{$foodie_photo}");
        }
        header("location:user-profile.php");
    }
?>