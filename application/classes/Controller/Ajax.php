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

            $select = Form::select('subject', $subjects, 0, array('class' => 'form-control', 'id' => 'subject'));
        }
        else
        {
            $select = Form::select('subject', array(0 => 'Нет'), 0, array('class' => 'form-control', 'id' => 'subject'));
        }

        echo json_encode(array('result' => $select));
    }
}