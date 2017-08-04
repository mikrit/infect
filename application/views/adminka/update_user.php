<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="col-lg-8 col-sm-12">
    <h3>Обновить данные сотрудника</h3>

    <?if(count($errors)){?>
        <div class="alert alert-danger">
            <?foreach ($errors as $error){?>
                <?=$error?><br/>
            <?}?>
        </div>
    <?}?>

    <div class="text-right">
        <?=HTML::anchor('adminka/list_users', 'Назад')?>
    </div>
    <div class="row">
        <?=Form::open('adminka/update_user/'.$id, array('name' => 'form1', 'method'=>'post'));?>
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
                <?=Form::select('district_id', $districts, $data->district_id, array('class' => 'form-control', 'id' => 'district', 'autocomplete' => 'off'));?>
            </div>
            <div class="form-group">
                <label>Субъект:</label>
                <div id="subject">
                    <?=Form::select('subject_id', $subjects, $data->subject_id, array('class' => 'form-control'));?>
                </div>
            </div>
            <div class="form-group">
                <label>Админ:</label>
                <?=Form::select('admin', array(0 => "Не админ", 1 => "Админ"), $admin, array('class' => 'form-control'));?>
            </div>
            <div class="form-group text-right">
                <?=Form::button('button', 'Изменить данные',array("class" => "btn btn-primary"))?>
                <?=Form::hidden('prov', '1');?>
            </div>
        <?=Form::close();?>
    </div>

    <div class="row">
        <?=Form::open('adminka/update_user/'.$id, array('name' => 'form2', 'method'=>'post'));?>
            <div class="form-group">
                <label>Пароль:</label>
                <?=Form::input('password', '', array('class' => 'form-control', 'type' => 'password'));?>
            </div>
            <div class="form-group">
                <label>Повторить пароль:</label>
                <?=Form::input('password_confirm', '', array('class' => 'form-control', 'type' => 'password'));?>
            </div>
            <div class="form-group text-right">
                <?=Form::button('button', 'Изменить пароль',array("class" => "btn btn-primary"))?>
                <?=Form::hidden('prov', '2');?>
            </div>
        <?=Form::close();?>
    </div>
</div>

<script>
    $("#district").change(function(){

        var district_id = $('#district').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_district",
            dataType: "json",
            data: {
                district_id: district_id
            },
            success: function(data){
                $('#subject').html(data.result);
            }
        });
    });
</script>