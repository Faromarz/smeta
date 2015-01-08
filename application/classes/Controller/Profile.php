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
            if (!$this->user->partner->loaded()) {
                $partner = ORM::factory('Partner');
                $partner->user = $this->user;
                $partner->save();
            }
        } elseif ($this->auth->logged_in('client') === true) {
            $this->default_template = 'profile/client.html';
        }
        
        $listRate = ORM::factory('Types_Rate')->find_all();
        $this->set('listRate', $listRate);
        
        $categories = ORM::factory('Partner_Spec')->find_all();
        $this->set('categories', $categories);
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
    public function action_saveinfo()
    {
        $this->default_template = 'json';
        $array = array();
        $post = $this->request->post();
        if ($this->request->param('id') && $post) {
            $object = ORM::factory('Partner', $this->request->param('id'));
            if ($object->loaded()) {
                $post['experience'] = str_replace(',', '.', $post['experience']);
                $object->values($post);
                $object->save();
                $this->user->values($post);
                $this->user->update();
            } else {
                $array = array('error' => 'partner not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }
    public function action_addstaff()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Partner', $this->request->param('id'));
            if ($object->loaded()) {
                $staff = ORM::factory('Partner_Staff');
                $staff->partner_id = $object->id;
                $staff->save();
                $array = array('id' => $staff->pk());
            } else {
                $array = array('error' => 'partner not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }
    public function action_removestaff()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Partner_Staff', $this->request->param('id'));
            if ($object->loaded()) {
                $object->delete();
            } else {
                $array = array('error' => 'staff not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }
    public function action_saveimgstaff()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->param('id')) {
            $object = ORM::factory('Partner_Staff', $this->request->param('id'));
            if ($object->loaded()) {
                 if($_FILES['photo']['tmp_name']){
                    $object->save();
                    $array['file'] = '/imagefly/w270-h270/'.$object->getPhoto().'?'.  time();
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
    public function action_savestaff()
    {
        $this->default_template = 'json';
        $array = array();
        $post = $this->request->post();
        if ($this->request->param('id') && $post) {
            $object = ORM::factory('Partner_Staff', $this->request->param('id'));
            if ($object->loaded()) {
                $object->values($post);
                $object->save();
            } else {
                $array = array('error' => 'partner not found');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }
}
