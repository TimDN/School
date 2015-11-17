<?php
session_start();

if ($_SESSION["loggedIn"] != true)
{	
	header("Location: index.html");
	die("Redirecting to login"); 
}

?>