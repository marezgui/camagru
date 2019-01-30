<?php
$filename = 'public/images/kitten.png';
$percent = 0.5;

header('Content-Type: image/png');

list($width, $height) = getimagesize($filename);
$new_width = $width * $percent;
$new_height = $height * $percent;

$dst = imagecreatefrompng("public/images/test.png");
$src = imagecreatefrompng($filename);
// imagecopyresampled ($dst_image, $src_image , $dst_x , $dst_y , $src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) : bool
imagecopyresampled($dst, $src, 85.99, 14.999, 0, 0, $new_width, $new_height, $width, $height);

imagepng($dst);
?>