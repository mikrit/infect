<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<?=HTML::script('media/js/loader.js')?>

<div class="row">
	<?=Form::open('report', array('id'=>'f1'))?>
		<div id="sidebar-left" class="col-sm-5 col-md-4 col-lg-4">
			<ul class="nav navmenu-nav">
				<li>
					<?=HTML::anchor('report', 'Инф служба', array('class' => 'tabs', 'id' => 'info'));?>
				</li>
				<li>
					<?=HTML::anchor('report', 'Стац помощь', array('class' => 'tabs', 'id' => 'stachelp'));?>
				</li>
				<li>
					<?=HTML::anchor('report', 'Амбулат помощь', array('class' => 'tabs', 'id' => 'ambulathelp'));?>
				</li>
				<li>
					<?=HTML::anchor('report', 'СПИД-центры', array('class' => 'tabs', 'id' => 'spid'));?>
				</li>
				<li>
					<?=HTML::anchor('report', 'КДЦ', array('class' => 'tabs', 'id' => 'kdc'));?>
				</li>
				<li>
					<?=HTML::anchor('report', 'Вирусные гепатиты', array('class' => 'tabs', 'id' => 'gepatid'));?>
				</li>
			</ul>

			<div class="form-group" style="padding-left: 0px;">
				<label>Название:</label>
				<?=Form::input('title', '', array('class' => 'form-control', 'id' => 'title'));?>
			</div>

			<div class="form-group" style="padding-left: 0px;">
				<label>Графики</label>
				<select name="charts" id="charts" class="form-control" >
					<option value="0">Гистограмма</option>
					<!--<option value="1">Гистограмма с накоплением</option>
					<option value="2">Линейная гистограмма</option>
					<option value="3">Круговая диаграмма по округам</option>
					<option value="4">Круговая диаграмма по категориям</option>-->
				</select>
			</div>

			<div class="form-group col-lg-6" style="padding-left: 0px;">
				<label>Года с:</label>
				<?=Form::select('year_begin', $years, $r_year_begin, array('class' => 'form-control', 'id' => 'year_begin'));?>
			</div>

			<div class="form-group col-lg-6" style="padding-left: 0px;">
				<label>по:</label>
				<?=Form::select('year_end', $years, $r_year_end, array('class' => 'form-control', 'id' => 'year_end'));?>
			</div>

			<?=Form::input('button', 'Построить', array('class' => 'btn btn-primary', 'type'=>'submit'));?>
		</div>

		<div id="panel" class="col-sm-7 col-md-8 col-lg-8 container" >
			<?=$list?>
		</div>
	<?=Form::close()?>
</div>

<script>
	$('#charts').val(0).trigger('change');
	$('#year_end').prop("disabled", false);
	$('.chek').prop("checked", false);
	$('.chek').prop("disabled", false);

	$('#f1').on('change', '#charts', function(){
		$('.chek').prop("checked", false);

		if($(this).val() == 3 || $(this).val() == 4)
		{
			$('#year_end').prop("disabled", true);
			if($(this).val() == 4)
			{
				$('.chek').prop("disabled", false);
				count = 0;
			}
		}
		else
		{
			$('#year_end').prop("disabled", false);
			$('.chek').prop("disabled", false);
			count = 0;
		}
	});

	var count = 0;

	$('#f1').on('click', '.chek', function(){
		var id = $(this).attr('id');
		var chart_id = $('#charts').val();

		if(chart_id == 3)
		{
			if($(this).prop( "checked" ))
			{
				$('.chek').prop("disabled", true);
				$('#'+id).prop("disabled", false);
			}
			else
			{
				$('.chek').prop("disabled", false);
				count = 0;
			}
		}

		if($(this).prop( "checked" ))
		{
			count++;
		}
		else
		{
			count--;
		}
	});

	$('.tabs').click(function (){
		var table = $(this).attr('id');

		$.ajax({
			type: "POST",
			url: "/ajax/change_data_report",
			dataType: "json",
			data: {
				table: table
			},
			success: function(data){
				$('#panel').html(data.panel);
			}
		});

		return false;
	});

	google.charts.load('current', {packages: ['corechart', 'bar'], 'language': 'ru'});
	google.charts.setOnLoadCallback(drawMaterial);

	$('#f1').submit(function (){
		var data = $("#f1").serializeArray();

		var title = $('#title').val();

		if(count == 0)
		{
			alert('Не выбрано ни одной категории');
		}
		else if(title == '')
		{
			alert('Введине название');
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "/ajax/get_data_chart",
				dataType: "json",
				data: {
					data: data
				},
				success: function(data){
					var dat = google.visualization.arrayToDataTable(data.data);

					var options = {
						chart: {
							title: data.title
						},
						width: 900,
						height: 550
					};

					var chart = new google.charts.Bar(document.getElementById('panel'));
					chart.draw(dat, google.charts.Bar.convertOptions(options));
				}
			});
		}

		return false;
	});



	function drawMaterial(dd) {
		/*google.charts.load('current', {packages: ['corechart', 'bar'], 'language': 'ru'});
		google.charts.setOnLoadCallback(drawMaterial);

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
			bars: 'horizontal'
		};

		var chart = new google.charts.Bar(document.getElementById('chart_div'));
		chart.draw(data, options);*/

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
			width: 1000,
			height: 550,
			legend: { position: 'top', maxLines: 3, textStyle: {color: 'black', fontSize: 16 } },
			isStacked: true
		};*/

		//var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		//chart.draw(data, options);
	}
</script>