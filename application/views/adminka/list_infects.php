<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="row">
	<div id="sidebar-left" class="col-lg-3">
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
	<div id="panel" class="col-lg-9 container">
		<?=$panel?>
	</div>
</div>