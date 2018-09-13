<?php
// var_dump($current_user_world_id,$id_carrier);
// $a=exec_sql_query($myPDO, "SELECT * FROM user_question_world_answer WHERE (question_id = '$id_carrier' AND user_response = 'support' AND world_id = '$current_user_world_id')");
// var_dump($a);
// $b=1/count($a);
// $percent_friendly = number_format( $b * 100, 2 ) . '%';
// var_dump($percent_friendly);
create_image();

function create_image(){

$width = 101;
//change the height here
//1% = 3.2
$height = $b;

$image = imagecreate($width, $height);

$rand = imagecolorallocate($image, 74, 144, 226);

imagefill($image, 0, 0, $rand);
imagepng($image);
imagedestroy($image);

}?>
