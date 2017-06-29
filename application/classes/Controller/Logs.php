<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Logs extends Controller_Base
{
	public function action_index()
	{
		$view = View::factory('logs/index');

		$this->template->content = $view->render();
	}
}
