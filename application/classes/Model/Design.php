<?php defined('SYSPATH') or die('No direct script access.');

class Model_Design extends ORM
{
    protected $_table_name = 'design';
    protected $_primary_key = 'id';
    
    public function __toString()
    {
        return (string) $this->name;
    }

}
