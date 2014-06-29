<?php

class Model_Category extends ORM_MPTT
{

    protected $_table_name = 'categories';
    protected $_primary_key = 'id';

    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
}
