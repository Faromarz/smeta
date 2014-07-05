<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Core extends Controller_Kotwig {

    protected $user = false;
    protected $auth = false;

    public function before() {
        parent::before();
        $this->auth = Auth::instance();
        $this->user = $this->auth->get_user();
        $this->set('_user', $this->user);
        $this->set('_token', Security::token());
        $this->set('_title', '');
        $this->set('_description', '');
        $this->set('_keywords', '');
        $this->set('_controller', $this->request->controller());
        $this->set('_action', $this->request->action());
    }

}
