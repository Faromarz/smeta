<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Window extends ORM
{
    protected $_table_name = 'smeta_windows';

    protected $_belongs_to = array(
        'room' => array(
            'model'   => 'Smeta_Room',
            'foreign_key'   => 'smeta_rooms_id',
        )
    );
}
