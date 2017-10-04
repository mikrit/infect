<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Dataspid extends ORM
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
}