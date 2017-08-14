<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<div id="f_1">
	<?=Form::open('data', array('method'=>'post', 'name' => 'form'))?>
	<div class="form-group">
		<label>Год:</label>
		<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>

		<label>Округ РФ:</label>
		<?if($user_district == 0){?>
			<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'id' => 'district'));?>
		<?}else{?>
			<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'disabled' => ''));?>
		<?}?>

		<label>Субъект РФ:</label>
		<?if($user_subject == 0){?>
			<div id="subjects">
				<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'id' => 'subject'));?>
			</div>
		<?}else{?>
			<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'disabled' => ''));?>
		<?}?>
	</div>
	<?=Form::close()?>
</div>

