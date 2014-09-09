<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Work extends ORM
{
    protected $_table_name = 'smeta_works';
    protected $_belongs_to = array(
        'works' => array(
            'model'   => 'Work',
            'foreign_key'   => 'work_id',
        ),
    );
}
