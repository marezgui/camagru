<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php';
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php'; 

/*-------------------FUNCTION-----------------------*/
	function getLikes($id)
	{
		$gallery = new Gallery();
		return (int) $gallery->getLikes($id);
	}

	function likeStatus($id_user, $id_img)
	{
		$gallery = new Gallery();
		return $gallery->likeStatus($id_user, $id_img);
	}

	function getNbComments($id)
	{
		$gallery = new Gallery();
		return (int) $gallery->getNbComments($id);
	}

	function getComments($id)
	{
		$gallery = new Gallery();
		return $gallery->getComments($id);
	}
/*------------------------------PAGES----------------------------------------*/
	$gallery = new Gallery();

	if (isset($_GET['page']) AND !empty($_GET['page']) AND ($_GET['page'] > 0 AND $_GET['page'] <= ceil(count($gallery->getImages()) / 6) ))
	{
		$_GET['page'] = intval($_GET['page']);
		$actualPage = $_GET['page'];
	}
	else
		$actualPage = 1;

	$imgPage = 6;
	$start = ($actualPage - 1) * $imgPage;
	$img = $gallery->getImagesPage($start, $imgPage);
	$imgToPrint = count($img);
	$allImages = $gallery->getImages();
	$totalImg = count($allImages);
	$totalPage = ceil($totalImg / $imgPage);