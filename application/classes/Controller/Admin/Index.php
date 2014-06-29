<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Core
{

    public function before()
    {
        parent::before();
        if(!$this->auth->logged_in()){
            $this->redirect('/auth/logout');
        }
    }
    public function action_index()
    {
        
    }

    public function after()
    {
        //echo View::factory('profiler/stats');
        parent::after();
    }
}
