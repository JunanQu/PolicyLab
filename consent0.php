<!-- <?php include('includes/header.php')?> -->
<?php include('test2.php')?>
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
         You are eligible to participate in a research study.
         Please read this form carefully before you begin.
         </p>

        <p>
         You must be 18 years old or older to participate.You may print a copy of this
         page for your records.

         What the study is about: The purpose of this study is to understand how people
         evaluate their preferences for things.

         What we will ask you to do: If you agree to take part in this study, we will ask
         you to provide your preferences for different things (art, music etc) in an
         anonymous setting. You will provide your preference for 20 different items.
         This should take no more than 20 minutes.
         </p>


         <h1>
         Risks:
         </h1>
         <p>
         This study poses no risk whatsoever.
         </p>

         <h1>
         Compensation:
         </h1>
         <p>
         By participating in this game you will make $3.00.
         </p>
         <p>
         Taking part in this study is completely voluntary. If you decide to participate,
         you are free to withdraw at anytime and you are free to stop at any time for any
         reason.
         However, should you decide to withdraw, you will forfeit your payment.
         </p>

         <h1>
         Confidentiality:
         </h1>
         <p>Research records will be fully anonymized and stored in an encrypted file.
         Only the researchers will have access to the records. The records will not
         contain
         your name or any other personal information that could be used to identify you.
         In any report we make public, we will not include any information that will
         make it possible to identify you.
         </p>

         <h1>
         Questions:
         </h1>
         <p>
         The researchers conducting this study are Dr. Michael Macy and Ryan Torrie.
         If you have any questions about this research, you may reach Dr. Macy by email at
         mwm14@cornell.edu.
         </p>

         <p>
         Additionally, if you have any questions or concerns regarding your rights
         as a subject in this study, you may contact the Institutional
         Review Board at (607) 255-5138 or may access their website at
         <a href="http://www.irb.cornell.edu">http://www.irb.cornell.edu/</a>.
         You may also report your concerns or complaints
          anonymously through Ethicspoint (www.hotline.cornell.edu) or by calling toll
           free at 1-866-293-3077. Ethicspoint is an independent organization that serves
            as a liaison between the University and the person bringing the complaint so
            that anonymity can be ensured.
            </p>
       </p>
       <br><br>



       <?php

       if ( $curent_user_world_id['world'] == 1 ){
       echo'<form action="nochart.php" method="post">';
        }else{
       echo'<form action="newChart2.php" method="post">';
        }
       ?>
       <p><input type="checkbox" id="myCheck" onclick="javascript:enableButton();" >
         I have read the above information and consent to take part in the study.<br></p>


     <input type = "submit" class="button" id = "myButton" value = "I consent to participate" onclick="javascript:enableButton();"  >

     </form>


    </div>

  </body>
  </html>

</html>
