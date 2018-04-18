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
		for($i = 2016; $i <= $date; $i++)
		{
			$years[$i] = $i;
		}

		$user = Auth::instance()->get_user();

		$district_id = $user->district_id;
		if($district_id == 0)
		{
			$districts = array_merge(array(0 => 'Все'), ORM::factory('district')->find_all()->as_array('id', 'title'));
		}
		else
		{
			$districts = ORM::factory('district')->where('id', '=', $district_id)->find_all()->as_array('id', 'title');
		}

		$subject_id = $user->subject_id;
		if($subject_id == 0)
		{
			$subjects = array(0 => 'Все');
			$subjectsO = ORM::factory('subject')->where('district_id', '=', $district_id)->find_all()->as_array('id', 'title');
			foreach($subjectsO as $key => $val)
			{
				$subjects[$key] = $val;
			}
		}
		else
		{
			$subjects = ORM::factory('subject')->where('id', '=', $subject_id)->find_all()->as_array('id', 'title');
		}

		$count_subjects = 1;
		if($district_id == 0)
		{
			$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			$count_subjects = ORM::factory('subject')->count_all();
		}
		else
		{
			if($subject_id == 0)
			{
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE district_id = ' . $district_id . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
				$count_subjects = ORM::factory('subject')->where('district_id', '=', $district_id)->count_all();
			}
			else
			{
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM datainfos WHERE district_id = ' . $district_id . ' AND subject_id = ' . $subject_id . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			}
		}

		$DataFO = ORM::factory('info')->find_all();
		$formuls = array();
		foreach($DataFO as $elem)
		{
			if($elem->formula != '')
			{
				$formuls[$elem->id] = $elem->formula;
			}
		}

		foreach($data_O as $elem)
		{
			if($elem['elem_id'] == 29 || $elem['elem_id'] == 30)
			{
				$data[$elem['year']][$elem['elem_id']]['value'] = $elem['value'] / $count_subjects;
			}
			else
			{
				$data[$elem['year']][$elem['elem_id']]['value'] = $elem['value'];
			}
		}

		for($year = $r_year_begin; $year <= $r_year_end; $year++)
		{
			foreach($formuls as $e_id => $formula)
			{
				$data[$year][$e_id]['value'] = $this->calcByFolmula($data, $formula, $year, $district_id, $subject_id);
			}
		}

		$titles = ORM::factory('info')->find_all();

		$view = View::factory('main/index');

		$view->years = $years;
		$view->r_year_begin = $r_year_begin;
		$view->r_year_end = $r_year_end;

		$view->districts = $districts;
		$view->district_id = $district_id;
		$view->user_district = $district_id;

		$view->subjects = $subjects;
		$view->subject_id = $subject_id;
		$view->user_subject = $subject_id;

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

	public function calcByFolmula($data, $formula, $year, $district_id, $subject_id)
	{
		preg_match_all('/infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+/', $formula, $arr);

		foreach($arr[0] as $elem)
		{
			$massiv = explode('_', $elem);

			if($district_id == 0)
			{
				$dataO = Database::instance()->query(Database::SELECT, 'SELECT SUM(value) as value FROM data'.$massiv[0].'s WHERE year = '.$year.' AND elem_id = '.(int)$massiv[1]);
			}
			else
			{
				if($subject_id == 0)
				{
					$dataO = Database::instance()->query(Database::SELECT, 'SELECT SUM(value) as value FROM data'.$massiv[0].'s WHERE year = '.$year.' AND district_id = '.$district_id.' AND elem_id = '.(int)$massiv[1]);
				}
				else
				{
					$dataO = Database::instance()->query(Database::SELECT, 'SELECT SUM(value) as value FROM data'.$massiv[0].'s WHERE year = '.$year.' AND district_id = '.$district_id.' AND subject_id = '.$subject_id.' AND elem_id = '.(int)$massiv[1]);
				}
			}

			$value = 0;
			if(isset($dataO[0]['value']) && $dataO[0]['value'] != NULL)
			{
				$value = $dataO[0]['value'];
			}

			$formula = str_replace($elem, $value, $formula);
		}

		preg_match_all('/id\d+/', $formula, $arr);

		foreach($arr as $elem)
		{
			foreach($elem as $el)
			{
				preg_match_all('/\d+/', $el, $dd);

				if(!isset($data[$year][$dd[0][0]]['value']))
				{
					$data[$year][$dd[0][0]]['value'] = 0;
				}
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

		return $result;
	}
}
