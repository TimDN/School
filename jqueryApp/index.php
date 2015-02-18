<!DOCTYPE html> 
<html>
<head> 
	<title>Restaurang Gröna Tryffeln</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 
	<body> 
		<div data-role="page" data-theme="a"> 
		 
			 <div data-role="header" data-theme="a"> 
				<h1>Restaurang Gröna Tryffeln</h1>
			</div>
			<div data-role="content">	
				<?php
					require_once("DBapi.php");
					$result = DBapi::getDays();
					if (mysql_num_rows($result) > 0)
						{		
						echo "<ul data-role='listview' data-theme='a'>
								<li data-role='list-divider'>Meny</li> ";
						while ($row = mysql_fetch_array($result)) :
							//DBapi::getMenuByDay($row[dagId]);
							echo "<li ><a href='days.php?dagId=$row[dagId]&dag=$row[namn]'>$row[namn]</a></li>";
						endwhile;
						}
					else
					{
						//Om inget hittades visa 
						echo "<li>Fel inga dagar hittades</li>";
					}
					echo "</ul>";
					

					function nextPage($dagId,$namn)
					{
						session_unset();
						session_start();
						if (!isset($_SESSION['dagId'])) 
						{
							$_SESSION['dagId'] = $dagId;
							$_SESSION['dag'] = $namn;  
						} 

					}

				?>
			</div>
		</div>
	</body>
</html>