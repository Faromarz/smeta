<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Loggin extends Controller_Base
{

    public function before()
    {
        parent::before();
        if (!$this->auth->logged_in()) {
            $this->session->set('redirectAfterLogin', $this->request->uri());
            HTTP::redirect('/auth/login');
        }
    }
}
