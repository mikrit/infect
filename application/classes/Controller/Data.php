<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base
{
	public function action_index()
	{
		$user = Auth::instance()->get_user();

		$year_now = date('Y');
		$district_id = 1;
		$subject_id = 18;

		$years = array();
		for($i = 2015; $i <= $year_now; $i++)
		{
			$years[$i] = $i;
		}

		if(count($_POST))
		{
			var_dump($_POST);die;
		}

		$districts = ORM::factory('district')->find_all()->as_array('id', 'title');
		$subjects = ORM::factory('subject')->where('district_id', '=', 1)->find_all()->as_array('id', 'title');

		$view = View::factory('data/index');

		$view->user_district = $user->district_id;
		$view->user_subject = $user->subject_id;

		$view->year_now = $year_now;
		$view->years = $years;

		$view->districts = $districts;
		$view->district_id = $district_id;

		$view->subjects = $subjects;
		$view->subject_id = $subject_id;

		$view_panel1 = View::factory('data/tabs/panel1');

		$inputs = ORM::factory('infect')->find_all();

		$view_panel1->inputs = $inputs;

		$view_panel2 = View::factory('data/tabs/panel2');
		$view_panel3 = View::factory('data/tabs/panel3');
		$view_panel4 = View::factory('data/tabs/panel4');
		$view_panel5 = View::factory('data/tabs/panel5');
		$view_panel6 = View::factory('data/tabs/panel6');
		$view_panel7 = View::factory('data/tabs/panel7');

		$view->panel1 = $view_panel1->render();
		$view->panel2 = $view_panel2->render();
		$view->panel3 = $view_panel3->render();
		$view->panel4 = $view_panel4->render();
		$view->panel5 = $view_panel5->render();
		$view->panel6 = $view_panel6->render();
		$view->panel7 = $view_panel7->render();

		$this->template->content = $view->render();
	}
}
