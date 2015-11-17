<?php
include 'db.php';
$table = "meddelanden";
	
	$sql = ("SELECT * FROM $table
	ORDER BY datum DESC");
	$result = mysql_query($sql)
	or die(mysql_error());

	$rows = array();
	while($r = mysql_fetch_assoc($result))
	{
		$rows[] = $r;
	}
	
//gör om det till json objekt och skriv ut det
	echo json_encode($rows);
?>