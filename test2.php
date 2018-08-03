<?php
    $myPDO = new PDO('pgsql:host=firsttest.camwsondhmqr.us-east-2.rds.amazonaws.com; port=5432 dbname=firsttest', 'Junan', 'Qja1998+0325');
    // $result = $myPDO->query("SELECT * FROM Countries")->fetchAll();
    $myPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $myPDO_init_sql = file_get_contents('init/init_P.sql');
    $result = $myPDO->exec($myPDO_init_sql);

    exec_sql_query($myPDO, "INSERT INTO  users (id, turk_id) VALUES ( 5, 'E')");

    $result = exec_sql_query($myPDO, "SELECT * FROM users")->fetchAll();

    var_dump($result);

    function random_question_order_generator(){
      $array = [];

      while( count($array) < 20 ){
      $rand = mt_rand(1,20);
      $array[$rand] = $rand;
      }

      return $array;
    }
    $new=random_question_order_generator();
    var_dump($new);


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

        $sql = "SELECT * FROM users WHERE session = :session_id;";
        $params = array (
          ":session_id" => $session,
        );
        $records = exec_sql_query($myPDO, $sql, $params)->fetchAll();
        if ($records) {
          $user = $records[0];
          return $user["turk_id"];
        }
      }
      return NULL;
    }

    function log_in($name,$mturk){
      global $myPDO;
      global $current_user;
      $existed = false;
      if (isset($_POST["login"])) {
          $user_full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
          $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
          $user_ip = htmlspecialchars(getRealIpAddr());

          $full_list_of_users = exec_sql_query($myPDO, "SELECT turk_id FROM users")->fetchAll();
          $reorganized_users=array();
          foreach ($full_list_of_users as $user_seperate){
            array_push($reorganized_users,$user_seperate[0]);
          };
          // foreach ($full_list_of_users as $individual){
          //   if ($individual[0] == $user_mTurk_code) {
              // var_dump($individual[0]);
              if (in_array($user_mTurk_code,$reorganized_users)){
              echo "this is not a new user";
              $session = uniqid();
              var_dump($session);
              $sql = "UPDATE users SET session = :session WHERE  users.turk_id = :user_turk;";
              $params = array (
                ":user_turk" => $user_mTurk_code,
                ":session" => $session
              );
              $result = exec_sql_query($myPDO, $sql, $params);
              if ($result) {
                setcookie("session", $session, time()+3600);
                // $sql= "SELECT question_id FROM user_question_world_answer INNER JOIN users ON users.id=user_question_world_answer.user_id  WHERE users.turk_id  LIKE  '%' || :currentuser || '%'";
                // $params = array (
                // ":currentuser" => $user_mTurk_code,
                // );
                $sql = "SELECT question_id_sequence FROM user_question_order INNER JOIN users ON users.id = user_question_order.user_id WHERE users.turk_id  LIKE  '%' || :currentuser || '%'";
                $params = array (
                ":currentuser" => $user_mTurk_code,
                );
                $records = exec_sql_query($myPDO, $sql, $params);
                foreach ($records as $record) {
                  $record = explode(",",$record[0]);
                }
                $id_carrier = $record[(count($record)-1)];
                // var_dump($record[(count($record)-1)]);
                return $current_user= $user_mTurk_code;

            }
          }else{
                echo "THIS IS A NEW USER";
                $sql1 = "INSERT INTO users (name, turk_id, user_ip) VALUES (:full_name, :turk_id, :user_ip);";
                $params1 = array(
                  ':full_name' => $user_full_name,
                  ':turk_id' => $user_mTurk_code,
                  ':user_ip' => $user_ip
                );
                $record1 = exec_sql_query($myPDO, $sql1, $params1);
                // ---------------------------------------
                $session = uniqid();
                var_dump($session);
                $sql = "UPDATE users SET session = :session WHERE  users.turk_id = :user_turk;";
                $params = array (
                  ":user_turk" => $user_mTurk_code,
                  ":session" => $session
                );
                $records = exec_sql_query($myPDO, $sql, $params);
                if($records){
                  setcookie("session", $session, time()+3600);
                }
                // ---------------------------------------

                $sql2 = "SELECT id FROM users WHERE turk_id LIKE :turk_id";
                $params2 = array(
                  ':turk_id' => $user_mTurk_code,
                );
                $record2 = exec_sql_query($myPDO, $sql2, $params2)->fetch(PDO::FETCH_ASSOC);
                $current_user_id = $record2['id'];
                // var_dump($current_user_id);

                // ---------------------------------------

                // I need to echo out user_id from 'users' table and cast that into a variable for next sql comman
                $sql3 = "INSERT INTO user_question_order(user_id,question_id_sequence) VALUES (:user_id, :question_seq);";
                $params3 = array(
                  ':user_id' => $current_user_id,
                  ':question_seq' => "4,5,3,2,1"
                );
                $record = exec_sql_query($myPDO, $sql3, $params3);
                $current_user= $user_mTurk_code;
                // var_dump($current_user);
                $user_id = $myPDO->lastInsertId("id");
                return $current_user;
          }
        }
      }

      function check_question_id(){
        global  $myPDO;
        global $current_user;
        var_dump($current_user);
        if($current_user){
        $sql = "SELECT question_id_sequence FROM user_question_order INNER JOIN users ON users.id = user_question_order.user_id WHERE users.turk_id  LIKE  '%' || :currentuser || '%'";
        $params = array (
        ":currentuser" => $current_user,
        );
        $records = exec_sql_query($myPDO, $sql, $params);
        $sql2 = "SELECT question_id FROM user_question_world_answer INNER JOIN users ON users.id = user_question_world_answer.user_id WHERE users.turk_id LIKE '%' || :currentuser || '%'";
        $params2 = array (
        ":currentuser" => $current_user,
        );
        $records2 = exec_sql_query($myPDO, $sql2, $params2);
        foreach ($records as $record){}
          $A = explode(",",$record[0]);
          $user_answered=array();
          foreach ($records2 as $record2){
            array_push($user_answered,$record2[0]);
          }
          // var_dump($A);
          // var_dump($user_answered);
          // var_dump($user_answered[count($user_answered)-1]);
          return $id_carrier=$user_answered[count($user_answered)-1];
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
      }else{
        $current_user = check_login();
        $id_carrier = check_question_id();
        var_dump($id_carrier);
      }

?>
