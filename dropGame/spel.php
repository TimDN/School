<!DOCTYPE html>
<?php
	$spelarNamn ="ANON";
	$bakgrund ="default";
	$kontrollMetod = "pil";
	$kontrollL =37;
	$kontrollR =39;
	
	if(isset($_GET['spelarNamn']))
	{
		$spelarNamn = $_GET['spelarNamn'];
	}
	if(isset($_GET['bakgrund']))
	{
		$bakgrund = $_GET['bakgrund'];
	}
	if(isset($_GET['kontrollMetod']))
	{
		if($_GET['kontrollMetod'] == "pil")
		{
		}
		else if($_GET['kontrollMetod'] == "gamer")
		{
			$kontrollL =65;
			$kontrollR =68;
		}
	}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stilmallar/stilmall.css"/>
		<title>Modul1</title>
		<script src="jquery-1.8.3.min.js"></script>
		<script src="bana.js" type="text/javascript"></script>
		<script src="spelare.js" type="text/javascript"></script>
		<script src="objekt.js" type="text/javascript"></script>
		<script>
			function init()
			{
				var pointSound = $("#pointBeep")[0];
				var lvlSound = $("#lvlBeep")[0];
				var strikeSound = $("#strikeBeep")[0];
				var g_counter = 0;
				var bana = new Array();
				var spelare = new Array();
				var objekt = new Array();
				var g_spelarnamn = "<?php echo $spelarNamn; ?>";
				var g_bakgrund = "<?php echo $bakgrund; ?>";				
				
				for(i = 0; i < 1; i++)
				{
					bana[i] = new Bana(50*(i+1),50);//Skapar banan
					
					tempVar = document.createElement("div"); 
					tempVar.className = "bana";
					tempVar.style.backgroundImage="url('art/"+g_bakgrund+"Bana.png')";
					tempVar.style.height = bana[i].height+"px";
					tempVar.style.width = bana[i].width+"px";
					tempVar.style.top =  bana[i].startY+"px";
					tempVar.style.left = bana[i].startX+"px";
					var testId = "banaNr"+i;
					tempVar.id = testId; 
					banaDiv.appendChild(tempVar);
					
					document.getElementById("banaDiv").style.width= bana[i].width + 70 + "px";
					document.getElementById("banaDiv").style.height = bana[i].height + 70 + "px";
					
					var xPosition = bana[i].width/2;
					spelare[i] = new Spelare(xPosition); //Skapar spelaren som finns i banan
					
					tempVar = document.createElement("div");					
					tempVar.className = "spelare";
					tempVar.style.backgroundImage="url('art/"+g_bakgrund+"Spelare.png')";
					tempVar.style.top =  bana[i].height-50+"px";
					tempVar.style.left = spelare[i].xPosition+"px";
					tempVar.id = "spelare"+i;
					banId = document.getElementById("banaNr"+i);
					banId.appendChild(tempVar);
				}		
				
				var pane = $('#banaNr0'),
				box = $('#spelare0'),
				w = pane.width() - box.width(),
				d = {},
				x = 5;

				function newv(v,a,b) 
				{
					var n = parseInt(v, 10) - (d[a] ? x : 0) + (d[b] ? x : 0);
					return (n < 0 ? 0 : (n > w ? w : n));
					/*
					n = parseInt(v, 10) - (if d[a] then x else 0) + (if d[b] then x else 0)//d[a] vänster knappen flyttar med -5px d[b]+5px
					if n < 0 then 0 else if n > w then w else n //0 gränsen åt vänster w åt höger om ingen gräns nåt flytta med n
					*/
				}

				$(window).keydown
				(
					function(e) 
					{ 
					d[e.which] = true; //Aktiverar bara på keydown
					}
				);
				
				$(window).keyup
				(
					function(e) 
					{ 
					d[e.which] = false; 
					}
				);

				setInterval(
					function() 
					{
						box.css({
						left: function(i,v)//ändrar style.top hos box
						{
							test = newv(v,<?php echo $kontrollL; ?>,<?php echo $kontrollR; ?>);//Anropar newv som flyttar knappen om d[37] == true
							spelare[0].setXPosition(test);//Updaterar spelarens Xposition
							return test; 
						}
						});
					}
				, 20);
				
				
				startProgramLoop();
				startDropObjectLoop();
	 
				function startProgramLoop()
				{
				   interval2 = setInterval(createaObject, bana[0].getObjectTimer());
				}
				 
				function startDropObjectLoop()
				{
					interval1 = setInterval(dropObject, bana[0].getDropTimer());
				}
				 
				function createaObject()//Skapar objekt MHA
				{
					xPosition = Math.floor((Math.random()*280));
					objekt[g_counter] = new Objekt(xPosition,0);
					tempVar = document.createElement("div"); 
					tempVar.className = "objekt";
					tempVar.id = "objekt"+g_counter;
					tempVar.style.backgroundImage="url('art/"+g_bakgrund+".png')";
					tempVar.style.top = "0px";
					tempVar.style.left = xPosition+"px";
					banId = document.getElementById("banaNr0"); 
					banId.appendChild(tempVar);
					g_counter++;
				}
				 
				function dropObject()
				{
					for(var x=0; x<g_counter ;x++)
					{
					var objektDoc = document.getElementById("objekt"+x);
					
						if(objektDoc)//Kollar så att diven existerar
						{
							var test = objekt[x].getYPosition()+5;//Flyttar objekt px neråt
							objekt[x].setYPosition(test);
							objektDoc.style.top = test+"px";
							
							if(objekt[x].getYPosition() > bana[0].getYBounds())//Kollar så att objektet är inom planen
							{
								strikeSound.play();
								spelare[0].increaseStrikes();//Ökar missar med ett
								objektDoc.parentNode.removeChild(objektDoc);//Tar bort det
								
								document.getElementById("strikeLabel").innerHTML  = "Strikes: " + spelare[0].getStrikes();
								if(spelare[0].getStrikes() == 3)//Om man missat 3 gånger
								{
									alert("Game Over\n Tryck Ok för att spela igen");
									window.location.href="submit.php?spelarNamn="+g_spelarnamn+"&score="+spelare[0].getScore();
								}
							}
							else if(objekt[x].getYPosition() >= bana[0].getYBounds()-70)//om det är inom Y-avstånd att fångas
							{
								var objektX = objekt[x].getXPosition();
								var SpelareX = spelare[0].getXPosition();
								
								if(objektX+20 >= SpelareX  && objektX <= SpelareX+50)//Kollar om nån del av objektet är inom spelaren
								{
									pointSound.play();
									spelare[0].increaseScore();//Ökar score med ett
									document.getElementById("scoreLabel").innerHTML  = "Score: " + spelare[0].getScore();
									
									if(spelare[0].getScore() % 10 == 0)
									{
										lvlSound.play();
										spelare[0].increaseLevel(); //Ökar level med ett 
										bana[0].increaseDropTimer(); // Höjer hastigheten på blockarna
										bana[0].increaseObjectTimer(); // ökar tiden på spawnade object
										clearInterval(interval1);
										clearInterval(interval2);
										document.getElementById("levelLabel").innerHTML  = "Level: " + spelare[0].getLevel();
										startDropObjectLoop();
										startProgramLoop();
									}

									objektDoc.parentNode.removeChild(objektDoc);//Tar bort det
								}
							}
						}
					}
				}		  
			}
  </script>
 </head>
 <body onload="init()">
 
  <div id="wrapper">
  
   <div id="header">
    <div id="menu">
    </div>
   </div>
   
   <div id="content">
   
		<div id="banaDiv">
		</div>	
		
		<div id="scoreBoard">
			<div id="scoreLabel">Score: 0</div>
			<div id="levelLabel">Level: 1</div>
			<div id="strikeLabel">Strikes: 0</div>
		</div>
   </div>

   
   <div id="footer">
   
   </div>
   
  </div>
<audio id="pointBeep" src="audio/pointBeep.wav" type="audio/wav"></audio>
<audio id="lvlBeep" src="audio/lvlBeep.wav" type="audio/wav"></audio>
<audio id="strikeBeep" src="audio/strikeBeep.wav" type="audio/wav"></audio>

 </body>
</html>
</html>