<?php
//innehåller alla databas anslutningar och variabler som används till det ($link,$db_selected)
class DBapi
{
	public static function setHighscore($spelarNamn,$score)
	{
		include 'db.php';
		
		$sql = ("INSERT INTO highscore (spelare,score)
		VALUES ('$spelarNamn','$score')")
		or die(mysql_error());
		$result = mysql_query($sql);
	}
	public static function getHighscore()
	{
		include 'db.php';
		
		$sql = ("SELECT spelare,score,datum FROM highscore
		ORDER BY score DESC limit 10")
		or die(mysql_error());
		$result = mysql_query($sql);
		
		return $result;
	}	
}
?> 