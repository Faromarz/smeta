<?php defined('SYSPATH') or die('No direct script access.');

class Model_Smeta extends ORM
{
    protected $_table_name = 'smeta';

    protected $_belongs_to = array(
        'materials' => array(
            'model'   => 'Smeta_Material',
            'foreign_key'   => 'smeta_id',
        ),
        'works' => array(
            'model'   => 'Smeta_Work',
            'foreign_key'   => 'smeta_id',
        ),
        'rooms' => array(
            'model'   => 'Smeta_Room',
            'foreign_key'   => 'smeta_id',
        ),
        'other' => array(
            'model'   => 'Smeta_Other',
            'foreign_key'   => 'smeta_id',
        ),
    );
}