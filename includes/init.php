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
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
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



function log_in($username, $password) {
  global $db;
  if ($username && $password) {
    $sql = "SELECT * FROM accounts WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
        session_regenerate_id();
        $_SESSION['login_user']= $username;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          record_message("Logged in as $username");
          return $username;
        } else {
          record_message("Log in failed.");
        }
        } else {
          record_message("Invalid Username or Password.");
        }
        }  else {
          record_message("No username or password given.");
        }
    return NULL;
      }

function log_out() {
  global $current_user;
  $current_user = NULL;
  unset($_SESSION['current_user']);
  session_destroy();
}


  function check_login() {
    global $db;
    global $current_user_id;
    $now = time();
    if (isset($_SESSION['login_user'])) {
          if ($now > $_SESSION['expire']) {
          session_destroy();
          $current_user = Null;
          record_message( "Your Session Has Expired. Please Log In Again.");
          }
      $sql = "SELECT * FROM accounts WHERE username = :user;";
      $params = array (
      ":user" => $_SESSION['login_user'],
      );
      $records = exec_sql_query($db, $sql, $params)->fetchAll();
      if ($records) {
        $account = $records[0];
        $current_user_id = $account["id"];
        return $account["username"];
      }
    }
    return NULL;
  }

session_start();
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $current_user = log_in($username, $password);
}else{
  $current_user = check_login();
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








?>
