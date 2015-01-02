<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Core extends Controller_Kotwig {

    protected $user = false;
    protected $auth = false;
    protected $session = false;
    protected $admin = false;
    protected $client = false;
    protected $partner = false;

    public function before() {
        parent::before();
        $this->auth = Auth::instance();
        $this->user = $this->auth->get_user();
        $this->session = Session::instance();
        $this->set('_user', $this->user);
        if ($this->user) {
            $this->admin = $this->user->has('roles', ORM::factory('Role', array('name' => 'admin')));
            $this->set('_admin', $this->admin);
        }
        if ($this->user) {
            $this->partner = $this->user->has('roles', ORM::factory('Role', array('name' => 'partner')));
            $this->set('_partner', $this->partner);
        }
        if ($this->user) {
            $this->client = $this->user->has('roles', ORM::factory('Role', array('name' => 'client')));
            $this->set('_client', $this->client);
        }
        
        $this->set('_token', Security::token());
        $this->set('_title', '');
        $this->set('_description', '');
        $this->set('_keywords', '');
        $this->set('_controller', $this->request->controller());
        $this->set('_action', $this->request->action());
        $this->set('_domainName', URL::base('http'));
        $this->set('_countSmeta', (ORM::factory('Smeta')->count_all())*3);

    }

}
