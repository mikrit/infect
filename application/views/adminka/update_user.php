<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="col-lg-8 col-sm-12">
    <h3>Обновить данные сотрудника</h3>

    <div class="text-right">
        <?=HTML::anchor('adminka/list_users', 'Назад')?>
    </div>
    <div>
        <?=Form::open('adminka/update_user/'.$id,array('method'=>'post'));?>
            <div class="form-group">
                <label>ФИО:</label>
                <?=Form::input('fio', $data->fio, array('class' => 'form-control', 'type' => 'text'));?>
            </div>
            <div class="form-group">
                <label>Логин:</label>
                <?=Form::input('username', $data->username, array('class' => 'form-control', 'type' => 'text'));?>
            </div>
            <div class="form-group">
                <label>e-mail:</label>
                <?=Form::input('email', $data->email, array('class' => 'form-control', 'type' => 'email'));?>
            </div>
            <div class="form-group">
                <label>Округ:</label>
                <?=Form::select('district', $districts, $district, array('class' => 'form-control', 'id' => 'district'));?>
            </div>
            <div class="form-group">
                <label>Субъект:</label>
                <div id="subject">
                    <?=Form::select('subject', array(0 => "Нет"), 0, array('class' => 'form-control'));?>
                </div>
            </div>
            <div class="form-group">
                <label>Админ:</label>
                <?=Form::select('admin', array(0 => "Не админ", 1 => "Админ"), $admin, array('class' => 'form-control'));?>
            </div>
            <div class="form-group">
                <label>Пароль:</label>
                <?=Form::input('password', '', array('class' => 'form-control', 'type' => 'password'));?>
            </div>
            <div class="form-group">
                <label>Повторить пароль:</label>
                <?=Form::input('password_confirm', '', array('class' => 'form-control', 'type' => 'password'));?>
            </div>
            <div class="form-group text-right">
                <?=Form::button('button', 'Сохранить',array("id" => "", "class" => "btn btn-primary"))?>
            </div>
        <?=Form::close();?>
    </div>
</div>

<script>

    $("#district").change(function()// при нажатии кнопки "Вход"
    {
        var district_id = $('#district').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_district",
            dataType: "json",
            data: {
                action: 'change_district',
                district_id: district_id
            },
            success: function(data){
                $('#subject').html(data.result);
            }
        });
    });
</script>