<?php defined('SYSPATH') or die('No direct script access.');?>

<h3><?=$title?></h3>

<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th width="2%">
					#
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
					Формула
				</th>
			</tr>
		</thead>
		<tbody>
			<?$i = 1;foreach($titles as $title){?>
				<tr>
					<td>
						<?=$i++;?>
					</td>
					<td>
						<?=Form::input('title', $title->title, array('class' => 'form-control'))?>
					</td>
					<td>
						<?=Form::select('bold', array(0 => 'Нет', 1 => 'Да'), $title->bold, array('class' => 'form-control'))?>
					</td>
					<td>
						<?=Form::select('subtitle', array(0 => 'Нет', 1 => 'Да'), $title->subtitle, array('class' => 'form-control'))?>
					</td>
					<td>
						<?=Form::input('formula', '', array('class' => 'form-control'))?>
					</td>
				</tr>
			<?}?>
		</tbody>
	</table>
<?=Form::close()?>