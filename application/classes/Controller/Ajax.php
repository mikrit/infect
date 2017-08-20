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

    public function action_infect_element()
    {
        $infect = ORM::factory('datainfect', array(
            'infect_id' => $_POST['infect_id'],
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
            $infect->infect_id = $_POST['infect_id'];
            $infect->year = $_POST['year'];
            $infect->district_id = $_POST['district_id'];
            $infect->subject_id = $_POST['subject_id'];
        }

        $infect->save();
    }

	public function action_change_datainfect()
	{
		$data_O = ORM::factory('datainfect')->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();

		$data = array();
		foreach($data_O as $elem)
		{
			$data[$elem->infect_id] = array($elem->value, $elem->value_100);
		}

		$view_panel1 = View::factory('data/tabs/panel1');

		$infects = ORM::factory('infect')->find_all();

		$view_panel1->infects = $infects;
		$view_panel1->data = $data;

		$view_panel1->year_now = $_POST['year'];
		$view_panel1->district_id = $_POST['district_id'];
		$view_panel1->subject_id = $_POST['subject_id'];

		echo json_encode(array('panel1' => $view_panel1->render()));
	}

    public function action_change_data()
    {
        $tabs = array(
            'infect' => 'panel1',
            'info' => 'panel1',
            'stachelp' => 'panel1',
            'spid' => 'panel1',
            'ambulathelp' => 'panel1',
            'kdc' => 'panel1',
            'gepatid' => 'panel1',
        );


        $data_O = ORM::factory('data'.$_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();

        $data = array();
        foreach($data_O as $elem)
        {
            $data[$elem->infect_id] = array($elem->value, $elem->value_100);
        }

        $view_panel = View::factory('data/tabs/'.$tabs[$_POST['table']]);

        $infects = ORM::factory('infect')->find_all();

        $view_panel->infects = $infects;
        $view_panel->data = $data;

        $view_panel->year_now = $_POST['year'];
        $view_panel->district_id = $_POST['district_id'];
        $view_panel->subject_id = $_POST['subject_id'];

        echo json_encode(array('panel' => $view_panel->render()));
    }
}