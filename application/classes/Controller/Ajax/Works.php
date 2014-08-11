<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Works extends Controller
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

    public function action_load_works()
    {
        $result = array();
        $works = ORM::factory('Work')->find_all();
        foreach ($works as $work){
                $result[] = array('id'=>$work->id, 'name'=>$work->name, 'type' => $work->type, 'length' => $work->length, 'width' => $work->width, 'square' => ($work->length*$work->width), 'show' => 1);
        }
        die(json_encode($result));
    }

}