<?php defined('SYSPATH') or die('No direct script access.');?>

<h3><?=$title?></h3>

<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th width="80%">
					Название
				</th>
				<th width="20%">
					Показатели
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
					<td>
						<?if($title->subtitle == 0){?>
							<?=Form::input('elem_'.$title->id, (isset($data[$title->id]['value']) ? $data[$title->id]['value'] : ''), array("class" => "form-control add_element", "id" => "elem_".$title->id, "type" => "text", "data-id" => $title->id))?>
						<?}else{?>
							<?if($title->formula != ''){?>
								<div class="formula" id="elem_<?=$title->id?>" data-formula="<?=$title->formula?>"><?=(isset($data[$title->id]['value']) ? number_format($data[$title->id]['value'], 2, '.', ' ') : 0)?></div>
							<?}?>
						<?}?>
					</td>
				</tr>
			<?}?>
		</tbody>
	</table>
	<?=Form::hidden('table', $table, array("id" => "table"));?>
	<?=Form::hidden('year', $year_now, array("id" => "year"));?>
	<?=Form::hidden('district_id', $district_id, array("id" => "district"));?>
	<?=Form::hidden('subject_id', $subject_id, array("id" => "subject"));?>
<?=Form::close()?>