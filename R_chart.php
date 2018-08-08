<?php
create_image();

function create_image(){


$width = 101;
//change the height here
//1% = 3.2
$height = 160;

$image = imagecreate($width, $height);

$rand = imagecolorallocate($image, 208, 2, 27);


imagefill($image, 0, 0, $rand);
imagepng($image);
imagedestroy($image);

}?>
