<?php

session_start();
session_destroy();
setcookie("user_id","", time()-60*60*24*5);
header("location:index.php");
?>

