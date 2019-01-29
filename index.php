<?php  
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
?>


<?php ob_start(); ?>

<?php 
	$content = ob_get_clean();
	$title = "Accueil";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>