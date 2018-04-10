<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Base
{
	public function action_index()
	{
		$today_p = new DateTime();
		$date = $today_p->modify('-3 month')->format('Y');

		$r_year_begin = $date - 2;
		$r_year_end = $date - 1;

		$years = array();
		for($i = 2015; $i <= $date; $i++)
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
			//$data_O = DB::select('id', 'elem_id', array(DB::expr('SUM(`value`)'), 'value'), 'yesno')->where('year', 'BETWEEN', array($r_year_begin, $r_year_end))->from('datainfects')->group_by('elem_id')->execute();
			$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
		}
		else
		{
			if($subject_id == 0)
			{
				//$data_O = DB::select('id', 'elem_id', array(DB::expr('SUM(`value`)'), 'value'), 'yesno')->where('district_id', '=', $district_id)->and_where('year', 'BETWEEN', array($r_year_begin, $r_year_end))->from('datainfects')->group_by('elem_id')->execute();
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE district_id = ' . $district_id . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			}
			else
			{
				//$data_O = DB::select('id', 'elem_id', array(DB::expr('SUM(`value`)'), 'value'), 'yesno')->where('district_id', '=', $district_id)->and_where('subject_id', '=', $subject_id)->and_where('year', 'BETWEEN', array($r_year_begin, $r_year_end))->from('datainfects')->group_by('elem_id')->execute();
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE district_id = ' . $district_id . ' AND subject_id = ' . $subject_id . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			}
		}

		$infoO = ORM::factory('info')->find_all();
		$formuls = array();
		foreach($infoO as $elem)
		{
			if($elem->formula != '')
			{
				$formuls[$elem->id] = $elem->formula;
			}
		}

		$data = array();
		foreach($data_O as $elem)
		{
			$data[$elem['year']][$elem['elem_id']]['value'] = $elem['value'];
		}

		foreach($data as $year => $dd)
		{
			foreach($dd as $e_id => $val)
			{
				if(isset($formuls[$e_id]))
				{
					$formula = $formuls[$e_id];

					/*preg_match_all('/infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+/', $formula, $arr);

					foreach($arr[0] as $elem)
					{
						$massiv = explode('_', $elem);

						$dataO = ORM::factory('data'.$massiv[0])->where('district_id', '=', $district_id)->and_where('subject_id', '=', $subject_id)->and_where('year', '=', $year)->and_where('elem_id', '=', (int)$massiv[1])->find_all();

						$value = 0;
						if(isset($dataO[0]->value) && $dataO[0]->value != NULL)
						{
							$value = $dataO[0]->value;
						}

						$formula = str_replace($elem, $value, $formula);
					}*/


					preg_match_all('/id\d+/', $formula, $arr);

					foreach($arr as $elem)
					{
						foreach($elem as $el)
						{
							preg_match_all('/\d+/', $el, $dd);

							$formula = str_replace('id'.$dd[0][0], $data[$year][$dd[0][0]]['value'], $formula);
						}
					}

					if(@eval("\$result = $formula;") === FALSE)
					{
						$result = 0;
					}

					if($result == INF)
					{
						$result = 0;
					}

					$data[$year][$e_id]['value'] = $result;
				}
			}
		}

		$titles = ORM::factory('info')->find_all();

		$view = View::factory('main/index');

		$view->years = $years;
		$view->r_year_begin = $r_year_begin;
		$view->r_year_end = $r_year_end;

		$view->districts = $districts;
		$view->district_id = $district_id;
		$view->user_district = $user_district;

		$view->subjects = $subjects;
		$view->subject_id = $subject_id;
		$view->user_subject = $user_subject;

		$view_list = View::factory('main/list');
		$view_list->titles = $titles;
		$view_list->data = $data;
		$view_list->table = 'info';
		$view_list->title = 'Инф служба';
		$view_list->r_year_begin = $r_year_begin;
		$view_list->r_year_end = $r_year_end;
		$view_list->district_id = $district_id;
		$view_list->subject_id = $subject_id;

		$view->list = $view_list->render();

		$this->template->content = $view->render();
	}
}
