<?php
include('includes/header.php');
include('test2.php');
$dataPoints = array(
	array("y" => 100*$support_rate_of_demo, "label" => "Democrats $support_rate_of_demo_percent% " ),
	array("y" => 100*$support_rate_of_repub, "label" => "Republicans $support_rate_of_repub_percent% "  ),

);

?>
<!DOCTYPE HTML>
<html>
<head>
<link href="styles/all.css" rel="stylesheet" type="text/css"  />
<p class="question_text">
<?php
$records = exec_sql_query($myPDO, "SELECT question_content FROM questions WHERE questions.id ='". $id_carrier."'")->fetch(PDO::FETCH_ASSOC);
echo($records['question_content']);
?>
</p>
<form action="newChart.php" method="post">
<button class = "supportbutton" name="support" type="submit" value="support">Support</button>
<button class = "opposebutton" name="oppose" type="submit" value="oppose">Oppose</button>
</form>

<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light3",
	title:{
		text: "Current Support Rate"
	},
	axisX:{
	labelFontSize: 30
	},
	axisY: {
		title: "Percentage",
    maximum: 100,
    suffix: "%"
	},
	data: [{
		type: "column",
		yValueFormatString: "#/100%",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}

</script>

</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%; margin-bottom:20%; position:static;" ></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
