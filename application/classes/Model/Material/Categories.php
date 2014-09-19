<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material_Categories extends ORM_MPTT 
{
    protected $_table_name = 'material_categories';

    protected $_has_many = array(
        'materials' => array(
            'model'   => 'Material',
            'foreign_key'   => 'category_id',
        ),
        'categories' => array(
            'model'   => 'Material_Categories',
            'foreign_key'   => 'parent_id',
        )

    );

    protected $_belongs_to = array(
        'category_parent' => array(
            'model'   => 'Material_Categories',
            'foreign_key'   => 'parent_id',
        )
    );

    public function count_materials()
    {
        return $this->materials->count_all();
    }

    public function count_categories()
    {
        return $this->categories->count_all();
    }

    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
}