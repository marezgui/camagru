<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

	$gallery = new Gallery();

	$img = $gallery->getImages();
	$comments = $gallery->getComments($img['id']);
	/*
	for ($i = 0; $i < count($img); $i++)
	{
		$likes[$i] = (int) $galerie->getLikes($img['id']);
	}
	$nbComments = (int) $galerie->getNbComments($img['id']);
	*/
