<?php include('includes/init.php');

$current_page_id="index";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" media="all" />

  <!-- Adds the carousel to this file -->
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>
  </head>


  <body onload="enableButton();">
   
   
    <!-- header -->
 	 <div class="header" id="myHeader">
  		<p2>Cornell University</p2>
  		<h2>Social Dynamic Lab</h2>
	</div>
   
   
    <div class="wrapper" id="question">
       
         <h1>
         Question Title 
         </h1>
         <p>
         Question text
         </p>
         
         <img src="style/artboard2.jpg" alt="chart" style="width:100%;height:60%;">
         
         
         <img  class="demo-chart" src="style/blue.png" style="width:8%; height:22.2%;">
         <img  class="rep-chart" src="style/red.png" style="width:8%; height:22.2%;">
           <div class="line"></div>


           <div class="demo-approve">30</div>
           <div class="demo-oppose">30</div>
           
           <div class="rep-approve">30</div>
           <div class="rep-oppose">30</div>

           

           
           

           <a href="google.com">
           <div class="support"></div>
           </a>
           <a href="google.com">
           <div class="oppose"></div>
           </a>
           
           <h3 style =" position: absolute; bottom: 20px; left: 550px; color:#D0021B">50%</h3>
           <p style =" position: absolute; bottom: 0px; left: 525px; color:#D0021B"> Support this policy</p>
           
           <h3 style =" position: absolute; bottom: 20px; left: 770px; color:#4A90E2">50%</h3>
           <p style =" position: absolute; bottom: 0px; left: 745px; color:#4A90E2"> Support this policy</p>
           



 		 <br>
         <br>
         <br>
	<!--
     <input type = "button"  class="button" id = "support" value = "Support" >
     <br>
     <input type = "button"  class="button" id = "Decline" value = "Decline" >
     --!>




    </div>

  </body>
  </html>

</html>
