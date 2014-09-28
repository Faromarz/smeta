<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Door extends ORM
{
    protected $_table_name = 'smeta_doors';

    protected $_belongs_to = array(
        'room' => array(
            'model'   => 'Smeta_Room',
            'foreign_key'   => 'smeta_rooms_id',
        ),
        'param' => array(
            'model'   => 'Roomparamsdef',
            'foreign_key'   => 'room_params_def',
        ),
    );
}
