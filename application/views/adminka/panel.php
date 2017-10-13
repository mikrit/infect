<?php defined('SYSPATH') or die('No direct script access.');?>

<h3><?=$title?></h3>

<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th width="2%">
					id
				</th>
				<th width="44%">
					Название
				</th>
				<th width="15%">
					Жирный
				</th>
				<th width="15%">
					Подзаголовок
				</th>
				<th width="24%">
					Формула (Пример: id3/100)
				</th>
			</tr>
		</thead>
		<tbody>
			<?foreach($titles as $title){?>
				<tr id="elem_<?=$title->id?>">
					<td>
						<?=$title->id?>
					</td>
					<td>
						<?=Form::input('title', $title->title, array('class' => 'form-control edit_title', 'data-id' => $title->id))?>
					</td>
					<td>
						<?=Form::select('bold', array(0 => 'Нет', 1 => 'Да'), $title->bold, array('class' => 'form-control edit_bold', 'data-id' => $title->id))?>
					</td>
					<td>
						<?=Form::select('subtitle', array(0 => 'Нет', 1 => 'Да'), $title->subtitle, array('class' => 'form-control edit_subtitle', 'data-id' => $title->id))?>
					</td>
					<td>
						<div class="alert alert-danger fade in" id="error_<?=$title->id?>" style="display: none;">
							<strong>Ошибка!</strong> Циклическая формула
						</div>
						<?=Form::input('formula', $title->formula, array('class' => 'form-control edit_formula', 'data-id' => $title->id))?>
					</td>
				</tr>
			<?}?>
		</tbody>
	</table>
	<?=Form::hidden('table', $table, array("id" => "table"));?>
<?=Form::close()?>