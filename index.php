<?php  
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
?>

<?php ob_start(); ?>

<?php 
	if (isset($_SESSION['login']))
	{
?>
		Bienvenue <?= ucfirst($_SESSION['login']) ?> !
<?php
	}
	else
	{
?>
<section>
	<p>Bienvenue sur Camagru !</p>
	<p>Connecter-vous pour pouvoir publier des photos.</p>
	<p>Vous pouvez tout de meme accéder à la galerie sans être connecté.</p>
</section>
<?php
	}
?>

<?php 
	$content = ob_get_clean();
	$title = "Accueil";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>