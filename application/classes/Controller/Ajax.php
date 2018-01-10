<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{
	/** ---------- Begin Data ---------- */

	public function action_change_data_main()
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

		$r_year_begin = $_POST['year_begin'];
		$r_year_end = $_POST['year_end'];

		if(!isset($_POST['district_id']))
		{
			$_POST['district_id'] = 0;
		}
		elseif(!isset($_POST['subject_id']))
		{
			$_POST['subject_id'] = 0;
		}

		if($_POST['district_id'] == 0)
		{
			$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value, yesno FROM data' . $_POST['table'] . 's WHERE year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
		}
		else
		{
			if($_POST['subject_id'] == 0)
			{
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value, yesno FROM data' . $_POST['table'] . 's WHERE district_id = ' . $_POST['district_id'] . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			}
			else
			{
				$data_O = Database::instance()->query(Database::SELECT, 'SELECT id, year, elem_id, SUM(value) as value, yesno FROM data' . $_POST['table'] . 's WHERE district_id = ' . $_POST['district_id'] . ' AND subject_id = ' . $_POST['subject_id'] . ' AND year BETWEEN ' . $r_year_begin . ' AND ' . $r_year_end . ' GROUP BY year, elem_id');
			}
		}

		$data = array();
		foreach($data_O as $elem)
		{
			$data[$elem['year']][$elem['elem_id']]['value'] = $elem['value'];
			$data[$elem['year']][$elem['elem_id']]['yesno'] = $elem['yesno'];
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
			$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

			foreach($subjects_o as $subject)
			{
				$subjects[$subject->id] = $subject->title;
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
			$data[$el_data->elem_id]['yesno'] = $el_data->yesno;
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

		die;

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
		$calc = ORM::factory($table, $elem_id);
		$txt = $calc->use;

		if($txt == NULL)
		{
			return;
		}
		else
		{
			$use = explode(';', $txt);

			foreach($use as $id)
			{
				$f = ORM::factory($table, $id);

				$formula = $f->formula;

				preg_match_all('/infect_\d+|info_\d+|stachelp_\d+|spid_\d+|ambulathelp_\d+|kdc_\d+|gepatid_\d+/', $formula, $arr);

				foreach($arr[0] as $elem)
				{
					$massiv = explode('_', $elem);
					$dataO = ORM::factory('data'.$massiv[0])->where('district_id', '=', $arr_data['district_id'])->and_where('subject_id', '=', $arr_data['subject_id'])->and_where('year', '=', $arr_data['year'])->and_where('elem_id', '=', (int)$massiv[1])->find_all();

					$value = 0;
					if($dataO[0]->value != NULL)
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

				if(@eval("\$result = $formula;") === FALSE)
				{
					$result = 0;
				}

				if($result == INF)
				{
					$result = 0;
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

	public function action_edit_elem_yesno()
	{
		$table = $_POST['table'];

		$elem = ORM::factory($table, $_POST['elem_id']);

		$elem->yesno = $_POST['value'];
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
}