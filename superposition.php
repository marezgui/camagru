<?php
 
header ("Content-type: image/png");
 
// Traitement de l'image source
$source = imagecreatefrompng("nuage.png");
$largeur_source = imagesx($source);
$hauteur_source = imagesy($source);
imagealphablending($source, true);
imagesavealpha($source, true);
 
// Traitement de l'image destination
$destination = imagecreatefrompng("billet.png");
$largeur_destination = imagesx($destination);
$hauteur_destination = imagesy($destination);
  
// Calcul des coordonnées pour placer l'image source dans l'image de destination
$destination_x = ($largeur_destination - $largeur_source)/2;
$destination_y =  ($hauteur_destination - $hauteur_source)/2;
  
// On place l'image source dans l'image de destination
//imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source, 100);
imagecopy($destination, $source, 0, 0, 50, 0, $largeur_source, $hauteur_source);
 
// On affiche l'image de destination
imagepng($source);
 
imagedestroy($source);
imagedestroy($destination);
 
?>