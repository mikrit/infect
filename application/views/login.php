<?php defined('SYSPATH') or die('No direct script access.');?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Страница входа</title>

		<?=Html::style('media/bootstrap/css/bootstrap.min.css')?>
		<?=Html::style('media/css/login-box.css')?>

		<?=Html::script('media/js/jquery.js')?>
		<?=Html::script('media/bootstrap/js/bootstrap.min.js')?>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-panel panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Вход в систему</h3>
						</div>
						<div class="panel-body">
							<?=$error?>
							<?=Form::open('login', array('method'=>'post', 'name' => 'login'))?>
									<div class="form-group">
										<?=Form::input('login', '',array("class" => "form-control", "placeholder" => "Логин", "name" => "login", "type" => "text", "autofocus" => ""))?>
									</div>
									<div class="form-group">
										<?=Form::password('password', '',array("class" => "form-control", "placeholder" => "Пароль", "name" => "password", "type" => "password"))?>
									</div>
									<div class="checkbox">
										<label>
											<?=Form::checkbox('remember', '')?>Запомнить меня
										</label>
									</div>
									<?=Form::submit('button', 'Вход', array("class" => "btn btn-lg btn-success btn-block", "оnclick" => "javascript:document.myform.submit();", "type" => "button"))?>
							<?=Form::close()?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
