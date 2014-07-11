<?php

class Model_ArticleCategory extends ORM_MPTT
{

    protected $_table_name = 'article_categories';
    protected $_primary_key = 'id';

    public function getEmptyLvl()
    {
        return str_repeat(
                html_entity_decode('&nbsp;', ENT_QUOTES, 'UTF-8'), ($this->lvl + 1) * 3
            );
    }
}
