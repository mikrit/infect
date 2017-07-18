<?php defined('SYSPATH') or die('No direct script access.');?>

<h3>Сотрудники</h3>

<h4><?=HTML::anchor('adminka/register', '+ Добавить нового сотрудника')?></h4>

<table class="table">
    <thead>
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
            <th>
                e-mail
            </th>
            <th>
                Федеральный округ
            </th>
            <th>
                Субъект РФ
            </th>
        </tr>
    </thead>
    <tbody>
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
                    <td>
                        <?=$user->email?>
                    </td>
                    <td>
                        <?$district = $user->district->title?>
                        <?=$district == NULL ? 'Нет' : $district?>
                    </td>
                    <td>
                        <?$subject = $user->subject->title?>
                        <?=$subject == NULL ? 'Нет' : $subject?>
                    </td>
                </tr>
            <?}?>
         <?}?>
    </tbody>
</table>