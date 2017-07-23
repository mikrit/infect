<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Data extends Controller_Base
{
	public function action_index()
	{
        $year_now = date('Y');
        $years = array();
        for($i = 2015; $i <= $year_now; $i++)
        {
            $years[$i] = $i;
        }

		if(count($_POST))
		{
			var_dump($_POST);die;
		}

        $view = View::factory('data/index');
        $view->year_now = $year_now;
        $view->years = $years;

        $view_panel1 = View::factory('data/tabs/panel1');
        $infect_ORM = ORM::factory('infect')->where('year', '=', $year_now)->find_all();

        $infect = array();
        foreach($infect_ORM as $elem)
        {
            $infect[$elem->title] = $elem->value;
        }

        $view_panel1->data = $infect;

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
