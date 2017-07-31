<div id="panel1" class="tab-pane fade in active">
	<h3>Инфекционная заболеваемость</h3>

	<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
		<table class="table">
			<thead>
				<tr>
					<th>
						Инфекционная и паразитарная заболеваемость
					</th>
					<th>
						Абс.
					</th>
					<th>
						На 100 тыс. населения
					</th>
				</tr>
			</thead>
			<tbody>
				<?foreach($inputs as $elem){?>
					<tr>
						<td>
							<?if($elem->bold == 1){?>
								<b><?=$elem->title?></b>
							<?}else{?>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$elem->title?>
							<?}?>
						</td>
						<td>
							<?=Form::input($elem->input, '', array("class" => "form-control", "type" => "text"))?>
						</td>
						<td>
							<?=Form::input('t_'.$elem->input, '', array("class" => "form-control", "type" => "text"))?>
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
	<?=Form::close()?>
</div>