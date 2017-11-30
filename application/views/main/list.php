<?php defined('SYSPATH') or die('No direct script access.');?>

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
					<?if($title->yesno == 0){?>
						<?=isset($data[$title->id]['value']) ? $data[$title->id]['value'] : ''?>
					<?}else{?>
						<?=$data[$title->id]['yesno'] == 0 ? 'Нет' : 'Да'?>
					<?}?>
				</td>
			</tr>
		<?}?>
	</tbody>
</table>