<?php defined('SYSPATH') or die('No direct script access.')?>

<ul class="nav navbar-nav">
	<li class="active"><?=HTML::anchor('/', '<span class="glyphicon glyphicon-home"></span>');?></li>
	<li><?=HTML::anchor('/faq', 'FAQ');?></li>
	<li><?=HTML::anchor('/about', 'О поекте');?></li>
</ul>

<? if(Auth::instance()->logged_in()){?>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<?=HTML::anchor('bauth/logout', 'Выход');?>
		</li>
	</ul>
<?}?>