<?php defined('SYSPATH') or die('No direct script access.')?>

<?$request = explode("/", Request::current()->uri());?>

<ul class="nav navbar-nav">
	<li <?if($request[0] == '' || $request[0] == 'main'){echo 'class="active"';}?>>
		<?=HTML::anchor('/', '<span class="glyphicon glyphicon-home"></span>');?>
	</li>
	<li <?if($request[0] == 'data'){echo 'class="active"';}?>>
		<?=HTML::anchor('data', 'Форма заполнения');?>
	</li>
	<li <?if($request[0] == 'report'){echo 'class="active"';}?>>
		<?=HTML::anchor('report', 'Отчёт');?>
	</li>
	<?if($admin){?>
		<li <?if($request[0] == 'user'){echo 'class="active"';}?>>
			<?=HTML::anchor('user', 'Настройки'); //!!!!!!!!!!НЕ СДЕЛАНО?>
		</li>

		<?$active = '';if($request[0] == 'adminka'){$active = ' active';}?>

		<li class="dropdown<?=$active?>">
			<?=HTML::anchor('#', 'Админка', array("data-toggle" => "dropdown", "class" => "dropdown-toggle"));?>
			<ul class="dropdown-menu">
				<li>
					<?=HTML::anchor('adminka/list_users', 'Сотрудники'); ?>
				</li>
                <li>
					<?=HTML::anchor('adminka/list_infects', 'Списки инфекций'); ?>
				</li>
				<li>
					<?=HTML::anchor('adminka/close', 'Закрытие изменений'); ?>
				</li>
				<li>
					<?=HTML::anchor('adminka/logs', 'Логирование'); ?>
				</li>
			</ul>
		</li>
	<?}?>
</ul>

<? if(Auth::instance()->logged_in()){?>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<?=HTML::anchor('auth/logout', 'Выход');?>
		</li>
	</ul>
<?}?>