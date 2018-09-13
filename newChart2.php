<?php
include('includes/header.php');
include('test2.php');
$dataPoints1 = array(
	array("label"=> "Democrats $support_rate_of_demo_percent% ", "y"=> $support_rate_of_demo_percent),
	array("label"=> "Republicans $support_rate_of_repub_percent%", "y"=> 0),
);

$dataPoints2 = array(
	array("label"=> "Democrats $support_rate_of_demo_percent% ", "y"=> $oppose_rate_of_demo_percent),
	array("label"=> "Republicans $support_rate_of_repub_percent%", "y"=> 0),
);

$dataPoints3 = array(
	array("label"=> "Democrats $support_rate_of_demo_percent% ", "y"=> 0),
	array("label"=> "Republicans $support_rate_of_repub_percent%", "y"=> $oppose_rate_of_repub_percent)
);

$dataPoints4 = array(
	array("label"=> "Democrats $support_rate_of_demo_percent% ", "y"=> 0),
	array("label"=> "Republicans $support_rate_of_repub_percent%", "y"=> $support_rate_of_repub_percent)
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
<form action="newChart2.php" method="post">
<button class = "supportbutton" name="support" type="submit" value="support">Support</button>
<button class = "opposebutton" name="oppose" type="submit" value="oppose">Oppose</button>
</form>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Current Support Rate of This Policy"
	},
	theme: "light2",
	animationEnabled: true,
	toolTip:{
		shared: false,
		reversed: false
	},
	interactivityEnabled: false,
	axisX: {
	labelFontSize: 30
	},
	axisY: {
		suffix: "%"
	},
	data: [
		{
			color:"#3357FF",
			type: "stackedColumn100",
			name: "Demo_Support",
			// showInLegend: true,
			// indexLabel: "#percent %",
			// indexLabelPlacement: "inside",
			indexLabelFontColor: "white",
			yValueFormatString: "$#,##0 K",
			dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},{
			color: "#E1F7FF",
			type: "stackedColumn100",
			name: "Demo_Against",
			// showInLegend: "true",
			// indexLabel: "#percent %",
			indexLabelPlacement: "inside",
			yValueFormatString: "$#,##0 K",
			dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
		},{
			color: "#FFCCBB",
			type: "stackedColumn100",
			name: "Republican_Support",
			// showInLegend: "true",
			// indexLabel: "#percent %",
			// indexLabelPlacement: "inside",
			yValueFormatString: "$#,##0 K",
			dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
		},{
			color: "red",
			markerBorderColor: "red",
			type: "stackedColumn100",
			name: "Republican_Against",
			// showInLegend: "true",
			// indexLabel: "#percent %",
			// indexLabelPlacement: "inside",
			yValueFormatString: "$#,##0 K",
			dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
		}
	]
});

chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
