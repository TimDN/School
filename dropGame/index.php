 <!DOCTYPE html>
 <?php
	require_once("DBapi.php");
	
	$result = DBapi::getHighscore();
 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stilmallar/stilmall.css"/>
		<title>Modul1</title>
		<script type="text/javascript">
		function init()
		{
				<?php
				while($rows=mysql_fetch_array($result))
				{	
				?>
					var highscore = document.getElementById('highscore');
					var klass = "";
					var tempVar ="";

					tempVar = document.createElement("div"); //skapar en nod
					tempVar.className="highscore";
					highscore.appendChild(tempVar);
					tempVar.innerHTML ="Spelarnamn:<?php echo $rows['spelare']; ?>"+" "+"Score:<?php echo $rows['score'];?>"+" "+"Datum:<?php echo $rows['datum']; ?>";
				<?php
				}
				mysql_close();
				?>
		}
			</script>
 <body onload="init()">
 
  <div id="wrapper">
  
   <div id="header">
    <div id="menu">
    </div>
   </div>
   
   <div id="content">
		<form method="get" action="spel.php">
		<div id="overText">
			<h2>F�nga dom om du kan!</h2>
				<h4>Ditt m�l �r att f�nga s� m�nga objekt som m�jligt</br>
				Du styr genom att anv�nda knappar v�nster och h�ger pil p� ditt tangentbord</h4>
		</div>
		<div id="spelarNamnDiv">
			<label>Spelare namn:</label> <input type="text" name="spelarNamn" />
		</div>
		<div id="bakgrundDiv">
			<label>Bakgrund:</label> 
			<select name="bakgrund">
				<option value="default">Minimalism</option>
				<option value="egg">H�nsg�rden</option>
				<option value="fatty">FattyPoPo</option>
				<!--<option value="cat">Pension�ren i aff�ren</option>-->
			</select>
			<label>Kontroll Metod:</label> 
			<select name="kontrollMetod">
				<option value="pil">Piltangenter</option>
				<option value="gamer">Gamerstyle(a/d)</option>
			</select>
		</div>
		<div id="submitKnapp"><input type="submit" value="klar" /></div>
		<h2>Highscore</h2>
		<div id="highscore">
		</div>
   <div id="footer">
   
   </div>
   
  </div>
  
 </body>
</html>