<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="row">
	<div id="sidebar-left" class="col-lg-2">
		<ul class="nav navmenu-nav">
			<li class="active">
				<?=HTML::anchor('#', 'Инфекционная заболеваемость', array('class' => 'tabs', 'id' => 'infect'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'Инф служба', array('class' => 'tabs', 'id' => 'info'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'Стац помощь', array('class' => 'tabs', 'id' => 'stachelp'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'СПИД-центры', array('class' => 'tabs', 'id' => 'spid'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'Амбулат помощь', array('class' => 'tabs', 'id' => 'ambulathelp'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'КДЦ', array('class' => 'tabs', 'id' => 'kdc'));?>
			</li>
			<li>
				<?=HTML::anchor('#', 'Вирусные гепатиты', array('class' => 'tabs', 'id' => 'gepatid'));?>
			</li>
		</ul>
	</div>
	<div id="panel" class="col-lg-10 container">
		<?=$panel?>
	</div>
</div>

<script>
	$('.tabs').click(function (){
		var table = $(this).attr('id');

		$.ajax({
			type: "POST",
			url: "/ajax/change_tab",
			dataType: "json",
			data: {
				table: table
			},
			success: function(data){
				$('#panel').html(data.panel);
			}
		});
	});

	$("#panel").on('change', '.edit_title', function(){
		var elem_id = $(this).data('id');
		var title = $(this).val();
		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_elem_title",
			dataType: "json",
			data: {
				elem_id: elem_id,
				title: title,
				table: table
			}
		});
	});

	$("#panel").on('change', '.edit_bold', function(){
		var elem_id = $(this).data('id');
		var value = $(this).val();
		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_elem_bold",
			dataType: "json",
			data: {
				elem_id: elem_id,
				value: value,
				table: table
			}
		});
	});

	$("#panel").on('change', '.edit_subtitle', function(){
		var elem_id = $(this).data('id');
		var value = $(this).val();
		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_elem_subtitle",
			dataType: "json",
			data: {
				elem_id: elem_id,
				value: value,
				table: table
			}
		});
	});

	$("#panel").on('change', '.edit_formula', function(){
		var elem_id = $(this).data('id');
		var formula = $(this).val();

		var cicle = incicle(formula);

		console.log(cicle);

		return;

		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_elem_formula",
			dataType: "json",
			data: {
				elem_id: elem_id,
				formula: formula,
				table: table
			}
		});
	});

	var ids = [];
	function incicle(data){
		var isin = false;

		var reg = /\d+/g;
		var arr = data.match(reg);

		arr.map(function(id){
			var formula = $('#elem_'+id+' .edit_formula').val();

			if(formula != '')
			{
				if(ids.indexOf(id) != -1) // есть
				{
					return true;
				}
				else
				{
					ids.push(id);
					isin = incicle(formula);
				}
			}
			else
			{
				return false;
			}
		});

		return isin;
	}
</script>