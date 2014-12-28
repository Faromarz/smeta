<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Partners extends Controller_Core
{
    protected $user = false;

    public function before()
    {
        parent::before();
        if (method_exists(Auth::instance(), 'auto_login')) {
            Auth::instance()->auto_login();
        }
        $this->user = Auth::instance()->get_user();
        if ( ! $this->request->is_ajax())
        {
            throw new HTTP_Exception_500('Неверный запрос');
        }
    }

    public function action_index()
    {
        throw new HTTP_Exception_404;
    }


    public function action_get()
    {
        $this->default_template = 'partners/list.html';
        
        $post = $this->request->post();
        $cat = (int) Arr::get($post, 'cat', null);
        if(!$cat){
            throw new HTTP_Exception_500('Неверный запрос');
        }
        $limit = 6;
        $partners = ORM::factory('Partner')->where('group', '=', $cat)->find_all();
        $this->set('partners', $partners);
       
    }

}