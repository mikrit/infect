<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Report extends Controller_Base
{
	public function action_index()
	{
		$spreadsheet = Spreadsheet::factory(array(
			'path'     => 'C:/http/infect/excel/',
			//'filename' => 'szfo_infect.xlsx'
			'filename' => 'szfo_stac.xlsx'
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

		$regionsO = ORM::factory('subject')->where('district_id', '=', '2')->find_all();
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
						//var_dump((int)$regions[$r][0], (int)$regions[$r][1], (int)$y, (int)$t, $elem);

						/*$datainfo = ORM::factory('datastachelp');

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
		$view = View::factory('report/index');

		$this->template->content = $view->render();
	}
}
