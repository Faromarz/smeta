<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_Main
{
    public function before()
    {
        parent::before();
        if(!$this->auth->logged_in()){
            $this->redirect('/auth/logout');
        }
        if($this->auth->logged_in('partner') == 0 && $this->auth->logged_in('client') == 0){
            throw new HTTP_Exception_403('No access');
        }
    }
    public function action_index()
    {
        if($this->auth->logged_in('partner') === true){
            $this->default_template = 'profile/partner.html';
        } elseif ($this->auth->logged_in('client') === true) {
            $this->default_template = 'profile/client.html';
        }
        
//        $object = ORM::factory('Contacts', 1);
//        $this->set('contacts', $object);
    }
    public function action_saveimg()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Partner', $this->request->param('id'));
            if ($object->loaded()) {
                 if($_FILES['img']['tmp_name']){
                    $object->save();
                    $array['file'] = '/imagefly/w116-h116/'.$object->getLogo().'?'.  time();
                } else {
                    $array = array('error' => 'File empty');
                }
            } else {
                $array = array('error' => 'partner not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }
}
