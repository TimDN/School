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
				<a href="loggaIn.php">Logga In</a> | <a href="registrera.php">Registrera</a><!-- När sidan öppnas skriv innerHtml av loggaIn till den inloggade användarens namn -->
				</div>
				<div id="menu"></div>
			</div>
			
			<div id="content">
				<form method="post"  action="userFunctions.php" >
					
					<h4>
						Logga In
					</h4>	
					
					<div id="username">
						<label>Username:</label> <input type="text" name="username" />
					</div>	
					
					<p></p>
					
					<div id="password">
						<label>Password:</label> <input type="password" name="password" />
					</div>
					
					<p></p>

					<div id="btnLogin"><input type="submit" value="login" name="btnLogin" /></div>
					
			</div>
			
			<div id="footer"></div>
		</div>
	</body>
</html>
