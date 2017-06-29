<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base
{
	public function action_index()
	{
		if(count($_POST))
		{
			var_dump($_POST);die;
		}

		$view = View::factory('data/index');

		$this->template->content = $view->render();
	}
}
