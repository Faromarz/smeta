<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Materials extends Controller
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

    public function action_load()
    {
        $rate = (int) Arr::get($_POST, 'rate', 0);
        $repair = (int) Arr::get($_POST, 'repair', 0);
        $type = (int) Arr::get($_POST, 'type', 0);

        $material_type = ORM::factory('Material_Type')->find_all();



    }
}