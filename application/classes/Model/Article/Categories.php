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
     
    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
    public function hasArticle()
    {
        $hasArticle = false;
        $children = $this->children();
        foreach ($children as $chaild) {
            if ($chaild->articles->count_all() > 0) {
                $hasArticle = true;
            }
        }
        
        return $hasArticle;
    }
    public function __toString()
    {
        return $this->name;
    }
}
