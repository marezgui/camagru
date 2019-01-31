<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php'; 


	$gallery = new Gallery();

	
	$img = $gallery->getImages();
	$comments = $gallery->getComments($img['id']);
	
	
	$userId = $_SESSION['id'];
	$imageId = $_POST['id_img'];

