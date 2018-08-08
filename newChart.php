<?php include('test2.php');

$current_page_id="index";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="styles/style2.css" media="all" />

  <!-- Adds the carousel to this file -->
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>
  </head>



  <body onload="enableButton();">


    <!-- header -->
 	 <div class="header" id="myHeader">
  		<p2>Cornell University</p2>
  		<h2>Social Dynamic Lab</h2>
	</div>


    <div class="wrapper" id="question" >

         <h1>

         </h1>
         <p>
         Question text:
         <?php
         $records = exec_sql_query($myPDO, "SELECT question_content FROM questions WHERE questions.id ='". $id_carrier."'")->fetch(PDO::FETCH_ASSOC);
         echo($records['question_content']);
         ?>
         </p>


         <div class="background" >


         <!--change the height of the bar on D-Chart and R-Chart file--!>
         <img class="rep-chart" src="R_chart.php"/></img>
         <img class="demo-chart" src="D_chart.php"/></img>

         </img>



        <div class="line"/> </div>



         <!--the number of people support/disaprove the policy shown at the graph--!>

            <?php
               $rep_appro = 30;
               $rep_oppo = 30;

               $demo_appro = 30;
               $demo_oppo = 30;
               echo "<rep-approve> $rep_appro </rep-approve>";
               echo "<rep-oppose> $rep_oppo </rep-oppose>";

               echo "<demo-approve> $rep_appro </demo-approve>";
               echo "<demo-oppose> $rep_oppo </demo-oppose>";
               ?>




          <!--click the grey square to select the choice, can change the opacity in style.css--!>
           <form action="newChart.php" method="post">
           <button name="support" type="submit"  value="support" class="support"></button>
         </form>
         <form action="newChart.php" method="post">
         <button  class="oppose" name="oppose" type="submit"  value="oppose" class="oppose"></button>
        </form>



         <!--the percentage of people support the policy shown at the bottom of the graph--!>
            <?php
               $rep = 50;
               $demo = 50;
               echo "<h3> $demo% </h3>";
               echo "<h4> $rep% </h4>";
               ?>

           </div>


 		 <br>
         <br>
         <br>



    </div>

  </body>
  </html>

</html>
