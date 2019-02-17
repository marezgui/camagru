<?php
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$size = $_POST["size"];
	$dst_x = $_POST["dst_x"];
	$dst_y = $_POST["dst_y"];
	$filtre = $_POST["filtre"];
	$photo = $_POST["photo"];

	$size = explode(',', $size);
	$dst_x = explode(',', $dst_x);
	$dst_y = explode(',', $dst_y);
	$filtre = explode(',', $filtre);

	if ($filtre[0] == "none")
		$nbfiltre = 0;
	else
		$nbfiltre = count($filtre);

	$filtre_array = array($size, $dst_x, $dst_y, $filtre);

	$photo = str_replace('data:image/png;base64,', '', $photo);
	$photo = str_replace(' ', '+', $photo);
	$data = base64_decode($photo);

	$file = uniqid() . '.png';
	file_put_contents('../public/images/gallery/' . $file, $data);

	$dst = imagecreatefrompng('../public/images/gallery/' . $file);

	$i = 0;
	while ($i < $nbfiltre)
	{
		$filename = '../public/images/filtre/'.$filtre_array[3][$i].'.png';
		list($width, $height) = getimagesize($filename);
		$new_width = $width * $filtre_array[0][$i];
		$new_height = $height * $filtre_array[0][$i];
		$src = imagecreatefrompng($filename);
		imagecopyresampled($dst, $src, $filtre_array[1][$i], $filtre_array[2][$i], 0, 0, $new_width, $new_height, $width, $height);
		$i++;
	}

	$newwidth = 500;
	$newheight= 500;

	imagepng($dst, '../public/images/gallery/' . $file);

	list($width, $height) = getimagesize('../public/images/gallery/' . $file);

	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefrompng('../public/images/gallery/' . $file);

	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	imagepng($thumb, '../public/images/gallery/' . $file);

	if ($nbfiltre)
		imagedestroy($src);
	imagedestroy($dst);

	$gallery = new Gallery();
	$gallery->addImages($_SESSION['id'], $file);

	$img = $gallery->getUserImage($_SESSION['login']);

	for ($i= 0; $i < count($img); $i++)
	{
		echo 
			"<div class='container'>
				<img src='/camagru/public/images/gallery/" . $img[$i]['path'] . "' />
				<button class='btn' id='" . $img[$i]['path'] . "'>Supprimer</button>
			</div>";
	}
}