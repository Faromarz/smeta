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
//        'country' => array(
//            'model'   => 'Country',
//            'foreign_key'   => 'country_id',
//        ),
        'manuf' => array(
            'model' => 'Manuf',
            'foreign_key' => 'manuf_id'
        )
    );
        
    
    protected $_has_one = array(
        );
       
}