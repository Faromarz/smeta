<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Room extends ORM
{
    protected $_table_name = 'smeta_rooms';

    protected $_belongs_to = array(
        'room' => array(
            'model'   => 'Room',
            'foreign_key'   => 'room_id',
        ),
    );

    protected $_has_many = array(
        'smeta_categories' => array(
            'model'   => 'Smeta_Category',
            'foreign_key'   => 'smeta_rooms_id',
        )

    );


}
