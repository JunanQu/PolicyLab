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

    function random_world_generator(){
      $rand = mt_rand(1,9);

      return $rand;
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
      global $current_user;
      // var_dump($current_user, $_COOKIE["session"]);
      if (isset($_COOKIE["session"])) {
        $session = $_COOKIE["session"];

        $sql = "SELECT * FROM user WHERE session ='$session'";
        $records = exec_sql_query($myPDO, $sql)->fetch(PDO::FETCH_ASSOC);;
        if ($records) {
          $user = $records['mturk'];
          return $user;
        }
      }
      return NULL;
    }

    function log_in($name,$mturk){
      global $myPDO;
      global $current_user;
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
              // $session = uniqid();
              $session = exec_sql_query($myPDO, "SELECT session FROM user WHERE mturk = '". $user_mTurk_code. "'")->fetch(PDO::FETCH_ASSOC);
              // $result = exec_sql_query($myPDO, "UPDATE user SET session = '". $session. "' WHERE  user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
              // // var_dump($result);
              setcookie("session", $session['session']);
              $_COOKIE["session"] = $session['session'];
                // $records = exec_sql_query($myPDO, "SELECT question_id_sequence FROM user WHERE mturk='". $user_mTurk_code. "'")->fetch(PDO::FETCH_ASSOC);
                // var_dump($records);
                // $record = explode(",",$records['question_id_sequence']);
                //
                // $id_carrier = $record[(count($record)-1)];
                // var_dump($record[(count($record)-1)]);
                // var_dump($current_user);
                // return $current_user= $user_mTurk_code;
            check_login();
            return $current_user= $user_mTurk_code;
          }else{
                $current_user = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
                $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
                $user_political = "Default_Democrat";
                $_SESSION['login_user']= $user_mTurk_code;
                echo "THIS IS A NEW USER";
                var_dump($user_mTurk_code,$user_political);
                $result = exec_sql_query($myPDO, "INSERT INTO user (mturk, political_stand, question_id_sequence) VALUES ('$user_mTurk_code', '$user_political', '$new_question_order')");
                var_dump($result);
                $session = uniqid();
                // var_dump($session);
                $records = exec_sql_query($myPDO, "UPDATE user SET session = '". $session. "' WHERE  user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
                $session = exec_sql_query($myPDO, "SELECT session FROM user WHERE mturk = '". $user_mTurk_code. "'")->fetch(PDO::FETCH_ASSOC);

                setcookie("session", $session['session']);

                // ---------------------------------------

                $record2 = exec_sql_query($myPDO, "SELECT id FROM user WHERE user.mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
                $current_user_id = $record2['id'];
                // var_dump($current_user_id);
                $world = random_world_generator();

                exec_sql_query($myPDO, "UPDATE user SET world = '$world' WHERE mturk = '". $current_user. "'");
                $current_user= $user_mTurk_code;
                var_dump($current_user);
                check_login();
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

        $records2 = exec_sql_query($myPDO, "SELECT question_id FROM user_question_world_answer  WHERE user_id='". $current_user. "'")->fetchAll();

        $A = explode(",",$records["question_id_sequence"]);
        // var_dump($A);
        $B = count($records2);
        var_dump($records2);
        $C = $A[$B];
        exec_sql_query($myPDO, "UPDATE user SET current_question = '". $C. "' WHERE user.mturk = '". $current_user. "'");
        if($records){
        return $id_carrier=$C;
      }else{
        return null;
      }
      }
}
      if (isset($_POST['login'])) {
        $username = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
        $username = trim($username);
        $password = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
        $current_user = log_in($username, $password);
        $id_carrier = check_question_id();
        $curent_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
        $current_user_world_id = $curent_user_world_id['world'];
        var_dump($current_user,$id_carrier);
        if (isset($_POST['support'])){
          $user_answer = "support";
          // $current_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
          // $current_user_world_id = $curent_user_world_id['world'];
          var_dump($current_user,$id_carrier,$curent_user_world_id);
          exec_sql_query($myPDO, "INSERT INTO user_question_world_answer (user_id, world_id, question_id, user_response) VALUES ('$current_user', '$current_user_world_id', '$id_carrier', 'support') ");
          $current_user = check_login();
          $id_carrier = check_question_id();
        }
        if (isset($_POST['oppose'])){
          $user_answer = "oppose";
          // $current_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
          // $current_user_world_id = $curent_user_world_id['world'];
          exec_sql_query($myPDO, "INSERT INTO user_question_world_answer (user_id, world_id, question_id, user_response) VALUES ('$current_user', '$current_user_world_id', '$id_carrier', 'support') ");
          $current_user = check_login();
          $id_carrier = check_question_id();
        }
        // var_dump($current_user);
      }else{
        $current_user = check_login();
        $id_carrier = check_question_id();
        $current_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
        $current_user_world_id = $current_user_world_id['world'];
        var_dump($current_user_world_id['world']);
        if (isset($_POST['support'])){
          $user_answer = "support";
          // $curent_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
          // $curent_user_world_id = $curent_user_world_id['world'];
          var_dump($current_user,$id_carrier,$current_user_world_id);
          exec_sql_query($myPDO, "INSERT INTO user_question_world_answer (user_id, world_id, question_id, user_response) VALUES ('$current_user', '$current_user_world_id', '$id_carrier', 'support') ");
          $current_user = check_login();
          $id_carrier = check_question_id();
        }
        if (isset($_POST['oppose'])){
          $user_answer = "oppose";
          // $current_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
          // $current_user_world_id = $curent_user_world_id['world'];
          var_dump($current_user,$id_carrier,$current_user_world_id);
          exec_sql_query($myPDO, "INSERT INTO user_question_world_answer (user_id, world_id, question_id, user_response) VALUES ('$current_user', '$current_user_world_id', '$id_carrier', 'support') ");
          $current_user = check_login();
          $id_carrier = check_question_id();
        }
        // var_dump($id_carrier);
      }

      // if (isset($_POST['support'])){
      //   $user_answer = "support";
      //   $current_user = check_login();
      //   $id_carrier = check_question_id();
      //   $curent_user_world_id = exec_sql_query($myPDO, "SELECT world FROM user WHERE mturk = '". $current_user. "'")->fetch(PDO::FETCH_ASSOC);
      //   $curent_user_world_id = $curent_user_world_id['world'];
      //   var_dump($current_user,$id_carrier,$curent_user_world_id);
      //   exec_sql_query($myPDO, "INSERT INTO user_question_world_answer (user_id, world_id, question_id, user_response) VALUES ('$current_user', '$curent_user_world_id', '$id_carrier', 'support') ");
      // }
      var_dump($current_user_world_id,$id_carrier);
      $a=exec_sql_query($myPDO, "SELECT * FROM user_question_world_answer WHERE (question_id = '$id_carrier' AND user_response = 'support' AND world_id = '$current_user_world_id')");
      var_dump($a);
      $b=1/count($a);
      // $percent_friendly = number_format( $b * 100, 2 ) . '%';
      var_dump($b);
?>
