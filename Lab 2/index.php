<?php

$current_page_id="index";

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" media="all" />

  <!-- Adds the carousel to this file -->
  <link type="text/css" rel="stylesheet" href="styles/all.css" />
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>

  </head>

  <body>
   <!-- header -->
 	 <div class="header" id="myHeader">
  		<p2>Cornell University</p2>
  		<h2>Social Dynamic Lab</h2>
	</div>
  <div class="wrapper">

      <?php

        echo '
        <div class="form">
        <h1>Login</h1>
        <br>
        <form action="consent0.php" method="post">
        <label>Political Stand</label>
        <br>
        <select name="political_stand">
          <option value="Republicans">Democrats</option>
          <option value="Democrats">Republicans</option>
        </select>
        <br>
        <br>
        <label>mTurk Experiment Code</label>
        <br>
        <input type="text" name="mTurk_code" placeholder="expCode" required />
        <br>
        <br>
        <br>
        <button name="login" type="submit" value="LogIn">Log In</button>
        </form>

        ';
      ?>
      </div>


  </div>
  </body>
  </html>

</html>
