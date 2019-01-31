<?php

$db = new mysqli("localhost", "root", "123456", "camagru");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$size = $_POST["size"];

$dst_x = $_POST["dst_x"];

$dst_y = $_POST["dst_y"];

$sql = "INSERT INTO images(id_user, path) VALUES (1, 'test.png')");
if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql;
}

// $filename = 'public/images/filtre/kitten.png';
// $percent = 0.5;

// header('Content-Type: image/png');

// list($width, $height) = getimagesize($filename);
// $new_width = $width * $percent;
// $new_height = $height * $percent;

// $dst = imagecreatefrompng("public/images/test.png");
// $src = imagecreatefrompng($filename);
// // imagecopyresampled ($dst_image, $src_image , $dst_x , $dst_y , $src_x ,$src_y ,$dst_w ,$dst_h ,$src_w ,$src_h ) : bool
// imagecopyresampled($dst, $src, 85.99, 14.999, 0, 0, $new_width, $new_height, $width, $height);

// imagepng($dst);
?>