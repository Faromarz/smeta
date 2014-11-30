<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Contacts extends Controller_Main
{

    public function action_index()
    {
        
        $this->default_template = 'contacts/index.html';
        $object = ORM::factory('Contacts', 1);
        $this->set('item', $object);
        
    }
}
