<!DOCTYPE html>
<?php
	session_start();

	if ($_SESSION["loggedIn"] != true)
	{	
		header("Location: loggaIn.php");
		die("Redirecting to login"); 
	}	
	$user ="";
	$table = 'threads';
	
	if($_GET['valdSida'] == "inlagg")
		$table = 'posts';
	
	if(isset($_SESSION['userName']))
	{
		$user = $_SESSION['userName'];
	}
	
	if ($_POST)
	{
		include 'db.php';
		$date = date("Y-m-d");
		$overtradId = ($_GET['id']);
		
		if($overtradId == "0")
		{
			$namn = mysql_real_escape_string($_POST['namn']);
			
			$sql = ("INSERT INTO $table (namn,overtrad,datum)
				VALUES ('$namn',NULL,'$date') ");
			$result = mysql_query($sql,$link);
			
			header("Location: index.php?id=$overtradId ");
		}
		else if($table == 'threads')
		{
			$namn = mysql_real_escape_string($_POST['namn']);
		
			$sql = ("INSERT INTO $table (namn,overtrad,datum)
			VALUES ('$namn','$overtradId','$date') ");
			$result = mysql_query($sql,$link);
			
			header("Location:subjects.php?id=$overtradId");
		}
		else
		{
			$text = mysql_real_escape_string($_POST['txtPost']);
				
			$sql = ("INSERT INTO $table (username,trad,text,datum)
			VALUES ('$user','$overtradId','$text','$date') ")
			or die(mysql_error());
			$result = mysql_query($sql,$link);
			header("Location:threads.php?id=$overtradId");	
		}
	}
?>
<html>
	<head>
		<title>Modul3</title>
		<link rel="stylesheet" type="text/css" href="stillmallar/stilmall.css"/> 
		<script type="text/javascript">
			function bytLoggaIn()
			{
			var user = "<?php echo $user; ?>";
			var table = "<?php echo $table; ?>";
			
				if(user != "")
				{
					document.getElementById('loggaIn').innerHTML = "V?lkommen:"+ user +"<b"+"r/>"+"<form name=\"Logout\" method=\"post\" action=\"userFunctions.php\"><input type=\"submit\" value=\"Logout\" name=\"btnLogout\"/></form>";
				}
				else
				{
					document.getElementById('loggaIn').innerHTML = "<a href=\"loggaIn.php\">Logga In</a> | <a href=\"registrera.php\">Registrera</a>";
				}
				if( table == 'threads')
				{
					document.getElementById('text').style.visibility = 'hidden';
				}
				else
				{
					document.getElementById('namn').style.visibility = 'hidden';
				}
			}	
		</script>
	</head>
	<body onload="bytLoggaIn()">
	
		<div id="wrapper">
			<div id="header">
				<div id="överskrift">
				<h1><a href="index.php">Modul3</a></h1>
				</div>
				<div id="loggaIn">
				<a href="loggaIn.php">Logga In</a> | <a href="registrera.php">Registrera</a><!-- När sidan öppnas skriv innerHtml av loggaIn till den inloggade användarens namn -->
				</div>
				<div id="menu"></div>
			</div>
			
			<div id="content">
				<form method="post"  action="skapaSida.php?valdSida=<?php echo $_GET['valdSida']; ?>&id=<?php echo $_GET['id']; ?>">
					
					<div id="namn">
						<label>Namn:</label> <input type="text" name="namn" />
					</div>	
					
					<p></p>
					
					<div id="text">
						<label>Text:</label><textarea name="txtPost" rows="4" cols="20" maxlength="255" style="min-height:100px;min-width:150px;"></textarea>
					</div>
					
					<p></p>

					<div id="btnSubmit"><input type="submit" value="submit" name="btnSubmbit" /></div>
					
			</div>
			
			<div id="footer"></div>
		</div>
	</body>
</html>
