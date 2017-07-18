<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User
{
    protected $_belongs_to = array(
        'district'	=> array(
            'model'			=> 'district',
            'foreign_key'	=> 'district_id',
        ),
        'subject'	=> array(
            'model'			=> 'subject',
            'foreign_key'	=> 'subject_id',
        )
    );

	public static function validation_user($values)
	{
		return Validation::factory($values)
            ->rule('fio', 'not_empty')

			->rule('username', 'not_empty')
			->rule('username', 'min_length', array(':value', 2))
			->rule('username', 'max_length', array(':value', 60))
			->rule('username', 'regex', array(':value', '/^[a-z0-9_.]++$/iD'))

            -> rule('email', 'not_empty')
            -> rule('email', 'email')

            ->rule('password', 'not_empty')
            ->rule('password', 'min_length', array(':value', 6))

            ->rule('password_confirm',  'matches', array(':validation', 'password_confirm', 'password'));
	}

    public static function validation_up1($values)
    {
        return Validation::factory($values)
            ->rule('fio', 'not_empty')

            ->rule('username', 'not_empty')
            ->rule('username', 'min_length', array(':value', 2))
            ->rule('username', 'max_length', array(':value', 60))
            ->rule('username', 'regex', array(':value', '/^[a-z0-9_.]++$/iD'))

            -> rule('email', 'not_empty')
            -> rule('email', 'email');
    }

    public static function validation_up2($values)
    {
        return Validation::factory($values)
            ->rule('password', 'not_empty')
            ->rule('password', 'min_length', array(':value', 6))

            ->rule('password_confirm',  'matches', array(':validation', 'password_confirm', 'password'));
    }
}
