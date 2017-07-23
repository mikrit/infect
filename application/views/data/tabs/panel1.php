<div id="panel1" class="tab-pane fade in active">
    <h3>Инфекционная заболеваемость</h3>

    <?=Form::open('data', array('method'=>'post', 'name' => 'infect'))?>
    <table class="table">
        <thead>
        <tr>
            <th>
                Инфекционная и паразитарная заболеваемость
            </th>
            <th>
                Абс.
            </th>
            <th>
                На 100 тыс. населения
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <b>Брюшной тиф</b>
            </td>
            <td>
                <?=Form::input('bru_tif', $data['bru_tif'], array("class" => "form-control", "name" => "bru_tif", "type" => "text", "autofocus" => ""))?>
            </td>
            <td>
                <?=Form::input('t_bru_tif', $data['t_bru_tif'], array("class" => "form-control", "name" => "t_bru_tif", "type" => "text"))?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Паратифы</b>
            </td>
            <td>
                <?=Form::input('paratif', $data['paratif'], array("class" => "form-control", "name" => "paratif", "type" => "text"))?>
            </td>
            <td>
                <?=Form::input('t_paratif', $data['t_paratif'], array("class" => "form-control", "name" => "t_paratif", "type" => "text"))?>
            </td>
        </tr>
        <tr>
            <td>
                паратиф С
            </td>
            <td>
                <?=Form::input('paratif_c', $data['paratif_c'], array("class" => "form-control", "name" => "paratif_c", "type" => "text"))?>
            </td>
            <td>
                <?=Form::input('t_paratif_c', $data['t_paratif_c'], array("class" => "form-control", "name" => "t_paratif_c", "type" => "text"))?>
            </td>
        </tr>
        <tr>
            <td>
                паратиф неуточненный
            </td>
            <td>
                <?=Form::input('paratif_n', $data['paratif_n'], array("class" => "form-control", "name" => "paratif_n", "type" => "text"))?>
            </td>
            <td>
                <?=Form::input('t_paratif_n', $data['t_paratif_n'], array("class" => "form-control", "name" => "t_paratif_n", "type" => "text"))?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Носительство возбудителей брюшного тифа, паратифов</b>
            </td>
            <td>
                <?=Form::input('nosit_paratif', $data['nosit_paratif'], array("class" => "form-control", "name" => "nosit_paratif", "type" => "text"))?>
            </td>
            <td>
                <?=Form::input('t_nosit_paratif', $data['t_nosit_paratif'], array("class" => "form-control", "name" => "t_nosit_paratif", "type" => "text"))?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">
                <?=Form::button('button', 'Сохранить', array("id" => "send_infect_illness", "class" => "btn btn-primary"))?>
            </td>
        </tr>
        </tbody>
    </table>
    <?=Form::close()?>
</div>