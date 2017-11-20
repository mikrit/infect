<?php defined('SYSPATH') or die('No direct script access.');?>

<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<?=HTML::script('media/js/number.min.js')?>

<div class="row">
	<div id="sidebar-left" class="col-sm-5 col-md-4 col-lg-4">
		<div id="f_1">
			<?=Form::open('data', array('method'=>'post', 'name' => 'form'))?>
				<div class="form-group col-lg-6" style="padding-left: 0px;">
					<label>Года с:</label>
					<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>
				</div>

				<div class="form-group col-lg-6" style="padding-left: 0px;">
					<label>по:</label>
					<?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year'));?>
				</div>

				<div class="form-group">
					<label>Округ РФ:</label>
					<?if($user_district == 0){?>
						<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'id' => 'district', 'autocomplete' => 'off'));?>
					<?}else{?>
						<?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'disabled' => '', 'autocomplete' => 'off'));?>
					<?}?>
				</div>

				<div class="form-group">
					<label>Субъект РФ:</label>
					<?if($user_subject == 0 && $district_id != 0){?>
						<div id="subjects">
							<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'id' => 'subject', 'autocomplete' => 'off'));?>
						</div>
					<?}else{?>
						<?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'disabled' => '', 'autocomplete' => 'off'));?>
					<?}?>
				</div>
			<?=Form::close()?>
		</div>

		<ul class="nav navmenu-nav">
			<li class="active">
				<?=HTML::anchor('', 'Инфекционная заболеваемость', array('class' => 'tabs', 'id' => 'infect'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Инф служба', array('class' => 'tabs', 'id' => 'info'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Стац помощь', array('class' => 'tabs', 'id' => 'stachelp'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'СПИД-центры', array('class' => 'tabs', 'id' => 'spid'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Амбулат помощь', array('class' => 'tabs', 'id' => 'ambulathelp'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'КДЦ', array('class' => 'tabs', 'id' => 'kdc'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Вирусные гепатиты', array('class' => 'tabs', 'id' => 'gepatid'));?>
			</li>
		</ul>
	</div>
	<div id="panel" class="col-sm-7 col-md-8 col-lg-8 container" >
		<?=$list?>
	</div>
</div>