<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

    public function action_change_district()
    {
        if($_POST['district_id'] != 0)
        {
            $subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

            $subjects = array(0 => 'Нет');
            foreach($subjects_o as $subject)
            {
                $subjects[$subject->id] = $subject->title;
            }

            $select = Form::select('subject_id', $subjects, 0, array('class' => 'form-control', 'id' => 'subject'));
        }
        else
        {
            $select = Form::select('subject_id', array(0 => 'Нет'), 0, array('class' => 'form-control', 'id' => 'subject'));
        }

        echo json_encode(array('result' => $select));
    }

	public function action_change_district2()
	{
		$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

		foreach($subjects_o as $subject)
		{
			$subjects[$subject->id] = $subject->title;
		}

		$select = Form::select('subject_id', $subjects, 0, array('class' => 'form-control', 'id' => 'subject'));

        $select .= "<script>
                        $('select').select2({
                            language: 'ru',
                            width: '100%'
                        });
                    </script>";

		echo json_encode(array('result' => $select));
	}

    public function action_add_element()
    {
        $table = $_POST['table'];

        $infect = ORM::factory('data'.$table, array(
            'elem_id' => $_POST['elem_id'],
            'district_id' => $_POST['district_id'],
            'subject_id' =>$_POST['subject_id'],
            'year' => $_POST['year']));

        if($_POST['type'] == 0)
        {
            $infect->value = $_POST['value'];
        }
        else
        {
            $infect->value_100 = $_POST['value'];
        }

        if($infect->id == NULL)
        {
            $infect->elem_id = $_POST['elem_id'];
            $infect->year = $_POST['year'];
            $infect->district_id = $_POST['district_id'];
            $infect->subject_id = $_POST['subject_id'];
        }

        $infect->save();
    }

    public function action_change_data()
    {
        $tabs = array(
            'infect' => 'Инфекционная заболеваемость',
            'info' => 'Инф служба',
            'stachelp' => 'Стац помощь',
            'spid' => 'СПИД-центры',
            'ambulathelp' => 'Амбулат помощь',
            'kdc' => 'КДЦ',
            'gepatid' => 'Вирусные гепатиты',
        );

        $data_O = ORM::factory('data'.$_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();

        $data = array();
        foreach($data_O as $el_data)
        {
            if($_POST['table'] == 'infect')
            {
                $data[$el_data->elem_id] = array($el_data->value, $el_data->value_100);
            }
            else
            {
                $data[$el_data->elem_id] = array($el_data->value);
            }
        }

        $view_panel = View::factory('data/panel');

        $titles = ORM::factory($_POST['table'])->find_all();

        $view_panel->titles = $titles;
        $view_panel->data = $data;

        $view_panel->title = $tabs[$_POST['table']];

        $view_panel->table = $_POST['table'];
        $view_panel->year_now = $_POST['year'];
        $view_panel->district_id = $_POST['district_id'];
        $view_panel->subject_id = $_POST['subject_id'];

        echo json_encode(array('panel' => $view_panel->render()));
    }
}