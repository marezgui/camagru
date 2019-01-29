<?php
$filename = 'billet.png';
$percent = 1;

header('Content-Type: image/png');

list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

$dst = imagecreatefrompng("color.png");
$src = imagecreatefrompng($filename);
// imagecopyresampled ($dst_image, $src_image , $dst_x , $dst_y , $src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) : bool
imagecopyresampled($dst, $src, 500, 500, 0, 0, $new_width, $new_height, $width, $height);

imagepng($dst);
?>