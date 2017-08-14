<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="col-lg-8 col-sm-12">
	<div class="form-group col-lg-3">
		<label>Года с:</label>
		<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>
	</div>

	<div class="form-group col-lg-3">
		<label>по:</label>
		<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>
	</div>
</div>