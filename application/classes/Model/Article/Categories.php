<?php

class Model_Article_Categories extends ORM_MPTT
{

    protected $_table_name = 'article_categories';
    protected $_primary_key = 'id';

    protected $_has_many = array(
        'articles' => array(
            'model'   => 'Article',
            'foreign_key'   => 'cat_id',
        )

    );
     
    public function __toString()
    {
        return (string) $this->name;
    }

    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
    public function __toString()
    {
        return $this->name;
    }
}
