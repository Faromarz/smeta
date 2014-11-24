<?php defined('SYSPATH') or die('No direct script access.');

class Model_City extends ORM
{
    protected $_table_name = 'cities';
    protected $_primary_key = 'id';

    protected $_has_many = array(
        'partners' => array(
            'model' => 'Partner',
            'through' => 'partner_cities'
        )
    );

    public function __toString()
    {
        return (string) $this->city;
    }

}
