<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="row">
	<div id="sidebar-left" class="col-lg-2">
		<ul class="nav navmenu-nav">
			<!--li class="active">
				<?HTML::anchor('', 'Инфекционная заболеваемость', array('class' => 'tabs', 'id' => 'infect'));?>
			</li-->
			<li>
				<?=HTML::anchor('', 'Инф служба', array('class' => 'tabs', 'id' => 'info'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Стац помощь', array('class' => 'tabs', 'id' => 'stachelp'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'СПИД-центры', array('class' => 'tabs', 'id' => 'spid'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Амбулат помощь', array('class' => 'tabs', 'id' => 'ambulathelp'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'КДЦ', array('class' => 'tabs', 'id' => 'kdc'));?>
			</li>
			<li>
				<?=HTML::anchor('', 'Вирусные гепатиты', array('class' => 'tabs', 'id' => 'gepatid'));?>
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

        return false;
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

	$("#panel").on('change', '.edit_yesno', function(){
		var elem_id = $(this).data('id');
		var value = $(this).val();
		var table = $('#table').val();

		$.ajax({
			type: "POST",
			url: "/ajax/edit_elem_yesno",
			dataType: "json",
			data: {
				elem_id: elem_id,
				value: value,
				table: table
			}
		});
	});

	function is_formula(formula)
	{
		var is = false;

		//var reg = /(\(*(id\d+|\d+)[+-/*])+((\(*(id\d+|\d+)|(id\d+|\d+)\)*)[+-/*])*(id\d+|\d+)\)*/g;
		var reg = /(\(*(id\d+|\d+|infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+)[+-/*])+((\(*(id\d+|\d+|infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+)|(id\d+|\d+|infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+)\)*)[+-/*])*(id\d+|\d+|infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+)\)*/g;
		var rformula = formula.match(reg);
		var reg_formula = rformula == null ? 0 : rformula[0].length;

		var ropen = formula.match(/\(/g);
		var rclose = formula.match(/\)/g);
		var open_s = ropen == null ? 0 : ropen.length;
		var close_s = rclose == null ? 0 : rclose.length;

		if(formula != '' && formula.length == reg_formula && open_s == close_s)
		{
			is = true;
		}

		return is;
	}

	var ids = [];
	$("#panel").on('change', '.edit_formula', function(){
		ids = [];
		var elem_id = $(this).data('id');
		var formula = $(this).val();
		var table = $('#table').val();

		ids.push(elem_id);

		console.log(is_formula(formula));

		if(is_formula(formula) || formula == '')
		{
			var cicle = false;
			if(formula != '')
			{
				cicle = incicle(formula, false);
			}

			if(cicle == true)
			{
				$('#error_'+elem_id).css('padding', '0');
				$('#error_'+elem_id).show();
			}
			else
			{
				$('#error_'+elem_id).hide();

				/*formula.match(/id\d+/g).map(function(el){
					var el_id = el.match(/\d+/)[0];

					//console.log(el, elem_id, el.match(/\d+/)[0], $('#use_'+el_id).data('use'));
				});*/

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
			}
		}
		else
		{
			return;
		}
	});

	function incicle(data, isin)
	{
		var arr = data.match(/id\d+/g);

		if(arr != null)
		{
			arr.map(function(id)
			{
				var ff_id = Number(id.match(/\d+/g)[0]);
				var formula = $('#elem_'+ff_id+' .edit_formula').val();

				//console.log(ids, ff_id);

				if(ids.indexOf(ff_id) != -1)
				{
					isin = true;
				}
				else
				{
					if(is_formula(formula) && isin == false)
					{
						ids.push(Number(ff_id));
						isin = incicle(formula, isin);
					}
				}
			});
		}

		return isin;
	}
</script>