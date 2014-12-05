<?php defined('SYSPATH') or die('No direct script access.');

class Model_Partner extends ORM
{
    protected $_table_name = 'partners';
    protected $_primary_key = 'id';

    protected $_has_many = array(
        'city' => array(
            'model'   => 'City',
            'through'   => 'partner_cities',
        )
    );

    protected $_belongs_to = array(
        'user' => array(
            'model'   => 'User',
            'foreign_key'   => 'user_id',
        )
    );

    public function filters()
    {
        return array(
            TRUE => array(
                array('Security::xss_clean'),
                array('strip_tags'),
                array('trim')
            ),
        );
    }
}
