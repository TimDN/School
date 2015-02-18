<?php

$link = mysql_connect("localhost","dbuser","");

if (!$link) 
{
    die('Could not connect: ' . mysql_error());
}

$db_selected = mysql_select_db('test', $link);
mysql_set_charset('utf8',$link);

if (!$db_selected) 
{
    die ('Can\'t use foo : ' . mysql_error());
}

?>