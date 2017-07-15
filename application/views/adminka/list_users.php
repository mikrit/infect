<?php defined('SYSPATH') or die('No direct script access.');?>

<h3>Сотрудники</h3>

<div id="edit">
    <?=HTML::anchor('adminka/register', '+ Добавить нового сотрудника')?>
</div>
<table class="table">
    <thead>
        <tr>
            <td class="text-right" colspan="8">
                <?=HTML::anchor('adminka', 'Назад')?>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                №
            </th>
            <th>
                Имя
            </th>
            <th>
                Логин
            </th>
        </tr>
        <? $i=1;
        foreach($users as $user){
            $class = ($i%2==1)?'class="task_1"':'class="task_2"';?>
            <?if($user->id != 1){?>
                <tr <?=$class?>>
                    <td>
                        <?=$i++?>
                    </td>
                    <td>
                        <?=HTML::anchor('adminka/update_user/'.$user->id, $user->fio)?>
                    </td>
                    <td>
                        <?=$user->username?>
                    </td>
                </tr>
            <?}?>
         <?}?>
    </tbody>
</table>