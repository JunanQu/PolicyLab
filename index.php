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


  ?>
  </head>

  <body>
  <?php include('includes/header.php')?>
  <div class="wrapper">

      <?php
      if (isset($_POST['login'])) {
      if($current_user){
        echo "<h1>Welcome back! You have answered question #".$id_carrier ." from last time! Would you like to continue?</h1>";
      } }else{
        echo '
        <div class="form">
        <h2>Login</h2>
        <form action="QuestionwithChart.php" method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" placeholder="Frist Last" required/>
        <label>mTurk Experiment Code</label>
        <input type="text" name="mTurk_code" placeholder="expCode" required />
        <button name="login" type="submit" value="LogIn">Log In</button>
        </form>
        ';
      }
      ?>


    </div>
  </div>
  <?php include('includes/footer.php')?>
  </body>
  </html>

</html>
