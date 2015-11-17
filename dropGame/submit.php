<?php
	require_once("DBapi.php");
	if(isset($_GET['spelarNamn']))
	{
		$spelarNamn = $_GET['spelarNamn'];
	}
	if(isset($_GET['score']))
	{
		$score = (int)$_GET['score'];
	}
	DBapi::setHighscore($spelarNamn,$score);
	
	header( 'Location: index.php' ) ;
?>