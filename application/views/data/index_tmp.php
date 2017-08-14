<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#myTab a").click(function(e){
			e.preventDefault();
			$(this).tab('show');
		});
	});
</script>

<ul id="myTab" class="nav nav-tabs">
	<li class="active"><a href="#panel1">Инфекционная заболеваемость</a></li>
	<li><a href="#panel2">Инф служба </a></li>
	<li><a href="#panel3">Стац помощь</a></li>
	<li><a href="#panel4">СПИД-центры</a></li>
	<li><a href="#panel5">Амбулат помощь</a></li>
	<li><a href="#panel6">КДЦ</a></li>
	<li><a href="#panel7">Вирусные гепатиты</a></li>
</ul>

<div id="f_1">
	<?=Form::open('data', array('method'=>'post', 'name' => 'form'))?>
		<div class="form-group">
			<label>Год:</label>
			<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>

			<?if($user_district == 0){?>
				<label>Округ РФ:</label>
				<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'id' => 'district'));?>
			<?}?>
			<?if($user_subject == 0){?>
				<label>Субъект РФ:</label>
				<div id="subjects">
					<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'id' => 'subject'));?>
				</div>
			<?}?>
		</div>
	<?=Form::close()?>
</div>

<div class="tab-content">
	<div id="panel1" class="tab-pane fade in active">
		<?=$panel1?>
	</div>
	<div id="panel2" class="tab-pane fade">
		<?=$panel2?>
	</div>
	<div id="panel3" class="tab-pane fade">
		<?=$panel3?>
	</div>
	<div id="panel4" class="tab-pane fade">
		<?=$panel4?>
	</div>
	<div id="panel5" class="tab-pane fade">
		<?=$panel5?>
	</div>
	<div id="panel6" class="tab-pane fade">
		<?=$panel6?>
	</div>
	<div id="panel7" class="tab-pane fade">
		<?=$panel7?>
	</div>
</div>

<script>
	$('select').select2({
		language: "ru",
		width: '100%'
	});

    $("#district").change(function(){
	    var district_id = $(this).val();

	    $.ajax({
		    type: "POST",
		    url: "/ajax/change_district2",
		    dataType: "json",
		    data: {
			    district_id: district_id
		    },
		    success: function(data){
			    $('#subjects').html(data.result);
		    }
	    });
    });

	$("#f_1").on('change', '#year', function(){
		var year = $(this).val();
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		$.ajax({
			type: "POST",
			url: "/ajax/change_data_year",
			dataType: "json",
			data: {
				year: year,
				district_id: district_id,
				subject_id: subject_id
			},
			success: function(data){
				$('#panel1').html(data.panel1);
			}
		});
	});

	$("#test").on('change', '.change', function(){
		var year = $('#year').val();
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		$.ajax({
			type: "POST",
			url: "/ajax/change_data",
			dataType: "json",
			data: {
				year: year,
				district_id: district_id,
				subject_id: subject_id
			},
			success: function(data){

			}
		});
	});

	$("#panel1").on('change', '.infect', function(){
		var year = $('#year').val();
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		var elem_id = $(this).attr('id');
		var infect_id = $(this).data('id');
		var type = $(this).data('type');

		if(isNaN($(this).val()))
		{
			$('#'+elem_id).css('border-color', 'red');
		}
		else
		{
			$('#'+elem_id).css('border-color', '');

			$.ajax({
				type: "POST",
				url: "/ajax/infect_element",
				dataType: "json",
				data: {
					infect_id: infect_id,
					value: $('#'+elem_id).val(),
					year: year,
					district_id: district_id,
					subject_id: subject_id,
					type: type
				},
				success: function(data){
					$('#subject').html(data.result);
				}
			});
		}
	});
</script>