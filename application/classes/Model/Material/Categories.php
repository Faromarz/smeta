<?php defined('SYSPATH') or die('No direct script access.');

class Model_Material_Categories extends ORM_MPTT 
{
    protected $_table_name = 'material_categories';

    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
}