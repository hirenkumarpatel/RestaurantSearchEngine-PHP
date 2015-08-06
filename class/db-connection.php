<?php


require 'db-config.php';

function connection()
{

    mysql_connect(myhost,myhostuser,myhostpassword) or die("Connection Problem  ".mysql_error());
    mysql_select_db(mydatabase) or die(mysql_error());

    
    
}

