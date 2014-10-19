<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material_Params extends ORM 
{
    protected $_table_name = 'material_params';

    protected $_has_many = array(
    );

    protected $_belongs_to = array(
        'material' => array(
            'model'   => 'Material',
            'foreign_key'   => 'material_id',
        ),
        'country' => array(
            'model'   => 'Country',
            'foreign_key'   => 'country_id',
        ),
        'manuf' => array(
            'model' => 'Manuf',
            'foreign_key' => 'manuf_id'
        ),
        'colection' => array(
            'model' => 'Colection',
            'foreign_key' => 'colection_id'
        ),
        'design' => array(
            'model' => 'Design',
            'foreign_key' => 'design_id'
        ),
        'type_wood' => array(
            'model' => 'Types_Wood',
            'foreign_key' => 'type_wood_id'
        ),
        'color' => array(
            'model' => 'Color',
            'foreign_key' => 'color_id'
        )
    );
        
    
    protected $_has_one = array(
        );
       
}