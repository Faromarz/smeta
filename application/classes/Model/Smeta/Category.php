<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Category extends ORM
{
    protected $_table_name = 'smeta_categories';

    protected $_belongs_to = array(
        'material' => array(
            'model'   => 'Material',
            'foreign_key'   => 'material_id',
        ),
    );
}
