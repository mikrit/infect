<?php defined('SYSPATH') or die('No direct script access.');?>

<?=HTML::style('media/css/select2/select2.min.css')?>
<?=HTML::script('media/js/select2/select2.min.js')?>

<?=HTML::script('media/js/number.min.js')?>

<div class="row">
    <div id="sidebar-left" class="col-sm-5 col-md-4 col-lg-4">
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
            <!--li class="active">
                <?HTML::anchor('', 'Инфекционная заболеваемость', array('class' => 'tabs', 'id' => 'infect'));?>
            </li-->
            <li>
                <?=HTML::anchor('', 'Инф служба', array('class' => 'tabs', 'id' => 'info'));?>
            </li>
            <li>
                <?=HTML::anchor('', 'Стац помощь', array('class' => 'tabs', 'id' => 'stachelp'));?>
            </li>
            <li>
                <?=HTML::anchor('', 'СПИД-центры', array('class' => 'tabs', 'id' => 'spid'));?>
            </li>
            <li>
                <?=HTML::anchor('', 'Амбулат помощь', array('class' => 'tabs', 'id' => 'ambulathelp'));?>
            </li>
            <li>
                <?=HTML::anchor('', 'КДЦ', array('class' => 'tabs', 'id' => 'kdc'));?>
            </li>
            <li>
                <?=HTML::anchor('', 'Вирусные гепатиты', array('class' => 'tabs', 'id' => 'gepatid'));?>
            </li>
        </ul>
    </div>
    <div id="panel" class="col-sm-7 col-md-8 col-lg-8 container" >
        <?=$panel?>
    </div>
</div>

<script>
    $('select').select2({
        language: "ru",
        width: '100%'
    });

    $('.tabs').click(function (){
        var table = $(this).attr('id');
        var year = $('#year').val();
        var district_id = $('#district').val();
        var subject_id = $('#subject').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_data",
            dataType: "json",
            data: {
                table: table,
                year: year,
                district_id: district_id,
                subject_id: subject_id
            },
            success: function(data){
                $('#panel').html(data.panel);
            }
        });

	    return false;
    });

    $("#f_1").on('change', '#year, #subject', function()
    {
        var table = $('#table').val();
        var year = $('#year').val();
        var district_id = $('#district').val();
        var subject_id = $('#subject').val();

        $.ajax({
            type: "POST",
            url: "/ajax/change_data",
            dataType: "json",
            data: {
                table: table,
                year: year,
                district_id: district_id,
                subject_id: subject_id
            },
            success: function(data){
                $('#panel').html(data.panel);
            }
        });
    });

    $("#f_1").on('change', '#district', function()
    {
        var table = $('#table').val();
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
                    url: "/ajax/change_data",
                    dataType: "json",
                    data: {
                        table: table,
                        year: year,
                        district_id: district_id,
                        subject_id: subject_id
                    },
                    success: function(data){
                        $('#panel').html(data.panel);
                    }
                });
            }
        });
    });

	$("#panel").on('change', '.add_element', function()
	{
		var table = $('#table').val();
		var year = $('#year').val();
		var district_id = $('#district').val();
		var subject_id = $('#subject').val();

		var val_id = $(this).attr('id');
		var elem_id = $(this).data('id');

		if(isNaN($(this).val()))
		{
			$('#'+val_id).css('border-color', 'red');
		}
		else
		{
			$('#'+val_id).css('border-color', '');

			$.ajax({
				type: "POST",
				url: "/ajax/add_element",
				dataType: "json",
				data: {
					elem_id: elem_id,
					value: $('#'+val_id).val(),
					table: table,
					year: year,
					district_id: district_id,
					subject_id: subject_id
				},
				success: function(data){
					$.each(data.result, function(index, value){
						if($('#elem_'+index).attr('class') == 'formula')
						{
							if(Number.isInteger(Number(value)))
							{
								$('#elem_'+index).html($.number(value, 0, '.', ' '));
							}
							else
							{
								$('#elem_'+index).html($.number(value, 2, '.', ' '));
							}
						}
						else
						{
							$('#elem_'+index).val(value);
						}
					});
				}
			});
		}
	});
</script>