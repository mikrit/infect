<?php defined('SYSPATH') or die('No direct script access.');?>

<h3>Админка</h3>

<table class="table">
	<tr>
		<td>
			<?=HTML::anchor('adminka/list_users', 'Сотрудники'); ?>
		</td>
    </tr>
    <tr>
        <td>
            <?=HTML::anchor('adminka/close', 'Закрытие изменений'); ?>
        </td>
	</tr>
    <tr>
        <td>
            <?=HTML::anchor('adminka/logs', 'Логирование'); ?>
        </td>
	</tr>
</table>