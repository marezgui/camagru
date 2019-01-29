<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/confirmation.php'; ?>

<?php ob_start(); ?>

<p> <?= $msg ?></p>

<?php 
	$content = ob_get_clean();
	$title = "Confirmation";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>