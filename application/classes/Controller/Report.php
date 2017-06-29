<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Report extends Controller_Base
{
	public function action_index()
	{
		$view = View::factory('report/index');

		$this->template->content = $view->render();
	}
}
