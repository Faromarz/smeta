<?php defined('SYSPATH') or die('No direct script access.');

class Model_Colection extends ORM
{
    protected $_table_name = 'colection';
    protected $_primary_key = 'id';
    
    public function __toString()
    {
        return (string) $this->name;
    }

}
