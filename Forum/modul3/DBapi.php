<?php
//innehåller alla databas anslutningar och variabler som används till det ($link,$db_selected)
class DBapi
{
	
	public static function getSubjects()
	{
		include 'db.php';
		
		$sql = ("SELECT * FROM threads
		WHERE overtrad IS NULL ORDER BY id ASC");
		$result = mysql_query($sql)
		or die(mysql_error());
	
		return $result;
	}
	
	public static function getThreads($id)
	{
		include 'db.php';
		
		$sql = ("SELECT * FROM threads
		WHERE overtrad = $id ORDER BY id ASC");
		$result = mysql_query($sql,$link)
		or die(mysql_error());
	
		return $result;
	}
	
	public static function getPosts($id)
	{
		include 'db.php';
		
		$sql = ("SELECT * FROM posts
		WHERE trad = $id ORDER BY datum ASC")
		or die(mysql_error());
		$result = mysql_query($sql,$link);
	
		return $result;
	}
	
	public static function setMessage($text,$user)
	{
		include 'db.php';
		
		$sql = ("INSERT INTO meddelanden (username,text)
		VALUES ('$user','$text')")
		or die(mysql_error());
		$result = mysql_query($sql);
	}	
}
?> 