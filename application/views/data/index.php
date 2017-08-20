<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<div class="row">
    <div id="sidebar-left" class="col-sm-6 col-md-4 col-lg-4">
        <div id="f_1">
            <?=Form::open('data', array('method'=>'post', 'name' => 'form'))?>
            <div class="form-group">
                <label>Год:</label>
                <?=Form::select('year', $years, $year_now, array('class' => 'form-control', 'id' => 'year', 'autocomplete' => 'off'));?>

                <label>Округ РФ:</label>
                <?if($user_district == 0){?>
                    <?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'id' => 'district', 'autocomplete' => 'off'));?>
                <?}else{?>
                    <?=Form::select('district', $districts, $district_id, array('class' => 'form-control', 'disabled' => '', 'autocomplete' => 'off'));?>
                <?}?>

                <label>Субъект РФ:</label>
                <?if($user_subject == 0){?>
                    <div id="subjects">
                        <?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'id' => 'subject', 'autocomplete' => 'off'));?>
                    </div>
                <?}else{?>
                    <?=Form::select('subject', $subjects, $subject_id, array('class' => 'form-control', 'disabled' => '', 'autocomplete' => 'off'));?>
                <?}?>
            </div>
            <?=Form::close()?>
        </div>

        <ul class="nav navmenu-nav">
            <li class="active">
                <?=HTML::anchor('#', 'Инфекционная заболеваемость');?>
            </li>
            <li>
                <?=HTML::anchor('#', 'Инф служба', array('id' => ''));?>
            </li>
            <li>
                <?=HTML::anchor('#', 'Стац помощь', array('id' => ''));?>
            </li>
            <li>
                <?=HTML::anchor('#', 'СПИД-центры', array('id' => ''));?>
            </li>
            <li>
                <?=HTML::anchor('#', 'Амбулат помощь', array('id' => ''));?>
            </li>
            <li>
                <?=HTML::anchor('#', 'КДЦ', array('id' => ''));?>
            </li>
            <li>
                <?=HTML::anchor('#', 'Вирусные гепатиты', array('id' => ''));?>
            </li>
        </ul>
    </div>
    <div id="panel" class="col-sm-6 col-md-8 col-lg-8 container" >
        <?=$panel1?>
    </div>
</div>

<script>
    $('select').select2({
        language: "ru",
        width: '100%'
    });

    $("#f_1").on('change', '#year, #subject', function()
    {
        var year = $('#year').val();
        var district_id = $('#district').val();
        var subject_id = $('#subject').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_datainfect",
            dataType: "json",
            data: {
                year: year,
                district_id: district_id,
                subject_id: subject_id
            },
            success: function(data){
                $('#panel').html(data.panel1);
            }
        });
    });

    $("#f_1").on('change', '#district', function()
    {
        var year = $('#year').val();
        var district_id = $('#district').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_district2",
            dataType: "json",
            data: {
                district_id: district_id
            },
            success: function(data){
                $('#subjects').html(data.result);

                var subject_id = $('#subject').val();

                $.ajax({
                    type: "POST",
                    url: "/ajax/change_datainfect",
                    dataType: "json",
                    data: {
                        year: year,
                        district_id: district_id,
                        subject_id: subject_id
                    },
                    success: function(data){
                        $('#panel').html(data.panel1);
                    }
                });
            }
        });
    });

    $("#panel").on('change', '.infect', function(){
        var year = $('#year').val();
        var district_id = $('#district').val();
        var subject_id = $('#subject').val();

        var elem_id = $(this).attr('id');
        var infect_id = $(this).data('id');
        var type = $(this).data('type');

        if(isNaN($(this).val()))
        {
            $('#'+elem_id).css('border-color', 'red');
        }
        else
        {
            $('#'+elem_id).css('border-color', '');

            $.ajax({
                type: "POST",
                url: "/ajax/infect_element",
                dataType: "json",
                data: {
                    infect_id: infect_id,
                    value: $('#'+elem_id).val(),
                    year: year,
                    district_id: district_id,
                    subject_id: subject_id,
                    type: type
                },
                success: function(data){
                    $('#subject').html(data.result);
                }
            });
        }
    });
</script>