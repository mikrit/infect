<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base
{
	public function action_index()
	{
		$view = View::factory('main/index');

		$this->template->content = $view->render();
	}
} // End Welcome
