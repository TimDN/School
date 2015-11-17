<!DOCTYPE html>
<?php
	session_start();
	require_once("DBapi.php");
	include 'db.php';
	$table = 'posts';
	
	$user ="";
	
	if(isset($_SESSION['userName']))
	{
		$user = $_SESSION['userName'];
	}
	$id = ($_GET['id']);
	
	if(isset($_POST['btnSubmbit']) && $_POST['btnSubmbit'] == "Skicka" )
	{
		DBapi::setMessage($_POST['txtPost'],$_SESSION['userName']);
	}
	
	$result = DBapi::getPosts($id);

	$sql = ("SELECT namn FROM threads
		WHERE id = $id")
		or die(mysql_error());
		
	$namnOpenSida = mysql_query($sql);
	$namnOpenSida = mysql_fetch_array($namnOpenSida);
?>
<html>
	<head>
		<title>Modul3</title>
		<link rel="stylesheet" type="text/css" href="stillmallar/stilmall.css"/> 
		<script type="text/javascript">		
			function bytLoggaIn()
			{
			var user = "<?php echo $user; ?>";

				if(user != "")
				{
					startProgramLoop();
					document.getElementById('loggaIn').innerHTML = "V�lkommen:"+ user +"<b"+"r/>"+"<form name=\"Logout\" method=\"post\" action=\"userFunctions.php\"><input type=\"submit\" value=\"Logout\" name=\"btnLogout\"/></form>";
				}
				else
				{
					document.getElementById('chatt').style.visibility = 'hidden';
					document.getElementById('loggaIn').innerHTML = "<a href=\"loggaIn.php\">Logga In</a> | <a href=\"registrera.php\">Registrera</a>";
				}
				
				<?php
				while($rows=mysql_fetch_array($result))
				{	
				?>
				for(i=3;i<6;i++)
				{
					var content = document.getElementById('content');
					var klass = "Mellan";
					var tempVar ="";
					
					tempVar = document.createElement("div"); //skapar en nod
					if(i%2 == 0)
						klass = "Text";
					else
						klass = "";
					tempVar.className="inlagg"+klass;
					tempVar.id=i; 
					content.appendChild(tempVar);
					
					if(i%3 == 0)
					{
						tempVar.innerHTML ="<?php echo $rows['username']; ?>"+"<br>"+"Registrerad:2012-11-28"+"<br>"+"Antal Inl�gg:10";
					}
					else if(i%2 == 0)
					{
						tempVar.innerHTML ="<?php echo $rows['text']; ?>".replace(/\n/g, "<br />");
					}
					else
					{
						tempVar.innerHTML ="<?php echo $rows['datum']; ?>";
					}
					
				}
				<?php
				}
				mysql_close();
				?>
			}
			
			function AJAXload(url,divOutput)
			{
			var xmlhttp;
				
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlhttp=new XMLHttpRequest();
				}
				else
				{// code for IE6, IE5
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				  //en lyssnare, funktionen k�rs varige g�ng readystate �ndras
				xmlhttp.onreadystatechange=function()
				{
					if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{
						//json parse �r en html5 grej (kolla eval om b�ttre bak�t kompabilitet �nskas)
						var jsondata=JSON.parse(xmlhttp.responseText);
				
						//nu vet vi att vi f�r tillbaka en lista(array) med namn s� vi loopar igenom dem, Skapar divtaggar f�r var och en av dem och l�gger till dem i v�rat element
						for(i=0;i<jsondata.length;i++)
						{
							var newDiv= document.createElement('div');
							newDiv.innerHTML ="("+jsondata[i].datum+") "+jsondata[i].username+": "+jsondata[i].text.replace(/\n/g, "<br />");
							newDiv.className="chattRuta";
							//l�gger till namn
							divOutput.appendChild(newDiv);
						}
					}
				}
				xmlhttp.open("GET",url,true);
				xmlhttp.send();
			}
			
			function startProgramLoop()
			{
				setInterval(getdata,4000);
			}

			function getdata()
			{
			var myDiv = document.getElementById("chattRutor");
			
			while(myDiv.firstElementChild) 
			{
				myDiv.removeChild(myDiv.firstElementChild);
			}

			AJAXload("json.php",myDiv);
			}

		</script>
	</head>
	<body onload="bytLoggaIn()"> 
	
		<div id="wrapper">
			<div id="header">
				<div id="�verskrift">
				<h1><a href="index.php">Modul3</a></h1>
				</div>
				<div id="loggaIn">
					 <!-- N�r sidan �ppnas skriv innerHtml av loggaIn till den inloggade anv�ndarens namn -->
				</div>
				<div id="menu"></div>
			</div>
			
			<div id="content"> <!-- Menyn �r statisk och beror p� vilken typ av sida det �r allt annat kommer h�mtas ur DB mha id p� den �ppnade sidan som skickas mellan sidorna  -->
				<div class="contentRutor v�nster"><a href="skapaSida.php?valdSida=inlagg&id=<?php echo $id; ?>">Skapa Nytt Inl�gg</a></div>
				<div class="contentRutor mitten">�ppnad Sida:<a href="index.php">Chivilary</a></div>
				<div class="contentRutor h�ger">V�lj Sida: 1 2 3 4 > Sista</div>
				<div class="overskrifter rutorMellan">Anv�ndare</div>
				<div class="overskrifter rutorMellan">Text</div>
				<div class="overskrifter rutorMellan">Inl�gg skapat</div>
			</div>
			
			<div id="footer">
				<p>All kod av : Tim Nielsen</p>
			</div>
		</div>
		<div id="chatt">
			<div id="formText">
				<form name="nyChatt" method="get" onSubmit="return addData()">
					Text:<textarea name="txtPost" rows="2" cols="20" maxlength="255" style="min-height:75px;max-height:75px;min-width:250px;max-width:250px;"></textarea>
					<input type="submit" value="Skicka" name="btnSubmbit" />
					<input type="hidden" value="<?php echo $_GET['id'];?>" name="id"/>
				</form>
			</div>
			<div id="chattRutor">
			</div>
		</div>
	</body>
</html>
