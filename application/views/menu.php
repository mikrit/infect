<?php defined('SYSPATH') or die('No direct script access.')?>

<ul class="nav navbar-nav">
	<li class="active"><?=HTML::anchor('/', '<span class="glyphicon glyphicon-home"></span>');?></li>
	<li><?=HTML::anchor('data/index', 'Форма заполнения');?></li>
	<li><?=HTML::anchor('report/index', 'Отчёт');?></li>
	<li><?=HTML::anchor('logs/index', 'Логи');?></li>
	<li><?=HTML::anchor('user/index', 'Пользователи');?></li>
</ul>

<? if(Auth::instance()->logged_in()){?>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<?=HTML::anchor('auth/logout', 'Выход');?>
		</li>
	</ul>
<?}?>