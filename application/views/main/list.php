<?php defined('SYSPATH') or die('No direct script access.');?>

<h3><?=$title?></h3>

<table class="table" width="100%">
	<thead>
	<tr>
		<th width="65%">
			Название
		</th>
		<th width="8%">
			<?=$r_year_begin?>
		</th>
		<th width="8%">
			<?=$r_year_end?>
		</th>
		<th width="17%">
			Прирост +% или<br/>
			Снижение -%
		</th>
	</tr>
	</thead>
	<tbody>
		<?foreach($titles as $title){?>
			<tr>
				<td>
					<?if($title->bold == 1){?>
						<b><?=$title->title?></b>
					<?}else{?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$title->title?>
					<?}?>
				</td>
				<td style="white-space: nowrap">
					<?var_dump($data[$r_year_begin])?>
					<?//(isset($data[$r_year_begin][$title->id]['value']) ? number_format($data[$r_year_begin][$title->id]['value'], 2, '.', ' ') : '')?>
					<?$begin = isset($data[$r_year_begin][$title->id]['value']) ? (float)$data[$r_year_begin][$title->id]['value'] : 0?>
				</td>
				<td style="white-space: nowrap">
					<?//(isset($data[$r_year_end][$title->id]['value']) ? number_format($data[$r_year_end][$title->id]['value'], 2, '.', ' ') : '')?>
					<?$end = isset($data[$r_year_end][$title->id]['value']) ? (float)$data[$r_year_end][$title->id]['value'] : 0?>
				</td>
				<td>
					<?if($begin != '' && $end != '' && $begin != 0){?>
						<?=number_format($end/$begin*100-100, 2, '.', ' ')?>%
					<?}elseif($begin != '' || $end != ''){?>
						<?=number_format(0, 2, '.', ' ')?>%
					<?}?>
				</td>
			</tr>
		<?}?>
	</tbody>
</table>
<?=Form::hidden('table', $table, array("id" => "table"));?>
<?=Form::hidden('year_begin', $r_year_begin, array("id" => "year"));?>
<?=Form::hidden('year_end', $r_year_end, array("id" => "year"));?>
<?=Form::hidden('district_id', $district_id, array("id" => "district"));?>
<?=Form::hidden('subject_id', $subject_id, array("id" => "subject"));?>