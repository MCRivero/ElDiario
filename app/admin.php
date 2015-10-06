<?php
require '../lib/autoload.inc.php';

$db = DBFactory::getMysqlConnexionWithMySQLi();
$manager = new NewsManager_MySQLi($db);


if (isset($_GET['modifier']))
	{
		$news = $manager->getUnique ((int) $_GET['modifier']);
	}
	
if (isset($_GET['supprimer']))
	{
		$manager->delete((int) $_GET['supprimer']);
		$message = 'La noticia ha sido suprimida !';
	}
	
if (isset($_POST['auteur']))
	{
		$news = new News(
		array(
				'auteur' => $_POST['auteur'],
				'titre' => $_POST['titre'],
				'photo' => $_POST['photo'],
				'enlace' =>$_POST['enlace'],
				'contenu' => $_POST['contenu']
			)
		
		);
	
if (isset($_POST['id']))
	{
		$news->setId($_POST['id']);
	}
	
if ($news->isValid())
	{
		$manager->save($news);
		$message = $news->isNew() ? 'La noticia ha sido agregada!' : 'La noticia ha sido modificada !';
	}
else
	{
		$erreurs = $news->erreurs();
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<title>Administration</title>
<meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/styles.css" />
</head>
<body>
	<div id="wrapper">
	
		<p><a href="buscar.php" style="padding: 2em 0 0 1em">Volver a los resultados de la busqueda</a></p>
		<form action="admin.php" method="post">
		<p style="text-align: center">
		<?php
		if (isset($message))
			{
				echo $message, '<br />';
			}
		?>

		<?php if (isset($erreurs) && in_array(News::AUTEUR_INVALIDE,
		$erreurs)) echo 'El Autor es invalido.<br />'; ?>

		Autor : <input class="entrada" type="text" name="auteur" value="<?php if
		(isset($news)) echo $news->auteur(); ?>" /><br />

		<?php if (isset($erreurs) && in_array(News::TITRE_INVALIDE,
		$erreurs)) echo 'El titulo es invalido.<br />'; ?>

		Titulo : <input class="entrada" type="text" name="titre" value="<?php if
		(isset($news)) echo $news->titre(); ?>" /><br />

		<?php if (isset($erreurs) && in_array(News::PHOTO_INVALIDE,
		$erreurs)) echo 'Enlace a la foto invalido.<br />'; ?>

		Foto : <input class="entrada" type="text" name="photo" value="<?php if
		(isset($news)) echo $news->photo(); ?>" /><br />

		<?php if (isset($erreurs) && in_array(News::ENLACE_INVALIDE,
		$erreurs)) echo 'Enlace al articulo invalido.<br />'; ?>

		Enlace : <input class="entrada" type="text" name="enlace" value="<?php if
		(isset($news)) echo $news->enlace(); ?>" /><br />

		<?php if (isset($erreurs) &&
		in_array(News::CONTENU_INVALIDE, $erreurs)) echo 'El contenido es invalido.<br />'; ?>

		Contenido :<br /><textarea class="entrada" rows="8" cols="60"
		name="contenu"><?php if (isset($news)) echo $news->contenu(); ?></textarea><br />

		<?php
		if(isset($news) && !$news->isNew())
		{?>
		<input type="hidden" name="id" value="<?php echo $news->id(); ?>" />
		<input type="submit" value="Modifier" name="modifier" />

		<?php
		}else
			{
		?>

		<input class="entrada" type="submit" value="Añadir" />

		<?php
		}
		?>

		</p>
		</form>
		<p class="entrada" style="text-align: center">Actualmente hay <?php echo
		$manager->count(); ?> noticias. Esta es la lista :</p>
		<table>
		<tr><th>Autor</th><th>Titulo</th><th>Fecha de Alta</th><th>Ultima modificacion</th><th>Accion</th></tr>
		<?php
		foreach ($manager->getList() as $news)
		{
		echo '<tr><td>', $news->auteur(), '</td><td>', $news->titre(),
		'</td><td>', $news->dateAjout(), '</td><td>', ($news->dateAjout() ==
		$news->dateModif() ? '-' : $news->dateModif()), '</td>
		<td><a href="?modifier=', $news->id(), '">Modificar</a> | <a href="?supprimer=',
		$news->id(), '">Suprimir</a></td></tr>', "\n";
		}
		?>
		</table>
	</div>
</body>
</html>