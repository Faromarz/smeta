<?php defined('SYSPATH') or die('No direct script access.');

class Model_City extends ORM
{
    protected $_table_name = 'cities';
    protected $_primary_key = 'id';

    public function __toString()
    {
        return (string) $this->city;
    }

}
