<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="row">

	<h3>Редактирование данных</h3>

	<?=Form::open('user', array('name' => 'form1', 'method'=>'post'));?>
		<?php if(count($errors)):?>
			<?php foreach ($errors as $error):?>
				<div style="color: #ac2925;"><?=$error?></div><br/>
			<?php endforeach;?>
		<?php endif;?>
		<div class="form-group">
			<label>ФИО:</label>
			<?=Form::input('fio', $user->fio, array('class' => 'form-control'))?>
		</div>

		<div class="form-group">
			<?=Form::input('submit','Обновить данные', array('class' => 'btn btn-primary', 'type'=>'submit'));?>
			<?=Form::hidden('prov', '1');?>
		</div>
	<?=Form::close();?>

	<h3>Изменить пароль</h3>
	<?=Form::open('user', array('name' => 'form2', 'method'=>'post'));?>
		<?php if(count($errors2)):?>
			<?php foreach ($errors2 as $error):?>
				<div style="color: #ac2925;"><?=$error?></div><br/>
			<?php endforeach;?>
		<?php endif;?>

		<div class="form-group">
			<label>Пароль:</label>
			<?=Form::password('password', '', array('class' => 'form-control'));?>
		</div>

		<div class="form-group">
			<label>Повторите пароль:</label>
			<?=Form::password('password_confirm', '', array('class' => 'form-control'));?>
		</div>

		<div class="form-group">
			<?=Form::input('submit','Изменить пароль', array('class' => 'btn btn-primary', 'type'=>'submit'));?>
			<?=Form::hidden('prov', '2');?>
		</div>
	<?=Form::close();?>
</div>
