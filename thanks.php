
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="style/style.css" media="all" />


  <!-- function for "clicking checkbox to enable button" -->

  <script type="text/javascript">
function enableButton() {
	if(document.getElementById('myCheck').checked){
		document.getElementById('myButton').disabled='';
	} else {
		document.getElementById('myButton').disabled='true';
	}
}
</script>




  <!-- Adds the carousel to this file -->
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>
  </head>


  <body onload="enableButton();">


    <!-- header -->
 	 <div class="header" id="myHeader">
  		<p2>Cornell University</p2>
  		<h2>Social Dynamic Lab</h2>
	</div>


    <div class="wrapper" id="consent">
        <p>
         Dear Participant,
         <p>
           You have completed the survey. Thank you for your time and effort! Please contact the research team if you have any questions or concerns.
         </p>
       </p>
       <br><br>
    </div>

  </body>
  </html>

</html>
