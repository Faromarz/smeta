<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material extends ORM
{
    protected $_table_name = 'materials';
    protected $_primary_key = 'id';

    protected $_belongs_to = array(
        'category' => array(
            'model'   => 'Material_Categories',
            'foreign_key'   => 'category_id',
        ),
        'country' => array(
            'model'   => 'Country',
            'foreign_key'   => 'country_id',
        ),
    );
}
