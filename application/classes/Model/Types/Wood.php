<?php defined('SYSPATH') or die('No direct script access.');

class Model_Types_Wood extends ORM
{
    protected $_table_name = 'types_wood';
    protected $_primary_key = 'id';
    
    public function __toString()
    {
        return (string) $this->name;
    }

}
