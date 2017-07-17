<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_District extends ORM
{
    protected $_has_many = array(
        'subjects' => array(
            'model'			=> 'subject',
            'foreign_key'	=> 'district_id',
        )
    );
}
