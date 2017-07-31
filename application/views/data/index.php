<?php defined('SYSPATH') or die('No direct script access.');?>

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

<?=Form::open('data', array('method'=>'post', 'name' => 'year_1', 'class' => 'year', 'id' => 'panel_1'))?>
	<div class="form-group">
		<label>Год:</label>
		<?=Form::select('year', $years, $year_now, array('class' => 'form-control'));?>

		<?if(0){?>
			<label>Округ РФ:</label>
			<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'id' => 'district'));?>

			<label>Субъект РФ:</label>
			<div id="subject">
				<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control'));?>
			</div>
		<?}?>
	</div>
<?=Form::close()?>

<div class="tab-content">
	<?=$panel1?>
	<?=$panel2?>
	<?=$panel3?>
	<?=$panel4?>
	<?=$panel5?>
	<?=$panel6?>
	<?=$panel7?>
</div>

<script>
    $("#district").change(function(){
	    var district_id = $(this).val();

	    $.ajax({
		    type: "POST",
		    url: "/ajax/change_district2",
		    dataType: "json",
		    data: {
			    action: 'change_district',
			    district_id: district_id
		    },
		    success: function(data){
			    $('#subject').html(data.result);
		    }
	    });
    });

	/*$('#infect').click(function(){
		$('infect').submit();
	});*/
</script>