<?php defined('SYSPATH') or die('No direct script access.');?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#myTab a").click(function(e){
			e.preventDefault();
			$(this).tab('show');
		});
	});
</script>

<ul id="myTab" class="nav nav-tabs">
	<li class="active"><a href="#panel1">Инфекционная заболеваемость</a></li>
	<li><a href="#panel2">Инф служба </a></li>
	<li><a href="#panel3">Стац помощь</a></li>
	<li><a href="#panel4">СПИД-центры</a></li>
	<li><a href="#panel5">Амбулат помощь</a></li>
	<li><a href="#panel6">КДЦ</a></li>
	<li><a href="#panel7">Вирусные гепатиты</a></li>
</ul>

<div class="tab-content">
	<div id="panel1" class="tab-pane fade in active">
		<h3>Инфекционная заболеваемость</h3>
        <?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
            <table class="table">
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
                <tr>
                    <td>
                        Брюшной тиф
                    </td>
                    <td>
                        <?=Form::input('bru_tif', '',array("class" => "form-control", "name" => "bru_tif", "type" => "text", "autofocus" => ""))?>
                    </td>
                    <td>
                        <?=Form::input('t_bru_tif', '',array("class" => "form-control", "name" => "t_bru_tif", "type" => "text"))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Паратифы
                    </td>
                    <td>
                        <?=Form::input('paratif', '',array("class" => "form-control", "name" => "paratif", "type" => "text"))?>
                    </td>
                    <td>
                        <?=Form::input('t_paratif', '',array("class" => "form-control", "name" => "t_paratif", "type" => "text"))?>
                    </td>
                </tr>
                <tr>
                    <td>
                        паратиф С
                    </td>
                    <td>
                        <?=Form::input('paratif_c', '',array("class" => "form-control", "name" => "paratif_c", "type" => "text"))?>
                    </td>
                    <td>
                        <?=Form::input('t_paratif_c', '',array("class" => "form-control", "name" => "t_paratif_c", "type" => "text"))?>
                    </td>
                </tr>
            </table>
        <?=Form::close()?>
	</div>
	<div id="panel2" class="tab-pane fade">
		<h3>Инф служба </h3>
	</div>
	<div id="panel3" class="tab-pane fade">
		<h3>Стац помощь</h3>
	</div>
	<div id="panel4" class="tab-pane fade">
		<h3>СПИД-центры</h3>
	</div>
	<div id="panel5" class="tab-pane fade">
		<h3>Амбулат помощь</h3>
	</div>
	<div id="panel6" class="tab-pane fade">
		<h3>КДЦ</h3>
	</div>
	<div id="panel7" class="tab-pane fade">
		<h3>Вирусные гепатиты</h3>
	</div>
</div>

<script>
	/*$('#infect').click(function(){
		$('infect').submit();
	});*/
</script>