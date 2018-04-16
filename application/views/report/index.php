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



		/*var options = {
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

		var chart = new google.charts.Bar(document.getElementById('chart_div'));
		chart.draw(data, options);*/


		var options = {
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
			width: 1000,
			height: 550,
			legend: { position: 'top', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
			isStacked: true
		};

		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, options);
	}
</script>