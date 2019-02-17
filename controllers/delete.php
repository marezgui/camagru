<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$id = $_POST["id_image"];

	unlink("../public/images/gallery/" . $id);

	$gallery = new Gallery();
	$gallery->delImages($id);

	$img = $gallery->getUserImage($_SESSION['login']);

	for ($i= 0; $i < count($img); $i++)
	{
		echo "<div class='container'>";
		echo "<img src='/camagru/public/images/gallery/" . $img[$i]['path'] . "' />";
		echo "<button class='btn' id='" . $img[$i]['path'] . "'>Supprimer</button>";
		echo "</div>";
	}
}