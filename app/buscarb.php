<?php
include 'db_include.php';
doDB();
	$clean_text = mysqli_real_escape_string($mysqli, $_POST['buscar']);

	//gather the topics
	$get_temas_sql = "select imagen, link_articulo, resumen_articulo, inf_link_articulo from articulos";
	$get_temas_sql .= " where resumen_articulo like '%" . $clean_text . "%'";
	$get_temas_res = mysqli_query($mysqli, $get_temas_sql) or die(mysqli_error($mysqli));
	
	
	if (mysqli_num_rows($get_temas_res) < 1) {
	//there are no topics, so say so
		$display_block = <<<END_OF_TEXT
		<p>No hay articulos para $clean_text </p>
END_OF_TEXT;

	} else {
	
	while ($topic_info = mysqli_fetch_array($get_temas_res)) {
		$imagen = $topic_info['imagen'];
		$link_articulo = stripslashes($topic_info['link_articulo']);
		$resumen_articulo = $topic_info['resumen_articulo'];
		$inf_link_articulo = stripslashes($topic_info['inf_link_articulo']);
		if (mysqli_num_rows($get_temas_res) == 1) {
			//add to display
			$display_block = <<<END_OF_TEXT
		
			<div class="inner">
				<a href="http://laverdad.ve/blogs.html"><img src="$imagen"/></a>
				<div>
					<a href="blogs.html"><span class="palabra-clave">Francia </span>$link_articulo</a>
					<p>$resumen_articulo</p>
					<p class="link-noticia">$inf_link_articulo</p>
				</div>
			</div>
END_OF_TEXT;
		} else {
				if (mysqli_num_rows($get_temas_res) > 1) {
					//add to display
					$display_block .= <<<END_OF_TEXT
		
					<div class="inner">
						<a href="http://laverdad.ve/blogs.html"><img src="$imagen"/></a>
						<div>
							<a href="blogs.html"><span class="palabra-clave">Francia </span>$link_articulo</a>
							<p>$resumen_articulo</p>
							<p class="link-noticia">$inf_link_articulo</p>
						</div>
					</div>
END_OF_TEXT;
				}
		}

	}	
	
	}
	//free results
	mysqli_free_result($get_temas_res);

	//close connection to MySQL
	mysqli_close($mysqli);
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>La Verdad</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
	
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
			<h3>11 Abril 2013</h3>
			<h1>La Verdad</h1>
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
				<input type="text" id="buscar" name="buscar" placeholder="Busca en La Verdad">
				<input type="image" id="boton" src="../logos/Logo_Search.png" alt="Submit">
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
		<?php echo $display_block; ?>
		</div>  
		
		<div id="footer">
			<p>Copyright 2013 - Todos los derechos reservados</p>
		</div> <!-- footer -->
    </div> <!-- wrapper -->
  </body>
</html>