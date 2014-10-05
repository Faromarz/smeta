<?php defined('SYSPATH') or die('No direct script access.');

class Model_Room extends ORM
{

    protected $_table_name = 'rooms';
    protected $_primary_key = 'id';
    
    protected $_has_many = array();

}
