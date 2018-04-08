<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Report extends Controller_Base
{
	public function action_index()
	{
        $spreadsheet = Spreadsheet::factory(
            array(
                'path' => 'D:/qwerty/',
                'filename' => 'szfo_infect.xlsx'
            ), FALSE)
            ->load()
            ->read();

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
                    if($key != 'A')
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
                    else
                    {
                        $val = is_float($val) ? $val : 0;

                        $data[$regs[$key]][$years[$key]][$infect] = number_format($val, 2, '.', ' ');
                    }
                }
            }
        }

       // var_dump($data);
        
        //die;
		$view = View::factory('report/index');

		$this->template->content = $view->render();
	}
}
