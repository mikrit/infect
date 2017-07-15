<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Adminka extends Controller_Base
{
	public function __construct(Request $request, Response $response)
	{
		parent::__construct($request, $response);
		
		if(!ORM::factory('user', Auth::instance()->get_user()->id)->has('roles', ORM::factory('role', 2)))
			$this->redirect('search');
	}

    public function action_list_users() //обработать удаление
    {
        $users = ORM::factory('user')->find_all();

        $view_users = View::factory('adminka/list_users');
        $view_users->users = $users;

        $this->template->content = $view_users->render();
    }
	
	public function action_register()
	{
		$errors = array();
		$message = "";
		
		$data['username'] = '';
		$data['fio'] = '';
		$data['position'] = '';
		$data['email'] = '';

		if ($_POST)
		{
			$user = ORM::factory('user');
			
			$post = Model_User::validation_n($_POST);
			
			$data = $_POST;
			
			$user_unique = ORM::factory('user')->where('username', '=', $data['username'])->count_all();
			
			if (!$post->check())
			{
				$errors = $post->errors('projects/mes');
			}
			elseif($user_unique > 0)
			{
				$errors[] = 'Этот логин уже существует';
			}
			else
			{	
				$user->create_user($_POST, array('username', 'email', 'fio', 'password'));
				$user->add('roles', ORM::factory('role', 1));
				
				/*$mess = 'You are logged in "Jadran"<br/>
				
Your login: '.$_POST['username'].'<br/>
Your password: '.$_POST['password'].'<br/>

Enjoy your work.';
*/				
				//Http::send_letter($_POST['email'], 'Registration user', $mess);

				//Нужна переброска на Form если пришли от туда и сохранять данные
				$this->redirect('adminka/list_users/'.$user->id);

				//$message = "User added successfully";
			}
		}
	
		$view_user = View::factory('adminka/register');
		
		$view_user->data = $data;
		$view_user->errors = $errors;
		$view_user->message = $message;
	
		$this->template->content = $view_user->render();
	}
	
	public function action_update_user()
	{
		$id = $this->request->param('id');
		$user = ORM::factory('user', $id);
		
		if(!$user->loaded())
			$this->redirect('adminka/list_users');
			
		$errors = array();
		$message = '';
		
		$admin = $user->has('roles', ORM::factory('role', 2));
		
		if($_POST)
		{
			if($_POST['prov'] == 1)
			{
				$data = $_POST;
				$post = Model_User::validation_up1($_POST);
			}
			elseif($_POST['prov'] == 2)
			{
				$post = Model_User::validation_up2($_POST);
			}
			
			if (!$post->check())
			{
				$errors = $post->errors('projects/mes');
			}
			else
			{
				$user->values($_POST)->update($post);
				$message = "Данные успешно обновленны";
			}
		
			if(isset($_POST['admin']))
			{
				if($_POST['admin'])
				{
					if(!$admin)
					{
						$user->add('roles', ORM::factory('role', 2));
						$admin = 1;
					}
				}
				else
				{
					$user->remove('roles', ORM::factory('role', 2));
					$admin = 0;
				}
			}
		}



		$view_profile = View::factory('adminka/update_user');
		$view_profile->id = $user->id;
		$view_profile->data = $user;
		$view_profile->message = $message;
		$view_profile->admin = $admin;

		$view_profile->errors = $errors;
		$this->template->content = $view_profile->render();
	}

    public function action_close()
    {
        $year_now = date('Y');
        $years = array();
        for($i = 2016; $i <= $year_now; $i++)
        {
            $years[$i] = $i;
        }

        $view = View::factory('adminka/close');

        $view->year_now = $year_now;
        $view->years = $years;

        $this->template->content = $view->render();
    }
}