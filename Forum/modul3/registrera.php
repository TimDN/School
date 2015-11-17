<!DOCTYPE html>

<html>
	<head>
		<title>Modul3</title>
		<link rel="stylesheet" type="text/css" href="stillmallar/stilmall.css"/> 
	</head>
	<body>
	
		<div id="wrapper">
			<div id="header">
				<div id="överskrift">
				<h1><a href="index.php">Modul3</a></h1>
				</div>
				<div id="loggaIn">
				<a href="loggaIn.php">Logga In</a> | <a href="registrera.php">Registrera</a>
				</div>
				<div id="menu"></div>
			</div>
			
			<div id="content">
					<form method="post"  action="userFunctions.php" >
											
						<h4>
							Skapa ny användare
						</h4>	
						
						<div id="createUser">
							<label>Username:</label> <input type="text" name="username" />
						</div>
						
						<p></p>
						
						<div id="password">
							<label>Password:</label> <input type="password" name="password" />
						</div>
						
						<p></p>
						
						<div id="btnCreate"><input type="submit" value="create" name="btnCreate" /></div>
						
					</form>
			</div>
			
			<div id="footer"></div>
		</div>
	</body>
</html>
