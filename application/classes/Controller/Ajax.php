<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{
	/** ---------- Begin Data ---------- */

	public function action_change_data_main()
	{
		$data = array();
		$tabs = array(
			//'infect'      => 'Инфекционная заболеваемость',
			'info'        => 'Инф служба',
			'stachelp'    => 'Стац помощь',
			'spid'        => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc'         => 'КДЦ',
			'gepatid'     => 'Вирусные гепатиты',
		);

		$r_year_begin = $_POST['year_begin'];
		$r_year_end = $_POST['year_end'];

		if(!isset($_POST['district_id']))
		{
			$_POST['district_id'] = 999;
		}
		elseif(!isset($_POST['subject_id']))
		{
			$_POST['subject_id'] = 999;
		}

		$user = Auth::instance()->get_user();
		$district_id = $user->district_id;
		$subject_id = $user->subject_id;

		$flag = FALSE;
		if($district_id != 0)
		{
			if($district_id == $_POST['district_id'])
			{
				if($subject_id != 0)
				{
					if($subject_id == $_POST['subject_id'])
					{
						$flag = TRUE;
					}
				}
				else
				{
					$flag = TRUE;
				}
			}
		}
		else
		{
			$flag = TRUE;
		}

		$count_subjects = 1;
		if($flag)
		{
			if($_POST['district_id'] == 0)
			{
				$_POST['subject_id'] = 0;
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM data' . $_POST['table'] . 's WHERE year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
				$count_subjects = ORM::factory('subject')->count_all();
			}
			else
			{
				if($_POST['subject_id'] == 0)
				{
					$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM data' . $_POST['table'] . 's WHERE district_id = ' . $_POST['district_id'] . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
					$count_subjects = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->count_all();
				}
				else
				{
					$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value FROM data' . $_POST['table'] . 's WHERE district_id = ' . $_POST['district_id'] . ' AND subject_id = ' . $_POST['subject_id'] . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
				}
			}

			$DataFO = ORM::factory($_POST['table'])->find_all();
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
				if($_POST['table'] == 'info' && ($elem['elem_id'] == 29 || $elem['elem_id'] == 30))
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
					$data[$year][$e_id]['value'] = $this->calcByFolmula($data, $formula, $year, $_POST['district_id'], $_POST['subject_id']);
				}
			}
		}

		$view_panel = View::factory('main/list');

		$titles = ORM::factory($_POST['table'])->find_all();

		$view_panel->titles = $titles;
		$view_panel->data = $data;
		$view_panel->title = $tabs[$_POST['table']];
		$view_panel->table = $_POST['table'];
		$view_panel->r_year_begin = $r_year_begin;
		$view_panel->r_year_end = $r_year_end;
		$view_panel->district_id = $_POST['district_id'];
		$view_panel->subject_id = $_POST['subject_id'];

		echo json_encode(array('panel' => $view_panel->render()));
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

		$formula = str_replace(',', '.', $formula);
		if(@eval("\$result = $formula;") === FALSE)
		{
			$result = 0;
		}

		if($result == INF || is_nan($result))
		{
			$result = 0;
		}

		return $result;
	}

	public function action_change_district3()
	{
		if($_POST['district_id'] == 0)
		{
			$select = Form::select('subject', array(0 => 'Все'), 0, array(
					'class'        => 'form-control',
					'disabled'     => '',
					'autocomplete' => 'off'
				));
		}
		else
		{
			$user = Auth::instance()->get_user();

			if($user->subject_id == 0)
			{
				$subjects = array(0 => 'Все');
				$subjectsO = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array('id', 'title');
				foreach($subjectsO as $key => $val)
				{
					$subjects[$key] = $val;
				}
			}
			else
			{
				$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

				foreach($subjects_o as $subject)
				{
					$subjects[$subject->id] = $subject->title;
				}
			}

			$select = Form::select('subject_id', $subjects, 0, array(
					'class' => 'form-control',
					'id'    => 'subject'
				));
		}

		$select .= "<script>
                        $('select').select2({
                            language: 'ru',
                            width: '100%'
                        });
                    </script>";

		echo json_encode(array('result' => $select));
	}

	public function action_change_data()
	{
		$tabs = array(
			//'infect'      => 'Инфекционная заболеваемость',
			'info'        => 'Инф служба',
			'stachelp'    => 'Стац помощь',
			'spid'        => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc'         => 'КДЦ',
			'gepatid'     => 'Вирусные гепатиты',
		);

		$data_O = ORM::factory('data' . $_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();

		$data = array();
		foreach($data_O as $el_data)
		{
			$data[$el_data->elem_id]['value'] = $el_data->value;
		}

		$view_panel = View::factory('data/panel');

		$titles = ORM::factory($_POST['table'])->find_all();

		$view_panel->titles = $titles;
		$view_panel->data = $data;
		$view_panel->title = $tabs[$_POST['table']];
		$view_panel->table = $_POST['table'];
		$view_panel->year_now = $_POST['year'];
		$view_panel->district_id = $_POST['district_id'];
		$view_panel->subject_id = $_POST['subject_id'];

		echo json_encode(array('panel' => $view_panel->render()));
	}

	public function action_change_district2()
	{
		$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

		foreach($subjects_o as $subject)
		{
			$subjects[$subject->id] = $subject->title;
		}

		$select = Form::select('subject_id', $subjects, 0, array(
				'class' => 'form-control',
				'id'    => 'subject'
			));

		$select .= "<script>
                        $('select').select2({
                            language: 'ru',
                            width: '100%'
                        });
                    </script>";

		echo json_encode(array('result' => $select));
	}

	public function action_add_element()
	{
		$table = $_POST['table'];

		$this->elem_add_or_edit($_POST, $table);

		$data_O = ORM::factory('data' . $_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();
		$data = array();
		foreach($data_O as $el_data)
		{
			$data['id' . $el_data->elem_id] = $el_data->value;
		}

		$arr_data = array(
			'district_id' => $_POST['district_id'],
			'subject_id'  => $_POST['subject_id'],
			'year'        => $_POST['year']
		);

		$this->calc($table, $_POST['elem_id'], $data, $arr_data);

		$data_O = ORM::factory('data' . $_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();
		$data = array();
		foreach($data_O as $el_data)
		{
			$data[$el_data->elem_id] = $el_data->value;
		}

		echo json_encode(array('result' => $data));
	}

	public function elem_add_or_edit($post, $table)
	{
		$elem = ORM::factory('data' . $table, array(
			'elem_id'     => $post['elem_id'],
			'district_id' => $post['district_id'],
			'subject_id'  => $post['subject_id'],
			'year'        => $post['year']
		));

		$elem->value = $post['value'] == '' ? NULL : $post['value'];

		if($elem->id == NULL)
		{
			$elem->elem_id = $post['elem_id'];
			$elem->value = $post['value'];
			$elem->year = $post['year'];
			$elem->district_id = $post['district_id'];
			$elem->subject_id = $post['subject_id'];
		}

		$elem->save();
	}

	public function calc($table, $elem_id, $data, $arr_data)
	{
		$formula = 0;
		$calc = ORM::factory($table, $elem_id);
		$txt = $calc->use;
		$result = 0;

		if($txt == NULL)
		{
			return;
		}
		else
		{
			$use = explode(';', $txt);

			foreach($use as $id)
			{
				$tt = explode('_', $id);
				if(count($tt) == 2)
				{
					$table = $tt[0];
					$id = $tt[1];

					$data_O = ORM::factory('data' . $table)->where('district_id', '=', $arr_data['district_id'])->and_where('subject_id', '=', $arr_data['subject_id'])->and_where('year', '=', $arr_data['year'])->find_all();
					$data = array();
					foreach($data_O as $el_data)
					{
						$data['id' . $el_data->elem_id] = $el_data->value;
					}
				}

				$f = ORM::factory($table, $id);

				$formula = $f->formula;

				preg_match_all('/infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+/', $formula, $arr);

				foreach($arr[0] as $elem)
				{
					$massiv = explode('_', $elem);

					$dataO = ORM::factory('data'.$massiv[0])->where('district_id', '=', $arr_data['district_id'])->and_where('subject_id', '=', $arr_data['subject_id'])->and_where('year', '=', $arr_data['year'])->and_where('elem_id', '=', (int)$massiv[1])->find_all();

					$value = 0;
					if(isset($dataO[0]->value) && $dataO[0]->value != NULL)
					{
						$value = $dataO[0]->value;
					}

					$formula = str_replace($elem, $value, $formula);
				}

				preg_match_all('/id\d+/', $formula, $arr);

				foreach($arr as $elem)
				{
					foreach($elem as $el)
					{
						if(isset($data[$el]))
						{
							$formula = str_replace($el, $data[$el], $formula);
						}
						else
						{
							$formula = str_replace($el, 0, $formula);
						}
					}
				}

				$formula = str_replace(',', '.', $formula);

				if($formula != '')
				{
					if(@eval("\$result = $formula;") === FALSE)
					{
						$result = 0;
					}

					if($result == INF)
					{
						$result = 0;
					}
				}

				$arr_data['elem_id'] = $id;
				$arr_data['value'] = $result;

				$data['id' . $id] = $result;

				$this->elem_add_or_edit($arr_data, $table);

				$this->calc($table, $id, $data, $arr_data);
			}
		}
	}

	/** ---------- End Data ---------- */

	/** ---------- Begin Adminka ---------- */

	public function action_change_tab()
	{
		$tabs = array(
			//'infect'      => 'Инфекционная заболеваемость',
			'info'        => 'Инф служба',
			'stachelp'    => 'Стац помощь',
			'spid'        => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc'         => 'КДЦ',
			'gepatid'     => 'Вирусные гепатиты',
		);

		$titles = ORM::factory($_POST['table'])->find_all();

		$view_panel = View::factory('adminka/panel');
		$view_panel->titles = $titles;
		$view_panel->title = $tabs[$_POST['table']];

		$view_panel->table = $_POST['table'];

		echo json_encode(array('panel' => $view_panel->render()));
	}

	public function action_change_district()
	{
		if($_POST['district_id'] != 0)
		{
			$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

			$subjects = array(0 => 'Нет');
			foreach($subjects_o as $subject)
			{
				$subjects[$subject->id] = $subject->title;
			}

			$select = Form::select('subject_id', $subjects, 0, array(
					'class' => 'form-control',
					'id'    => 'subject'
				));
		}
		else
		{
			$select = Form::select('subject_id', array(0 => 'Нет'), 0, array(
					'class' => 'form-control',
					'id'    => 'subject'
				));
		}

		echo json_encode(array('result' => $select));
	}

	public function action_edit_elem_title()
	{
		$table = $_POST['table'];

		$elem = ORM::factory($table, $_POST['elem_id']);

		$elem->title = $_POST['title'];
		$elem->save();
	}

	public function action_edit_elem_bold()
	{
		$table = $_POST['table'];

		$elem = ORM::factory($table, $_POST['elem_id']);

		$elem->bold = $_POST['value'];
		$elem->save();
	}

	public function action_edit_elem_subtitle()
	{
		$table = $_POST['table'];

		$elem = ORM::factory($table, $_POST['elem_id']);

		$elem->subtitle = $_POST['value'];
		$elem->save();
	}

	public function action_edit_elem_formula()
	{
		$table = $_POST['table'];

		preg_match_all('/id\d+/', $_POST['formula'], $arr);

		foreach($arr as $ids)
		{
			foreach($ids as $id)
			{
				preg_match_all('/\d+/', $id, $elem);

				$elem = ORM::factory($table, $elem[0][0]);

				if($elem->use == NULL)
				{
					$elem->use = $_POST['elem_id'];
				}
				else
				{
					$elem->use .= ';'.$_POST['elem_id'];
				}

				$elem->save();
			}
		}

		$elem = ORM::factory($table, $_POST['elem_id']);
		$elem->formula = $_POST['formula'];
		$elem->save();
	}
	/** ---------- End Adminka ---------- */

	public function action_change_data_report()
	{
		$data = array();
		$tabs = array(
			'info'        => 'Инф служба',
			'stachelp'    => 'Стац помощь',
			'spid'        => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc'         => 'КДЦ',
			'gepatid'     => 'Вирусные гепатиты'
		);

		if(!isset($_POST['district_id']))
		{
			$_POST['district_id'] = 999;
		}
		elseif(!isset($_POST['subject_id']))
		{
			$_POST['subject_id'] = 999;
		}

		$view_panel = View::factory('report/list');

		$titles = ORM::factory($_POST['table'])->find_all();

		$view_panel->titles = $titles;
		$view_panel->data = $data;
		$view_panel->title = $tabs[$_POST['table']];
		$view_panel->table = $_POST['table'];

		echo json_encode(array('panel' => $view_panel->render()));
	}

	public function action_get_data_chart()
	{
		$distr = array(
			0 => 'Россия',
			1 => 'ЦФО',
			2 => 'СЗФО',
			3 => 'ЮФО',
			4 => 'СКФО',
			5 => 'ПФО',
			6 => 'УрФО',
			7 => 'СибФО',
			8 => 'ДФО',
		);

		$post_ar = array();
		foreach($_POST['data'] as $elem)
		{
			if($elem['name'] == 'categorie')
			{
				$post_ar[$elem['name']][] = $elem['value'];
			}
			else
			{
				$post_ar[$elem['name']] = $elem['value'];
			}
		}

		if(!isset($post_ar['year_end']))
		{
			$post_ar['year_end'] = $post_ar['year_begin'];
		}

		$years = array();
		for($i = $post_ar['year_begin']; $i <= $post_ar['year_end']; $i++)
		{
			$years[] = (string)$i;
		}

		$data = array();
		$data1 = array();
		if($post_ar['charts'] == 0 || $post_ar['charts'] == 1 || $post_ar['charts'] == 2 || $post_ar['charts'] == 3)
		{
			$categories = implode(', ', $post_ar['categorie']);

			$categ_O = Database::instance()->query(Database::SELECT, 'SELECT id, title FROM '.$post_ar['table'].'s WHERE id IN ('.$categories.')');
			$categ = array();
			foreach($categ_O as $elem)
			{
				$categ[$elem['id']] = $elem['title'];
			}

			$data_O = Database::instance()->query(Database::SELECT, 'SELECT year, district_id, elem_id, SUM(value) as value
																						FROM data' . $post_ar['table'] . 's
																							WHERE year BETWEEN ' . $post_ar['year_begin'] . ' AND ' . $post_ar['year_end'] . '
																								AND elem_id IN ('.$categories.')
																							GROUP BY year, district_id, elem_id');

			if(count($post_ar['categorie']) == 1)
			{
				$data[] = array_merge(array('Округа'), $years);
			}
			else
			{
				$years2 = array();
				foreach($years as $y)
				{
					foreach($categ as $c)
					{
						$years2[] = $c.' '.$y;
					}
				}

				$data[] = array_merge(array('Округа'), $years2);
			}

			foreach($data_O as $elem)
			{
				if(!isset($data1[0][$elem['year']][$elem['elem_id']]))
				{
					$data1[0][$elem['year']][$elem['elem_id']] = (float)$elem['value'];
				}
				else
				{
					$data1[0][$elem['year']][$elem['elem_id']] += (float)$elem['value'];
				}

				$data1[$elem['district_id']][$elem['year']][$elem['elem_id']] = (float)$elem['value'];
			}

			foreach($distr as $key => $d)
			{
				if($post_ar['charts'] == 3 && $key == 0)
				{
					continue;
				}

				$tmp = array();
				foreach($years as $y)
				{
					foreach($categ as $c => $c_val)
					{
						if(isset($data1[$key][$y][$c]))
						{
							$tmp[] = $data1[$key][$y][$c];
						}
						else
						{
							$tmp[] = 0;
						}
					}
				}
				$data[] = array_merge(array($d), $tmp);
			}
		}
		else
		{
			$categories = implode(', ', $post_ar['categorie']);

			$categ_O = Database::instance()->query(Database::SELECT, 'SELECT id, title FROM '.$post_ar['table'].'s WHERE id IN ('.$categories.')');
			$categ = array();
			foreach($categ_O as $elem)
			{
				$categ[$elem['id']] = $elem['title'];
			}

			$data_O = Database::instance()->query(Database::SELECT, 'SELECT year, elem_id, SUM(value) as value
																						FROM data'.$post_ar['table'].'s
																							WHERE year = '.$post_ar['year_begin'].'
																								AND elem_id IN ('.$categories.')
																							GROUP BY year, elem_id');

			$data[] = array('Категории', 'num');

			foreach($data_O as $elem)
			{
				$data[] = array($categ[$elem['elem_id']], (float)$elem['value']);
			}
		}

		echo json_encode(array('title' => $post_ar['title'], 'data' => $data, 'chart' => $post_ar['charts']));
	}

	public function action_update_data()
	{
		$tables = array(
			'info',
			'stachelp',
			'spid',
			'ambulathelp',
			'kdc',
			'gepatid'
		);

		foreach($tables as $table)
		{
			$data_O = Database::instance()->query(Database::SELECT, 'SELECT * FROM data'.$table.'s as d
																							JOIN '.$table.'s as e ON e.id = d.elem_id
																							WHERE e.formula = \'\'');

			$count = 0;
			foreach($data_O as $elem)
			{
				$post = array(
					'table' => $table,
					'elem_id' => $elem['elem_id'],
					'year' => $elem['year'],
					'district_id' => $elem['district_id'],
					'subject_id' => $elem['subject_id'],
					'value' => $elem['value'],
				);

				$this->elem_add_or_edit($post, $table);

				$data_O = ORM::factory('data' . $post['table'])->where('district_id', '=', $post['district_id'])->and_where('subject_id', '=', $post['subject_id'])->and_where('year', '=', $post['year'])->find_all();
				$data = array();
				foreach($data_O as $el_data)
				{
					$data['id' . $el_data->elem_id] = $el_data->value;
				}

				$arr_data = array(
					'district_id' => $post['district_id'],
					'subject_id'  => $post['subject_id'],
					'year'        => $post['year']
				);

				$this->calc($table, $post['elem_id'], $data, $arr_data);

				$count++;
			}

			var_dump($table, $count);
		}

		die;
	}
}