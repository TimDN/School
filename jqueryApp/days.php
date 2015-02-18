<!DOCTYPE html>
<html> 
<head> 
	<title>Min sida</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
	<body> 
		<div data-role="page" data-theme="a"> 

			<div data-role="header" data-theme="a"> 
				<h1><?php echo $_GET["dag"];?></h1>
			</div>

			<div data-role="content">	
				<?php
					require_once("DBapi.php");
					
					$result = DBapi::getMenuByDay($_GET["dagId"]);
					
					if (mysql_num_rows($result) > 0)
					{		
						echo "<ul data-role='listview' data-theme='a'>
								<li data-role='list-divider'>Maträtter</li> ";
						while ($row = mysql_fetch_array($result)) :
							echo "
							<div data-role='content'>	
								<p>$row[namn]</p>		
								<p>$row[allergi]</p>
								<p>$row[pris]</p> 
							</div>";
						endwhile;
					}
					else
					{
						echo "<li>Fel inga dagar hittades</li>";
					}
					echo "</ul>";
				
				?>   

			</div>

		</div>

	</body>
</html>