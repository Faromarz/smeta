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
            $this->set('smeta',$smeta);
        }
    }

}