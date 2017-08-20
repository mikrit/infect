<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base
{
	public function action_index()
	{
		$year_now = date('Y');

		$years = array();
		for($i = 2016; $i <= $year_now; $i++)
		{
			$years[$i] = $i;
		}

		$user = Auth::instance()->get_user();

		$user_district = $user->district_id;
		$district_id = $user->district_id;
		if($user_district == 0)
		{
			$districts = ORM::factory('district')->find_all()->as_array('id', 'title');
			$district_id = 1;
		}
        else
        {
            $districts = ORM::factory('district')->where('id', '=', $user_district)->find_all()->as_array('id', 'title');
        }

		$user_subject = $user->subject_id;
		$subject_id = $user->subject_id;
		if($user_subject == 0)
		{
			$subjects = ORM::factory('subject')->where('district_id', '=', 1)->find_all()->as_array('id', 'title');
			$subject_id = 1;
		}
        else
        {
            $subjects = ORM::factory('subject')->where('district_id', '=', $user_district)->find_all()->as_array('id', 'title');
        }

		$data_O = ORM::factory('datainfect')->where('district_id', '=', $district_id)->and_where('subject_id', '=', $subject_id)->and_where('year', '=', $year_now)->find_all();

		$data = array();
		foreach($data_O as $elem)
		{
			$data[$elem->infect_id] = array($elem->value, $elem->value_100);
		}

		if(count($_POST))
		{
			var_dump($_POST);die;
		}

		$view = View::factory('data/index');

		$view->year_now = $year_now;
		$view->years = $years;

		$view->districts = $districts;
		$view->district_id = $district_id;
		$view->user_district = $user_district;

		$view->subjects = $subjects;
		$view->subject_id = $subject_id;
		$view->user_subject = $user_subject;

		//------- panel1 -------------
		$view_panel1 = View::factory('data/tabs/panel1');

		$infects = ORM::factory('infect')->find_all();

		$view_panel1->infects = $infects;
		$view_panel1->data = $data;

		$view_panel1->year_now = $year_now;
		$view_panel1->district_id = $district_id;
		$view_panel1->subject_id = $subject_id;

		$view->panel1 = $view_panel1->render();


		$this->template->content = $view->render();
	}
}
