<table class="table" width="100%">
	<thead>
	<tr>
		<th width="65%">
			Название
		</th>
	</tr>
	</thead>
	<tbody>
	<?foreach($titles as $title){?>
		<tr>
			<td>
				<?if($title->bold == 1){?>
					<b><?=Form::checkbox('categorie', $title->id, FALSE, array('id' => 'ch_'.$title->id, 'class' => 'chek', 'style' => 'margin-right:5px'))?><?=$title->title?></b>
				<?}else{?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=Form::checkbox('categorie', $title->id, FALSE, array('id' => 'ch_'.$title->id, 'class' => 'chek', 'style' => 'margin-right:5px'))?><?=$title->title?>
				<?}?>
			</td>
		</tr>
	<?}?>
	</tbody>
</table>

<?=Form::hidden('table', $table);?>