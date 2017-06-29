<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base
{
	public function action_index()
	{
		$view = View::factory('data/index');

		$this->template->content = $view->render();
	}
}
