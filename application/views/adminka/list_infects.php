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

	$('.edit_title').on('change', function(){
		var elem_id = $(this).attr('id');
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

	$('.edit_bold').on('change', function(){
		var elem_id = $(this).attr('id');
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

	$('.edit_subtitle').on('change', function(){
		var elem_id = $(this).attr('id');
		var value = $(this).val();

		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_edit_subtitle",
			dataType: "json",
			data: {
				elem_id: elem_id,
				value: value,
				table: table
			}
		});
	});

	$('.edit_formula').on('change', function(){
		var elem_id = $(this).attr('id');
		var formula = $(this).val();

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
</script>