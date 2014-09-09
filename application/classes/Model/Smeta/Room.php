<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Room extends ORM
{
    protected $_table_name = 'smeta_rooms';

    protected $_belongs_to = array(
        'rooms' => array(
            'model'   => 'Room',
            'foreign_key'   => 'room_id',
        ),
    );
}
