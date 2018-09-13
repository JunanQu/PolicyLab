<?php
include('includes/header.php');
include('test2.php');
$dataPoints = array(
	array("y" => 100*$support_rate_of_demo, "label" => "Democrats" ),
	array("y" => 100*$support_rate_of_repub, "label" => "Republican" ),

);

?>
<!DOCTYPE HTML>
<html>
<head>
<link href="styles/all.css" rel="stylesheet" type="text/css"  />
<div class="no_chart_question_text">
<p >
<?php
$records = exec_sql_query($myPDO, "SELECT question_content FROM questions WHERE questions.id ='". $id_carrier."'")->fetch(PDO::FETCH_ASSOC);
echo($records['question_content']);
?>
</p>
</div>
<form action="nochart.php" method="post">
<button class = "supportbutton" name="support" type="submit" value="support">Support</button>
<button class = "opposebutton" name="oppose" type="submit" value="oppose">Oppose</button>
</form>

</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%; margin-bottom:20%; position:static;" ></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
