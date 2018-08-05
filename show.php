<?php include('test2.php');

$full_list_of_users = exec_sql_query($myPDO, "SELECT * FROM user")->fetchAll();
var_dump($full_list_of_users);

$question_user_id = exec_sql_query($myPDO, "SELECT * FROM user_question_world_answer")->fetchAll();
var_dump($question_user_id);

?>
