<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base
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
			$districts = array_merge(array(0 => 'Все'), ORM::factory('district')->find_all()->as_array('id', 'title'));
			$district_id = 0;
		}
		else
		{
			$districts = ORM::factory('district')->where('id', '=', $district_id)->find_all()->as_array('id', 'title');
		}

		$user_subject = $user->subject_id;
		$subject_id = $user->subject_id;
		if($user_subject == 0)
		{
			$subjects = array(0 => 'Все');
			$subjectsO = ORM::factory('subject')->where('district_id', '=', $district_id)->find_all()->as_array('id', 'title');
			foreach($subjectsO as $key => $val)
			{
				$subjects[$key] = $val;
			}

			$subject_id = 0;
		}
		else
		{
			$subjects = ORM::factory('subject')->where('id', '=', $subject_id)->find_all()->as_array('id', 'title');
		}

		if($district_id == 0)
		{
			$list = ORM::factory('datainfect')->where('year', '=', $year_now)->find_all();
		}
		else
		{
			if($subject_id == 0)
			{
				$list = ORM::factory('datainfect')->where('district_id', '=', $district_id)->andwhere('year', '=', $year_now)->find_all();
			}
			else
			{
				$list = ORM::factory('datainfect')->where('district_id', '=', $district_id)->andwhere('subject_id', '=', $subject_id)->andwhere('year', '=', $year_now)->find_all();
			}
		}

		$view = View::factory('main/index');

		$view->year_now = $year_now;
		$view->years = $years;

		$view->districts = $districts;
		$view->district_id = $district_id;
		$view->user_district = $user_district;

		$view->subjects = $subjects;
		$view->subject_id = $subject_id;
		$view->user_subject = $user_subject;

		$view_list = View::factory('main/list');
		$view_list->list = $list;

		$view->list = $view_list->render();

		$this->template->content = $view->render();
	}
}
