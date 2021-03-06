<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller
{
	public function action_login()
	{
		$error = '';
		
		if (Auth::instance()->logged_in())
		{
			$this->redirect('main');
		}
		
		if ($_POST)
		{
			if (!Auth::instance()->login($_POST['login'], $_POST['password'], isset($_POST['remember'])))
			{
				$error = '<div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert">×</a>
								<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong> Неправильно введён логин или пароль
							</div>';
			}
			else
			{
				$this->redirect('main');
			}
		}
		
		$view = View::factory('login')->bind('error', $error);
		$this->response->body($view);
	}
	
	public function action_forgotpassword()
	{
		$errors = array();
		
		if (Auth::instance()->logged_in())
		{
			$this->redirect('search');	
		}
		
		if ($_POST)
		{
			$post = Validation::factory($_POST)
				->rule('email', 'not_empty')
				->rule('email', 'min_length', array(':value', 6))
				->rule('email', 'max_length', array(':value', 125))
				->rule('email', 'email');
			
			if (!$post->check())
			{
				$errors = $post->errors('validate');
			}
			else
			{
	 			$user = ORM::factory('user', array('email' => $post['email']));
				
	 			if(!$user->loaded())
	 			{
	 				$error = 'E-mail not isset';
				}
				else
				{
					
					
					$user->password = 'Y7Fsa4J';
					$user->save();
					$subj = 'New password';
					$body = 'Your new password: Y7Fsa4J';
					
					//Http::send_letter($user->email, $subj, $body);
					$mess = "Password send in your e-mail";
				}
			}
		}
		
		$view = View::factory('forgotpassword')->bind('errors', $errors)->bind('error', $error)->bind('mess', $mess);
		$this->response->body($view);
	}
		
	public function action_logout()
	{
		Auth::instance()->logout();
		$this->redirect('/login');
	}
	
}