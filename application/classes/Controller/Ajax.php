<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{
	/** ---------- Begin Data ---------- */

	public function action_change_data()
	{
		echo $this->get_change_data();
	}

	public function get_change_data()
	{
		$tabs = array(
			'infect' => 'Инфекционная заболеваемость',
			'info' => 'Инф служба',
			'stachelp' => 'Стац помощь',
			'spid' => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc' => 'КДЦ',
			'gepatid' => 'Вирусные гепатиты',
		);

		$data_O = ORM::factory('data' . $_POST['table'])->where('district_id', '=', $_POST['district_id'])->and_where('subject_id', '=', $_POST['subject_id'])->and_where('year', '=', $_POST['year'])->find_all();

		$data = array();
		foreach ($data_O as $el_data) {
			$data[$el_data->elem_id] = $el_data->value;
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

		return json_encode(array('panel' => $view_panel->render()));
	}

	public function action_change_district2()
	{
		$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

		foreach ($subjects_o as $subject) {
			$subjects[$subject->id] = $subject->title;
		}

		$select = Form::select('subject_id', $subjects, 0, array('class' => 'form-control', 'id' => 'subject'));

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
		foreach ($data_O as $el_data) {
			$data['id'.$el_data->elem_id] = $el_data->value;
		}

		$arr_data = array(
			'district_id' => $_POST['district_id'],
			'subject_id' => $_POST['subject_id'],
			'year' => $_POST['year']
		);
		$this->calc($table, $_POST['elem_id'], $data, $arr_data);

		echo $this->get_change_data();
	}

	public function elem_add_or_edit($post, $table)
	{
		$elem = ORM::factory('data'.$table, array(
			'elem_id' => $post['elem_id'],
			'district_id' => $post['district_id'],
			'subject_id' => $post['subject_id'],
			'year' => $post['year']
			)
		);

		$elem->value = $post['value'];

		if ($elem->id == NULL) {
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

				if(@eval("\$result = $formula;")===FALSE){
					$result = 0;
				}

				$arr_data['elem_id'] = $id;
				$arr_data['value'] = $result;

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
			'infect' => 'Инфекционная заболеваемость',
			'info' => 'Инф служба',
			'stachelp' => 'Стац помощь',
			'spid' => 'СПИД-центры',
			'ambulathelp' => 'Амбулат помощь',
			'kdc' => 'КДЦ',
			'gepatid' => 'Вирусные гепатиты',
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
		if ($_POST['district_id'] != 0) {
			$subjects_o = ORM::factory('subject')->where('district_id', '=', $_POST['district_id'])->find_all()->as_array();

			$subjects = array(0 => 'Нет');
			foreach ($subjects_o as $subject) {
				$subjects[$subject->id] = $subject->title;
			}

			$select = Form::select('subject_id', $subjects, 0, array('class' => 'form-control', 'id' => 'subject'));
		} else {
			$select = Form::select('subject_id', array(0 => 'Нет'), 0, array('class' => 'form-control', 'id' => 'subject'));
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

		$elem = ORM::factory($table, $_POST['elem_id']);

		$elem->formula = $_POST['formula'];
		$elem->save();
	}
	/** ---------- End Adminka ---------- */
}