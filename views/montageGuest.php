<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';
?>
<?php ob_start(); ?>

<section>
	<p>Vous devez etre connecter pour acceder a la partie montage.</p>
</section>

<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>