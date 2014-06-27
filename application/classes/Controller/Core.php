<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Core extends Controller_Kotwig {

    protected $user = false;

    public function before() {
        parent::before();
        $this->user = Auth::instance()->get_user();
        $this->set('_user', $this->user);
        $this->set('_title', '');
        $this->set('_description', '');
        $this->set('_keywords', '');
        $this->set('_controller', $this->request->controller());
    }

}
