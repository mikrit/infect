<div id="panel1" class="tab-pane fade in active">
	<h3>Инфекционная заболеваемость</h3>

	<?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
		<table class="table" id="panel1">
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
							<?=Form::input('elem_'.$infect->id, isset($data[$infect->id][0]) ? $data[$infect->id][0] : '', array("class" => "form-control value", "id" => "elem_".$infect->id, "type" => "text", "data-id" => $infect->id, "data-type" => 0))?>
						</td>
						<td>
							<?=Form::input('t_elem_'.$infect->id, isset($data[$infect->id][1]) ? $data[$infect->id][1] : '', array("class" => "form-control value", "id" => "t_elem_".$infect->id, "type" => "text", "data-id" => $infect->id, "data-type" => 1))?>
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
</div>

<script>
	$(".value").change(function(){
		var year = $('#year').val();
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		var elem_id = $(this).attr('id');
		var infect_id = $(this).data('id');
		var type = $(this).data('type');

		if(isNaN($(this).val()))
		{
			$('#'+elem_id).css('border-color', 'red');
		}
		else
		{
			$('#'+elem_id).css('border-color', '');

			$.ajax({
				type: "POST",
				url: "/ajax/add_infect_element",
				dataType: "json",
				data: {
					infect_id: infect_id,
					value: $('#'+elem_id).val(),
					year: year,
					district_id: district_id,
					subject_id: subject_id,
					type: type
				},
				success: function(data){
					$('#subject').html(data.result);
				}
			});
		}
	});
</script>