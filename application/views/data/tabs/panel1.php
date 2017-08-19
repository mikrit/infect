<?php defined('SYSPATH') or die('No direct script access.');?>

<h3>Инфекционная заболеваемость</h3>

<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th width="60%">
					Инфекционная и паразитарная заболеваемость
				</th>
				<th width="20%">
					Абс.
				</th>
				<th width="20%">
					На 100 тыс. населения
				</th>
			</tr>
		</thead>
		<tbody>
			<?foreach($infects as $infect){?>
				<tr>
					<td>
						<?if($infect->bold == 1){?>
							<b><?=$infect->title?></b>
						<?}else{?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$infect->title?>
						<?}?>
					</td>
					<td>
						<?=Form::input('elem_'.$infect->id, isset($data[$infect->id][0]) ? $data[$infect->id][0] : '', array("class" => "form-control infect", "id" => "elem_".$infect->id, "type" => "text", "data-id" => $infect->id, "data-type" => 0))?>
					</td>
					<td>
						<?=Form::input('t_elem_'.$infect->id, isset($data[$infect->id][1]) ? $data[$infect->id][1] : '', array("class" => "form-control infect", "id" => "t_elem_".$infect->id, "type" => "text", "data-id" => $infect->id, "data-type" => 1))?>
					</td>
				</tr>
			<?}?>
			<tr>
			<td colspan="3" class="text-right">
				<?=Form::button('button', 'Сохранить', array("id" => "send_infect_illness", "class" => "btn btn-primary"))?>
			</td>
			</tr>
		</tbody>
	</table>
<?=Form::hidden('year', $year_now, array("id" => "year"));?>
<?=Form::hidden('district_id', $district_id, array("id" => "district"));?>
<?=Form::hidden('subject_id', $subject_id, array("id" => "subject"));?>
<?=Form::close()?>