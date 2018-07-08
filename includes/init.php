<?php

$title = "Policy Lab Pilot Testing";


function exec_sql_query($db, $sql, $params = array()) {
  try{
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
  }

} catch (PDOException $exception) {
  handle_db_error($exception);
  }
}

function handle_db_error($exception) {

}

$messages = array();


function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}



function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        unlink($db_filename);
        throw $exception;
        handle_db_error ($exception);
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

$db = open_or_init_sqlite_db("PT_DB.sqlite", "init/init.sql");


function log_out() {
  global $current_user;
  $current_user = NULL;
  unset($_SESSION['current_user']);
  session_destroy();
}



function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function check_login() {
  global $db;

  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];

    $sql = "SELECT * FROM users WHERE session = :session_id;";
    $params = array (
      ":session_id" => $session,
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      return $account["username"];
    }
  }
  return NULL;
}

function log_in($name,$mturk){
  global $db;
  global $current_user;
  $existed = false;
  if (isset($_POST["login"])) {
      global $existed;
      $user_full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
      $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
      $user_ip = htmlspecialchars(getRealIpAddr());

      $full_list_of_users = exec_sql_query($db, "SELECT turk_id FROM users", array());
      foreach ($full_list_of_users as $individual){
        if ($individual[0] == $user_mTurk_code) {

          $session = uniqid();
          $sql = "UPDATE users SET session = :session WHERE  users.turk_id = :user_turk;";
          $params = array (
            ":user_turk" => $individual[0],
            ":session" => $session
          );
          $result = exec_sql_query($db, $sql, $params);
          if ($result) {
            setcookie("session", $session, time()+3600);
            return $user_mTurk_code;
            var_dump($individual[0]);
            $sql= "SELECT question_id FROM user_question_world_answer INNER JOIN users ON users.id=user_question_world_answer.user_id  WHERE users.turk_id  LIKE  '%' || :currentuser || '%'";
            $params = array (
            ":currentuser" => $user_mTurk_code,
            );
            $records = exec_sql_query($db, $sql, $params);
            $question_array = array();
            foreach($records as $record) {
              $question_array[]=$record;
            }
            // var_dump($question_array[(count($question_array)-1)]);
            $sql = "SELECT question_id_sequence FROM user_question_order INNER JOIN users ON users.id = user_question_order.user_id WHERE users.turk_id  LIKE  '%' || :currentuser || '%'";
            $params = array (
            ":currentuser" => $user_mTurk_code,
            );
            $records = exec_sql_query($db, $sql, $params);
            foreach ($records as $record) {
              $record = explode(",",$record[0]);
            }
            $id_carrier = $record[(count($record)-1)];
            var_dump($record[(count($record)-1)]);
            $current_user= $user_mTurk_code;
        }
      }}
    if (!$current_user){
      $sql = "INSERT INTO users (name, turk_id, user_ip) VALUES (:full_name, :turk_id, :user_ip);";
      $params = array(
        ':full_name' => $user_full_name,
        ':turk_id' => $user_mTurk_code,
        ':user_ip' => $user_ip
      );
      $record = exec_sql_query($db, $sql, $params);
      $user_id = $db->lastInsertId("id");
    }
  }

}
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $current_user = log_in($username, $password);
}else{
  $current_user = check_login();
}

?>
