<?php include('includes/header.php')?>
<?php include('test2.php')?>

<!DOCTYPE html>
<html>
<head>
<link href="styles/all.css" rel="stylesheet" type="text/css"  />

<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
  <title>Social Dynamic Lab-Policy Lab Pilot Testing</title>


<style>

.code-block-holder pre {
      max-height: 188px;
      min-height: 188px;
      overflow: auto;
      border: 1px solid #ccc;
      border-radius: 5px;
}


.tab-btn-holder {
	width: 100%;
	margin: 20px 0 0;
	border-bottom: 1px solid #dfe3e4;
	min-height: 30px;
}

.tab-btn-holder a {
	background-color: #fff;
	font-size: 14px;
	text-transform: uppercase;
	color: #006bb8;
	text-decoration: none;
	display: inline-block;
	*zoom:1; *display:inline;


}

.tab-btn-holder a.active {
	color: #858585;
    padding: 9px 10px 8px;
    border: 1px solid #dfe3e4;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    position: relative;
    z-index: 300;
}

</style>

</head>
<body>
<div>
<?php echo "<h1>Hello, ".$current_user."!"; ?>
<?php echo "<h1>This is Question  ".$id_carrier."!"; ?>
<p>
<?php
$records = exec_sql_query($myPDO, "SELECT question_content FROM questions WHERE questions.id ='". $id_carrier."'")->fetch(PDO::FETCH_ASSOC);
echo($records['question_content']);


?>
</p>
</div>

<?php
echo ('<div id="chart-1"><!-- Fusion Charts will render here--></div>
<form action="QuestionwithChart_mysql.php" method="post">
<button name="support" type="submit" value="support">Support</button>
<button name="oppose" type="submit" value="oppose">Oppose</button>
</form>');
// Including the wrapper file in the page
include("includes/fusioncharts.php");

$columnChart = new FusionCharts("column2d", "ex1" , 600, 400, "chart-1", "json", '{
      "chart": {
        "caption": "Question Title",
        "subCaption": "question text",

        "rotatevalues": "0",
        "numberSuffix": "%",

        "plotToolText": "<div><b>$label</b><br/>Support Percentage : <b>$value</b>%</div>",
        "theme": "ocean"
      },
      "data": [{
        "label": "Democrats",
        "value": "90"
      }, {
        "label": "Republicans",
        "value": "33"
      }]
    }');
// Render the chart
$columnChart->render();
?>


</body>
</html>
