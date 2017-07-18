<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'password' => array(
		'not_empty'			=> 'Заполните поле \'Пароль\'',
		'min_length'		=> 'Пароль должен состоять минимум из 6 символов',
	),
	'username' => array(
		'not_empty'		=> 'Заполните поле \'Логин\'',
	),
	'fio' => array(
		'not_empty'		=> 'Заполните поле \'ФИО\'',
	),
	'password_confirm' => array(
		'matches'		=> 'Пароли не совпадают',
	),
	'email' => array(
		'not_empty'		=> 'Заполните поле \'e-mail\'',
		'email'		=> 'Поле \'e-mail\' должен быть электронной почтой',
	),
);