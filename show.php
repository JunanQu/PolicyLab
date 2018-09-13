<?php

include('test2.php');

$users = exec_sql_query($myPDO, "SELECT * FROM user ")->fetchAll();
var_dump($users);

$quesiton_dataset = exec_sql_query($myPDO, "SELECT * FROM user_question_world_answer ")->fetchAll();
// var_dump($quesiton_dataset);

$world = exec_sql_query($myPDO, "SELECT * FROM world ")->fetchAll();
var_dump($world);

?>
