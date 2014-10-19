<?php defined('SYSPATH') or die('No direct script access.');

class Model_Manuf extends ORM
{
    protected $_table_name = 'manuf';
    protected $_primary_key = 'id';
    
    public function __toString()
    {
        return (string) $this->name;
    }

}
