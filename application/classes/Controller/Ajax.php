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

		echo json_encode(array('result' => $select));
	}

    public function  action_change_year()
    {
        $infect_O = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

        $data = array();

        echo json_encode(array('result' => $data));
    }

	public function  action_add_infect_element()
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
}