<?php defined('SYSPATH') or die('No direct script access.');

class Model_Partner extends ORM
{
    protected $_table_name = 'partners';
    protected $_primary_key = 'id';
    
    protected $_belongs_to = array(
        'user' => array(
            'model'   => 'User',
            'foreign_key'   => 'user_id',
        )
    );
}
