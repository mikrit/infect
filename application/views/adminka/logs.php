<?php defined('SYSPATH') or die('No direct script access.');?>

<h3>Изменения</h3>

<div class="text-right">
    <?=HTML::anchor('adminka/list_users', 'Назад')?>
</div>

<table class="table">
    <thead>
        <tr>
            <th>
                Дата
            </th>
            <th>
                Имя
            </th>
            <th>
                Было
            </th>
            <th>
                Стало
            </th>
        </tr>
    </thead>
    <tbody>
        <?foreach($logs as $log){?>
            <tr>
                <td>
                    <?=$log->date?>
                </td>
                <td>
                    <?=$log->user->name?>
                </td>
                <td>
                    <?=$log->before?>
                </td>
                <td>
                    <?=$log->after?>
                </td>
            </tr>
        <?}?>
    </tbody>
</table>