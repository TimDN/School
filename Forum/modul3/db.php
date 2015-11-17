<?php

$link = mysql_connect("localhost","SGDAS011","null");

if (!$link) 
{
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db('SGDAS011db', $link);
mysql_set_charset('utf8',$link);

if (!$db_selected) 
{
    die ('Can\'t use foo : ' . mysql_error());
}

?>