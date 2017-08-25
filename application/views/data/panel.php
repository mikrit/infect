<?php defined('SYSPATH') or die('No direct script access.');?>

<h3><?=$title?></h3>

<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th width="60%">
                    <?=$table == 'infect' ? 'Инфекционная и паразитарная заболеваемость' : ''?>
				</th>
				<th width="20%">
					<?=$table == 'infect' ? 'Абс.' : 'Показатели'?>
				</th>
                <?if($table == 'infect'){?>
                    <th width="20%">
                        На 100 тыс. населения
                    </th>
                <?}?>
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
						    <?=Form::input('elem_'.$title->id, isset($data[$title->id][0]) ? $data[$title->id][0] : '', array("class" => "form-control add_element", "id" => "elem_".$title->id, "type" => "text", "data-id" => $title->id, "data-type" => 0))?>
					    <?}?>
                    </td>
                    <?if($table == 'infect'){?>
                        <td>
                            <?=Form::input('t_elem_'.$title->id, isset($data[$title->id][1]) ? $data[$title->id][1] : '', array("class" => "form-control add_element", "id" => "t_elem_".$title->id, "type" => "text", "data-id" => $title->id, "data-type" => 1))?>
                        </td>
                    <?}?>
				</tr>
			<?}?>
			<tr>
			<td colspan="3" class="text-right">
				<?=Form::button('button', 'Сохранить', array("id" => "send_infect_illness", "class" => "btn btn-primary"))?>
			</td>
			</tr>
		</tbody>
	</table>
<?=Form::hidden('table', $table, array("id" => "table"));?>
<?=Form::hidden('year', $year_now, array("id" => "year"));?>
<?=Form::hidden('district_id', $district_id, array("id" => "district"));?>
<?=Form::hidden('subject_id', $subject_id, array("id" => "subject"));?>
<?=Form::close()?>