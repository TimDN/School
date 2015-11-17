<?php
include 'db.php';
$table = 'users';

session_start();

if(isset($_POST['btnLogout']))//Utloggning
{
	$_SESSION["loggedIn"] = false;
	unset($_SESSION["userName"]);
	
	header("Location: index.php");
}

if($_SESSION["loggedIn"] == true)
{
	header("Location: admin.php");	
}

if(isset($_POST['btnLogin']))//Inloggning
{
	if(isset($_POST['password']))
	{
		$password = $_POST['password'];
		$salt = sha1(md5($password));
		$password = md5($password.$salt);
		$username = mysql_real_escape_string($_POST['username']);
		
		$sql = ("SELECT * FROM $table
		WHERE username ='$username' && password ='$password' ");
		$result = mysql_query($sql,$link)
		or die("Ett fel har uppstått var vänlig försök igen senare");
	
		if(mysql_num_rows($result))
		{
			$_SESSION["loggedIn"] = true;
			$_SESSION["userName"] = $username;
			header("Location: index.php");
		}
		else
		{
			$_SESSION["loggedIn"] = false;
			echo 'Incorrect Data';
		}
	}
}

if(isset($_POST['btnCreate']))//Skapa användare
{
	if($_POST['password'] != "" && $_POST['username'] != "")
		{
			$password = $_POST['password'];
			$salt = sha1(md5($password));
			$password = md5($password.$salt);
			$username = mysql_real_escape_string($_POST['username']);
			
			$sql = ("INSERT INTO $table (username,password)
			VALUES ('$username','$password') ");
			$result = mysql_query($sql,$link)
			or die("Ett fel har uppstått var vänlig försök igen senare");
			
			header("Location: index.php");
		}
}
?>