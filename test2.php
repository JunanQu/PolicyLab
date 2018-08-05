<?php

    $host = 'thirdtest.camwsondhmqr.us-east-2.rds.amazonaws.com';
    $db   = 'ebdb';
    $user = 'thirdtest';
    $pass = 'Qja1998+0325';
    $port = '3306';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $myPDO = new PDO($dsn, $user, $pass, $opt);
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    function random_question_order_generator(){
      $array = [];

      while( count($array) < 20 ){
      $rand = mt_rand(1,20);
      $array[$rand] = $rand;
      }

      return $array;
    }
    $new_question_order=random_question_order_generator();
    $new_question_order = implode(",",$new_question_order);
    // var_dump($new_question_order);


    function exec_sql_query($myPDO, $sql, $params = array()) {
      try{
        $query = $myPDO->prepare($sql);
        if ($query and $query->execute($params)) {
          return $query;
      }

    } catch (PDOException $exception) {
      handle_db_error($exception);
      }
    }

    function handle_db_error($exception) {
    }






    // -----------

    function check_login() {
      global $myPDO;
      // var_dump($_COOKIE["session"]);
      if (isset($_COOKIE["session"])) {
        $session = $_COOKIE["session"];

        $sql = "SELECT * FROM user WHERE session = :session_id;";
        $params = array (
          ":session_id" => $session,
        );
        $records = exec_sql_query($myPDO, $sql, $params)->fetch(PDO::FETCH_ASSOC);;
        if ($records) {
          $user = $records[0];
          return $user["mturk"];
        }
      }
      return NULL;
    }

    function log_in($name,$mturk){
      global $myPDO;
      // global $current_user;
      global $new_question_order;
      $current_user = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);

      if (isset($_POST["login"])) {
          $user_full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
          $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
          $user_political = "Default_Democrat";
          $full_list_of_users = exec_sql_query($myPDO, "SELECT mturk FROM user")->fetchAll();
          // var_dump($full_list_of_users);
          $reorganized_users=array();
          foreach ($full_list_of_users as $a){
            array_push($reorganized_users,$a["mturk"]);
          };
              if (in_array($user_mTurk_code,$reorganized_users)){
              echo "this is not a new user";
              $session = uniqid();
              $result = exec_sql_query($myPDO, "UPDATE user SET session = '". $session. "' WHERE  user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
              // var_dump($result);
              if ($result) {
                setcookie("session", $session, time()+3600);
                $records = exec_sql_query($myPDO, "SELECT user_id, question_id_sequence FROM user_question_order INNER JOIN user ON user.id = user_question_order.user_id WHERE user.mturk='". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
                // var_dump($records);
                $record = explode(",",$records['question_id_sequence']);

                $id_carrier = $record[(count($record)-1)];
                // var_dump($record[(count($record)-1)]);
                // var_dump($current_user);
                return $current_user= $user_mTurk_code;
            }
            return $current_user= $user_mTurk_code;
          }else{
                $current_user = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
                $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
                $user_political = "Default_Democrat";
                echo "THIS IS A NEW USER";
                var_dump($user_mTurk_code,$user_political);
                $result = exec_sql_query($myPDO, "INSERT INTO user (mturk, political_stand, question_id_sequence) VALUES ('$user_mTurk_code', '$user_political', '$new_question_order')");
                var_dump($result);
                $session = uniqid();
                // var_dump($session);

                $records = exec_sql_query($myPDO, "UPDATE user SET session = '". $session. "' WHERE  user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
                if($records){
                  setcookie("session", $session, time()+3600);
                }
                // ---------------------------------------

                $record2 = exec_sql_query($myPDO, "SELECT id FROM user WHERE user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
                $current_user_id = $record2['id'];
                var_dump($current_user_id);

                // ---------------------------------------

                // I need to echo out user_id from 'users' table and cast that into a variable for next sql comman

                // var_dump($new_question_order);
                // $result3 = exec_sql_query($myPDO, "INSERT INTO user_question_order VALUES ('$current_user_id', '$new_question_order')");
                // $a= exec_sql_query($myPDO, "SELECT * FROM user_question_order")->fetchAll();
                // var_dump($a);
                $user_id = $myPDO->lastInsertId("id");
                $current_user= $user_mTurk_code;
                return $current_user;
          }
        }
      }

      function check_question_id(){
        global  $myPDO;
        global $current_user;
        // var_dump($current_user);
        if($current_user){

        // var_dump($current_user);
        $records = exec_sql_query($myPDO, "SELECT mturk, question_id_sequence FROM user WHERE mturk='". $current_user. "'")->fetch(PDO::FETCH_ASSOC);

        $records2 = exec_sql_query($myPDO, "SELECT question_id FROM user_question_world_answer INNER JOIN user ON user.id = user_question_world_answer.user_id WHERE user.mturk='". $current_user. "'")->fetchAll();

        $A = explode(",",$records["question_id_sequence"]);
        var_dump($A);
        $B = count($records2);
        var_dump($B);
        $C = $A[$B-1];
        // var_dump($C);
        return $id_carrier=$C;
      }else{
        return null;
      }
      }

      if (isset($_POST['login'])) {
        $username = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
        $username = trim($username);
        $password = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
        $current_user = log_in($username, $password);
        $id_carrier = check_question_id();
        // var_dump($current_user);
      }else{
        $current_user = check_login();
        // var_dump($current_user);
        $id_carrier = check_question_id();
        // var_dump($id_carrier);
      }

?>
