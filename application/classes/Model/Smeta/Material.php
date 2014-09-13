<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Smeta_Material extends ORM
{
    protected $_table_name = 'smeta_materials';

    protected $_belongs_to = array(
        'materials' => array(
            'model'   => 'Material',
            'foreign_key'   => 'material_id',
        ),
    );
}
