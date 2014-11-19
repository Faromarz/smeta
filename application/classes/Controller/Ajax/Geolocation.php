<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Geolocation extends Controller
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

    public function action_set_cookie()
    {
        if ($this->request->post()){
            $name = (string)Security::xss_clean(Arr::get($_POST,'city_name',''));
            $city = ORM::factory('City')->where('city','=',$name)->find();
            if ($city->loaded())
            {
                $value = $city->id;
            }else{
                $city = ORM::factory('City')->where('city','=','Москва')->find();
                $value = $city->id;
            }
            Cookie::set('city',$value);
        }
    }
}