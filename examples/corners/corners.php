<?php

$h=$_GET['h'];
$w=$_GET['w'];
$c=$_GET['c'];
$b=$_GET['b'];
$a=$_GET['a'];

$width = $w*2;
$height = $h*2;
  
switch($a){
  case "tl":  
    $center_x = $width;
    $center_y = $height;
    $arc_start = 180;
    $arc_end = 270;
    break;
  case "tr":
    $center_x = -2;
    $center_y = $height;
    $arc_start = 270;
    $arc_end = 360;
    break;
  case "bl":
    $center_x = $width;
    $center_y = -1;
    $arc_start = 90;
    $arc_end = 0;
    break;
  case "br":
    $center_x = -2;
    $center_y = -1;
    $arc_start = 180;
    $arc_end = 90;
    break;
}

$_color = split(',', $c); 
$_background = split(',', $b);

$image = imagecreatetruecolor($width, $height);
$color = imagecolorallocate($image, $_color[0], $_color[1], $_color[2]);
$background = imagecolorallocate($image, $_background[0], $_background[1], $_background[2]);

imagefill($image, 0, 0, $background);
imagefilledarc($image, $center_x, $center_y, $width*2, $height*2, $arc_start, $arc_end, $color, IMG_ARC_PIE);

$image_dest = imagecreatetruecolor($w, $h);
imagecopyresampled($image_dest, $image, 0, 0, 0, 0, $w, $h, $width-1, $height-1);

header('Content-type: image/png');
imagepng($image_dest, NULL);

?>