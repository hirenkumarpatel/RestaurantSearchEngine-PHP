<?php
ob_start();
session_start();
session_destroy();
setcookie("admin","", time()-60*60*24*5);
header("location:index.php");
?>

