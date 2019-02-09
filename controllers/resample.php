<?php

require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';

ob_start();

$size = $_POST["size"];
$dst_x = $_POST["dst_x"];
$dst_y = $_POST["dst_y"];
$filtre = $_POST["filtre"];
$photo = $_POST["photo"];

$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);
$data = base64_decode($photo);

$filename = '../public/images/filtre/'.$filtre;

list($width, $height) = getimagesize($filename);
$new_width = $width * $size;
$new_height = $height * $size;

$file = uniqid() . '.png';
file_put_contents('../public/images/gallery/' . $file, $data);

$dst = imagecreatefrompng('../public/images/gallery/' . $file);
$src = imagecreatefrompng($filename);
imagecopyresampled($dst, $src, $dst_x, $dst_y, 0, 0, $new_width, $new_height, $width, $height);

imagepng($dst, '../public/images/gallery/' . $file);

$gallery = new Gallery();
$gallery->addImages($_SESSION['id'], $file);

$img = $gallery->getUserImage($_SESSION['login']);

for ($i= 0; $i < count($img); $i++)
{
	echo "<div class='container'>";
	echo "<img src='/camagru/public/images/gallery/" . $img[$i]['path'] . "' />";
	echo "<button class='btn' id='" . $img[$i]['path'] . "'>Delete</button>";
	echo "</div>";
}
imagedestroy($src);
imagedestroy($dest);
?>