<?php

require '../lib/autoload.inc.php';

$db = DBFactory::getMysqlConnexionWithMySQLi();
$manager = new NewsManager_MySQLi($db);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>El Diario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
	
	<script>
		function switch_display() {
			myEl = document.getElementById("edition_nav_list");
			myEl.style.display = (myEl.style.display == 'block') ? 'none' : 'block';
			
			elx = document.getElementsByClassName("edition");
			elx[0].style.backgroundColor = (elx[0].style.backgroundColor == 'rgb(80, 79, 80)') ? 'rgb(255, 255, 255)' : 'rgb(80, 79, 80)';
		}
	
		function switch_display1 (id) {
			var ELY = document.getElementById(id);
			ELY.style.display = (ELY.style.display == 'block') ? 'none' : 'block';
			ELY.style.backgroundColor = (ELY.style.backgroundColor == 'rgb(00, 99, 00)') ? 'rgb(00, 00, 00)' : 'rgb(00, 99, 00)';
		}
	</script>
	
  </head>
  
  <body>
	
    <div id="wrapper">
	
		<div id="header">
			<h3 id="fecha"><script src="../js/fecha.js"></script></h3>
			<h1>El Diario</h1>
		</div> <!-- header -->
		
		<div class="edition" onclick="switch_display()">Edition: <strong>US</strong><span class="arrow-down">&#x25BE;</span>
			<ul id="edition_nav_list">
				<li><a href="http://www.huffingtonpost.com/?country=CA"> Canada <span class="derecha">CA</span></a>
				</li>
				<li><a href="http://www.huffingtonpost.com/?country=FR"> France <span class="derecha">FR</span></a>	
				</li>
				<li><a href="http://www.huffingtonpost.com/?country=IT"> Italia <span class="derecha">IT</span></a>	
				</li>
				<li><a href="http://www.huffingtonpost.com/?country=ES"> Espa&ntilde;a <span class="derecha">ES</span></a> 
				</li>
				<li><a href="http://www.huffingtonpost.com/?country=US"> United States <span class="derecha">US</span></a>
				</li>
				<li><a href="http://www.huffingtonpost.com/?country=UK"> United Kingdom <span class="derecha">UK</span></a>
				</li>
			</ul>
		</div>

		<div class="searchbox">
			<form action="buscar.php" method="post">
				<input type="text" id="buscar" name="buscar" placeholder="Busca en El Diario">
				<input type="image" id="boton" src="../logos/Logo_Search.png" alt="Lupita">
			</form>					
		</div>

		<div id="secciones">
			<ul>
				<li><a href="index.html"><h2>P&aacute;gina Principal</h2></a></li>
				<li><a href=""><h2>Pol&iacute;tica</h2></a></li>
				<li><a href=""><h2>Econom&iacute;a</h2></a></li>
				<li><a href=""><h2>Ciencia&amp;Tecnolog&iacute;a</h2></a></li>
				<li><a href=""><h2>Mundo</h2></a></li>
			</ul>
		</div>

		<div id="main-buscar">
		
			<?php
				if (isset($_GET['id']))
				
					{
						$news = $manager->getUnique((int) $_GET['id']);
						echo '<img src=', $news->photo(), '>', "\n",
							'<h2><a href="', $news->enlace(), '">', $news->titre(), '</a></h2>', "\n",
							'<p>', nl2br($news->contenu()), '</p>', "\n";
						if ($news->dateAjout() != $news->dateModif())
							{
								echo '<p style="text-align: right;"><small><em>Modificado ',
								$news->dateModif(), '</em></small></p>';
							}
					}
				else
					{
						echo '<h2 style="text-align:center">Lista de las 5 ultimas noticias</h2>';
						foreach ($manager->getList(0, 7) as $news)
							{
								if (strlen($news->contenu()) <= 200)
									{
										$contenu = $news->contenu();
									}
								else
									{
										$debut = substr($news->contenu(), 0, 200);
										$debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
										$contenu = $debut;
									}
								echo '<img src=', $news->photo(), '><h4><a href="', $news->enlace(), '">', $news->titre(), '</a></h4>', "\n",
										'<p>', nl2br($contenu), '</p>', "\n";
							}
					}
			?>
		
		</div>  
		<p><a href="admin.php">Acceder al espacio de administracion</a></p>
		<div id="footer">
			<p>Copyright 2013 - Todos los derechos reservados</p>
		</div> <!-- footer -->
    </div> <!-- wrapper -->
  </body>
</html>