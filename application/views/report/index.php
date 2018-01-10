<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::script('media/js/loader.js')?>

<div id="chart_div"></div>

<script>
	google.charts.load('current', {packages: ['corechart', 'bar'], 'language': 'ru'});
	google.charts.setOnLoadCallback(drawMaterial);

	function drawMaterial() {
		var data = google.visualization.arrayToDataTable([
			['Округа', '2015', '2016'],
			['СВАО', 5175000, 5008000],
			['САО', 3792000, 3694000],
			['ЗАО', 2695000, 2896000],
			['ЦАО', 2099000, 1953000],
			['ЮАО', 1526000, 1517000]
		]);

		var materialOptions = {
			chart: {
				title: 'Название'
			},
			hAxis: {
				title: 'Года',
				minValue: 0
			},
			vAxis: {
				title: 'Округа'
			},
			bars: 'horizontal'
		};
		var materialChart = new google.charts.Bar(document.getElementById('chart_div'));
		materialChart.draw(data, materialOptions);
	}
</script>