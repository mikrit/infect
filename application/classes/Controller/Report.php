<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Report extends Controller_Base
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

		$titles = ORM::factory('info')->find_all();

		$view = View::factory('report/index');
		$view->years = $years;
		$view->r_year_begin = $r_year_begin;
		$view->r_year_end = $r_year_end;

		$view_list = View::factory('report/list');
		$view_list->titles = $titles;
		$view_list->table = 'info';

		$view->list = $view_list->render();

		$this->template->content = $view->render();
	}

	public function action_eimport()
	{
		$use = 6;
		$files = array(
			1 => 'ambulathelp.xlsx',
			2 => 'gepatid.xlsx',
			3 => 'info.xlsx',
			4 => 'kdc.xlsx',
			5 => 'spid.xlsx',
			6 => 'stachelp.xlsx'
		);

		$models = array(
			1 => 'dataambulathelp',
			2 => 'datagepatid',
			3 => 'datainfo',
			4 => 'datakdc',
			5 => 'dataspid',
			6 => 'datastachelp'
		);


		$spreadsheet = Spreadsheet::factory(array(
			'path'     => 'C:/http/infect/excel/sfo/',
			'filename' => $files[$use]
		), FALSE)->load()->read();

		$data = array();
		$regs = array();
		$years = array();

		foreach($spreadsheet as $el => $rows)
		{
			$reg = '';
			$infect = '';
			foreach($rows as $key => $val)
			{
				if($el == 1)
				{
					if($key != 'A' && $key != 'B')
					{
						if($val == NULL)
						{
							$val = $reg;
						}
						else
						{
							$reg = $val;
						}

						$regs[$key] = $val;
					}
				}
				elseif($el == 2)
				{
					$years[$key] = $val;
				}
				else
				{
					if($key == 'A')
					{
						$infect = $val;
					}
					elseif($key != 'A' && $key != 'B')
					{
						$val = is_float($val) ? $val : 0;

						$data[$regs[$key]][$years[$key]][$infect] = round($val, 2);
					}
				}
			}
		}

		$regionsO = ORM::factory('subject')->where('district_id', '=', '7')->find_all();
		$regions = array();
		foreach($regionsO as $r)
		{
			$regions[$r->title] = array($r->district->id, $r->id);
		}

		foreach($data as $r => $rr)
		{
			foreach($rr as $y => $yy)
			{
				foreach($yy as $t => $elem)
				{
					if($elem != 0)
					{
						 var_dump((int)$regions[$r][0], (int)$regions[$r][1], (int)$y, (int)$t, $elem);

					/*	$datainfo = ORM::factory($models[$use]);

						$datainfo->elem_id = (int)$t;
						$datainfo->value = (float)$elem;
						$datainfo->year = (int)$y;
						$datainfo->district_id = (int)$regions[$r][0];
						$datainfo->subject_id = (int)$regions[$r][1];

						$datainfo->save();*/

					}
				}
			}
		}

		die;
	}
}
