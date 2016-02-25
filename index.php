<?php header("Refresh:30"); ?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <script src="js/Donut3D.js"></script>
	<script src="js/mis.js" language="JavaScript"></script>
	<script src="js/liquidFillGauge.js" language="JavaScript"></script>
</head>
    <style>
	table, td {
		border: 1px solid black;
	}
path.slice{
    stroke-width:2px;
}
polyline{
    opacity: .3;
    stroke: black;
    stroke-width: 2px;
    fill: none;
} 
svg text.percent{
    fill:white;
    text-anchor:middle;
    font-size:12px;
}


.liquidFillGaugeText { 
	font-family: Helvetica; font-weight: bold; color: black; 
}
#quotesDonut{
	style: block;
	align: center;
}
    
</style>
<body>
<?php include("nav.php"); ?>
<h1 class="text-center">Dashboard</h1>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testWestwind";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT DailyGoal, Day FROM Test";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $i=1;
	echo "<br/><table align='center' > <tr> ";
    while($row = $result->fetch_assoc()) {
		$goal=$row['DailyGoal'];
	$goalDate=$row['Day'];
        echo "<td > <a onclick='updateChart(this.name)' name=$goal>Check</a> $goalDate</td>";
		if ($i>=1){
			echo "</tr><tr>";
			$i=0;
		}
	$i++;
    }
} else {
    echo "<p>No Images to display something went wrong</p>";
}
echo "</tr></table><br/><br/><br/>";
$conn->close();
?>
<div class="row">
    <div class="container">
        <div class="col-md-4"></div>
            <div class="col-md-6 col-md-offset-6 right">
                <p class="right">
				
				<div id="svgGauge" style="block">
				<p>
				Weekly Goal</br>
			<svg id="fillgauge1" viewbox="100 100 70% 20%" </svg>
			</p>
			</div>
				
                <script language="javascript">
				// Pie Chart Code
                var salesData=[
                    {label:"Basic", color:"#3366CC"},
                    {label:"Plus", color:"#DC3912"},
                    {label:"Lite", color:"#FF9900"},
                    {label:"Elite", color:"#109618"},
                    {label:"Delux", color:"#990099"}
                ];

                var svg = d3.select("body").append("svg").attr("width",700).attr("height",300);

                svg.append("g").attr("id","salesDonut");
                svg.append("g").attr("id","quotesDonut");

                Donut3D.draw("salesDonut", randomData(), 0, 0, 0,0,0, 0.4);
                Donut3D.draw("quotesDonut", randomData(), 450, 150, 130, 100, 30, 0);
                    
                function changeData(){
                    Donut3D.transition("salesDonut", randomData(), 130, 100, 30, 0.4);
                    Donut3D.transition("quotesDonut", randomData(), 130, 100, 30, 0);
                }
				function hideSVG(){
					
					document.getElementById('svgGauge').style.visibility = 'hidden';
					
				}
				function showSVG(){
					
					document.getElementById('svgGauge').style.visibility = 'visible';
					
				}
				

                function randomData(){
                    return salesData.map(function(d){ 
                        return {label:d.label, value:1000*Math.random(), color:d.color};});
                }
				
				//Fill Gauge Code
	var gValue1 = NewValue();
    var gValue2 = 90;
    var config1 = liquidFillGaugeDefaultSettings();
    config1.circleColor = "#000000";
    config1.textColor = "#000000";
    config1.waveTextColor = "FFAAAA";
    config1.waveColor = colorChange();
    config1.circleThickness = .05;
    config1.textVertPosition = 0.2;
    config1.waveAnimateTime = 1000;
    var gauge1 = loadLiquidFillGauge("fillgauge1", gValue1, config1);
    var config2 = liquidFillGaugeDefaultSettings();
    config2.circleColor = "#D4AB6A";
    config2.textColor = "#553300";
    config2.waveTextColor = "#805615";
    config2.waveColor = colorChange();
    config2.circleThickness = 0.1;
    config2.circleFillGap = 0.2;
    config2.textVertPosition = 0.8;
    config2.waveAnimateTime = 1000;
    config2.waveHeight = 0.3;
    config2.waveCount = 1;
    var gauge2= loadLiquidFillGauge("fillgauge2", gValue1, config2);

    function colorChange(){
        if (gValue1 <= 40) {
            return config1.waveColor = "Red";
            return config2.waveColor = "Red";
        }
        else if (gValue1 > 40 && gValue1 <= 60) {
            return config1.waveColor = "Yellow";
            return config2.waveColor = "Yellow";
        }
        else if (gValue1 > 60 && gValue1 <= 100){
            return config1.waveColor = "Green";
            return config2.waveColor = "Green";
        }
    }
    
    function reload(){
            var container = document.getElementById("fillgauge1");
            var content = container.innerHTML;
            container.innerHTML= content;
            var container2 = document.getElementById("fillgauge2");
            var content2 = container2.innerHTML;
            container2.innerHTML= content2;
        }
	function NewValue(){
		return gValue1 = <?php echo $goal; ?>;
		
		colorChange();
		reload();
        }
	/*<!--function updateChart(int goal){
		
		<?php $conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT DailyGoal FROM Test Where DailyGoal = goal" ;
$result = $conn->query($sql);
if ($result->num_rows =0) {
    while($row = $result->fetch_assoc()) {
		$goal=$row['DailyGoal'];
		
	}
}
	else {
    echo "<p>No data to display something went wrong</p>";
}
$conn->close();
?>
	return gValue1 = <?php echo $goal; ?>
	colorChange();
		reload();
	}-->*/
        </script>
            </p>
			
                
            </div>
			<button onClick="changeData()" >Change Data</button>
			<button onClick="hideSVG()">Hide</button>
			<button onClick="showSVG()">Show</button>
        </div>
    </div>
</div>
</body>
