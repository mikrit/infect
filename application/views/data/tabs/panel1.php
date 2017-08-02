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
							<?=Form::input($elem->input, isset($data[$elem->input][0]) ? $data[$elem->input][0] : '', array("class" => "form-control value", "type" => "text", "id" => $elem->input))?>
						</td>
						<td>
							<?=Form::input('t_'.$elem->input, isset($data[$elem->input][1]) ? $data[$elem->input][1] : '', array("class" => "form-control value", "type" => "text", "id" => $elem->input))?>
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
	<?=Form::hidden('district_id', $district_id, array("id" => "district"));?>
	<?=Form::hidden('subject_id', $subject_id, array("id" => "subject"));?>
	<?=Form::close()?>
</div>

<script>
	$(".value").change(function(){
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		$.ajax({
			type: "POST",
			url: "/ajax/change_data_infect",
			dataType: "json",
			data: {
				action: 'change_data_infect',
				district_id: district_id,
				subject_id: subject_id
			},
			success: function(data){
				$('#subject').html(data.result);
			}
		});
	});
</script>