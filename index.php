<?php include('includes/init.php');

$current_page_id="index";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <!-- Adds the carousel to this file -->
  <link type="text/css" rel="stylesheet" href="styles/all.css" />
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>
  <?php

  if (isset($_POST["login"])) {
      $user_full_name = filter_input(INPUT_POST, 'full_name', FILTER_SANITIZE_STRING);
      $user_mTurk_code = filter_input(INPUT_POST, 'mTurk_code', FILTER_SANITIZE_STRING);
      $user_ip = htmlspecialchars(getRealIpAddr());

      $sql = "INSERT INTO users (name, turk_id, user_ip) VALUES (:full_name, :turk_id, :user_ip);";
      $params = array(
        ':full_name' => $user_full_name,
        ':turk_id' => $user_mTurk_code,
        ':user_ip' => $user_ip
      );
      $result = exec_sql_query($db, $sql, $params);
      if ($result) {
        $user_id = $db->lastInsertId("id");
      } else {
        record_message("Failed to log in.");
      }
  }
  ?>
  </head>

  <body>
  <?php include('includes/header.php')?>
  <div class="wrapper">
    <h2>Login</h2>
    <div class="form">
        <form action="index.php" method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Frist Last" required/>
        <label>mTurk Experiment Code</label>
        <input type="text" name="mTurk_code" placeholder="expCode" required />
        <button name="login" type="submit" value="LogIn">Log In</button>
      </form>

    </div>
  </div>
  <?php include('includes/footer.php')?>
  </body>
  </html>

</html>
