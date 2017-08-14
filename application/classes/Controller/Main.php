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

		$view = View::factory('main/index');

		$view->year_now = $year_now;
		$view->years = $years;

		$this->template->content = $view->render();
	}
}
