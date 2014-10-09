<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Materials extends Controller_Core
{
    public function action_view()
    {
        $id = (int) $this->request->param('id');
        $material = ORM::factory('Material',$id);
        if (!$material->loaded()) throw new HTTP_Exception_404;
        $this->set('material',$material);
    }
}