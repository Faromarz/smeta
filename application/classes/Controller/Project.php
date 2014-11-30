<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Project extends Controller_Main
{

    public function action_index()
    {
        $this->default_template = 'project/index.html';
        $object = ORM::factory('Contacts', 1);
        $this->set('contacts', $object);
    }
}
