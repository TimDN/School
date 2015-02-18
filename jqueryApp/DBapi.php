<?php
//innehåller alla databas anslutningar och variabler som används till det ($link,$db_selected)
class DBapi
{
	
	public static function getDays()
	{
		include 'db.php';
		
		$sql = ("SELECT DISTINCT namn,dagId
				FROM meny
				NATURAL JOIN dag");
		$result = mysql_query($sql)
		or die(mysql_error());
	
		return $result;
	}
	
	public static function getMenuByDay($dagId)
	{
		include 'db.php';
		$sql = ("SELECT matratt.namn,matratt.allergi,matratt.bild,matratt.pris
				FROM matratt
				INNER JOIN meny ON matratt.matId = meny.matId
				WHERE meny.dagId = $dagId");
		$result = mysql_query($sql,$link)
		or die(mysql_error());
	
		return $result;
	}
	
	public static function getFoodInfo($matId)
	{
		include 'db.php';
		
		$sql = ("SELECT namn, allergi, bild, pris
				FROM  matratt 
				WHERE matId =$matId")
		or die(mysql_error());
		$result = mysql_query($sql,$link);
	
		return $result;
	}
}
?> 