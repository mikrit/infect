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
		<p>
			<?=Form::open('data', array('class' => 'form-horizontal', 'method'=>'post', 'name' => 'infect'))?>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
					<div class="col-sm-5">
						<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
					</div>
					<div class="col-sm-5">
						<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="inputPassword3" placeholder="Password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox"> Remember me
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Sign in</button>
					</div>
				</div>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel2" class="tab-pane fade">
		<h3>Инф служба </h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'inf_secur'))?>
				<label for="exampleSelect1">Обслуживаемое население:</label>
				<div class="form-group">
					<?=Form::input('adults', '',array("class" => "form-control", "placeholder" => "взрослые", "name" => "adult", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('children', '',array("class" => "form-control", "placeholder" => "дети (0-17)", "name" => "children", "type" => "text"))?>
				</div>
				<label for="exampleSelect1">Количество случаев инфекционных заболеваний по данным отчетной формы №2:</label>
				<div class="form-group">
					<?=Form::input('inf_adults', '',array("class" => "form-control", "placeholder" => "у взрослых (с 18 лет)", "name" => "inf_adults", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('inf_children', '',array("class" => "form-control", "placeholder" => "у детей (0-17)", "name" => "inf_children", "type" => "text"))?>
				</div>
				<?=Form::hidden('action', 'inf_secur')?>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel3" class="tab-pane fade">
		<h3>Стац помощь</h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'stac'))?>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text"))?>
				</div>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel4" class="tab-pane fade">
		<h3>СПИД-центры</h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'spid'))?>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text"))?>
				</div>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel5" class="tab-pane fade">
		<h3>Амбулат помощь</h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'ambulat'))?>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text"))?>
				</div>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel6" class="tab-pane fade">
		<h3>КДЦ</h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'kdc'))?>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text"))?>
				</div>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
	<div id="panel7" class="tab-pane fade">
		<h3>Вирусные гепатиты</h3>
		<p>
			<?=Form::open('data', array('method'=>'post', 'name' => 'vir_gepatit'))?>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text", "autofocus" => ""))?>
				</div>
				<div class="form-group">
					<?=Form::input('', '',array("class" => "form-control", "placeholder" => "", "name" => "", "type" => "text"))?>
				</div>
				<?=Form::submit('button', 'Сохранить', array("class" => "btn btn-primary", "type" => "button"))?>
			<?=Form::close()?>
		</p>
	</div>
</div>

<script>
	/*$('#infect').click(function(){
		$('infect').submit();
	});*/
</script>