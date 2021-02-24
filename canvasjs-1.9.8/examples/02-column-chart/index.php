<!DOCTYPE HTML>
<?php

			$department = [{"y":"4913543","label":"dept1"},{"y":"66167","label":"dept2"},{"y":null,"label":"dept3"},{"y":null,"label":"dept4"},{"y":null,"label":"dept5"}];


			$arr = array();
			$i = 0;
			foreach($department as $row)
			{
				$arr[$i]['y'] = 25000;
				$arr[$i]['label'] = 'department 1';
				$i++; 
			}
			$department = json_encode($arr);
			$data['department'] = $department;
		
		?>
<html>
<head>
	
	<script type="text/javascript">
		window.onload = function () {
			var chart = new CanvasJS.Chart("chartContainer", {
				title: {
					text: "Basic Column Chart"
				},
				data: [{
					type: "column",
					dataPoints: <?=$department?>
				}]
			});
			chart.render();
		}
	</script>
	<script src="../../canvasjs.min.js"></script>
	<title>CanvasJS Example</title>
</head>

<body>
	<div id="chartContainer" style="height: 400px; width: 100%;"></div>
</body>

</html>