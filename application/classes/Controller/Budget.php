<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Budget extends Controller_Core {

    public function action_index() {
        $name = $this->request->param('name');
        if (empty($name)) {
            throw new HTTP_Exception_404;
        }  else {
            $smeta = ORM::factory('Smeta') ->where('smeta.name', '=', $name)->find();
            if (!$smeta->loaded()) {
                throw new HTTP_Exception_404;
            }
            $cat_works = ORM::factory('Work_Categories')->find_all();
            $this->set('smeta',$smeta)->set('cat_works', $cat_works);
        }
    }

}