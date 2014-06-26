<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Kohana_Controller_Template {

    protected $auth;
    protected $session;
    protected $user;
    public $template = 'v_base';
    public $auth_required = false;
    public $auto_render = true;
    public $geo = true;

    public function before() {
        parent::before();
//        $this->geo = new Model_Geo();
//        $this->geo->define_region();
//        $arr_lang  = ORM::factory('Lang')->get_array_alias();
        // Авторизация
        $this->auth = Auth::instance();
//        $this->user = $this->auth->get_user(); /* получаем данные авторизированого пользователя */
//        if (!$this->auth->logged_in()) {
        $this->session = Session::instance();
//            $this->session->set('redirectAfterLogin', $_SERVER['REQUEST_URI']);
//        }
//         $seo = ORM::factory('article')->where('alias', '=', 'main')->find();
//
        $this->template->title = '';
//        $this->template->title 		= $seo->title;
        $this->template->description = '';
//        $this->template->description    = $seo->description;
        $this->template->keywords = '';
//        $this->template->keywords 	= $seo->keywords;
        // Подключаем стили
        $this->template->styles = array(
//            '/media/libs/arcticmodal/jquery.arcticmodal.css',
//            '/media/libs/arcticmodal/themes/smeta.css',
//            '/media/libs/selectbox/jquery.selectbox.css',
//            '/media/libs/slider/slider.css',
        );

        // Подключаем скрипты
        $this->template->scripts = array(
//            '/media/libs/jquery.js',
//            '/media/libs/jquery.anythingslider.js',
//            '/media/libs/jquery.easing.1.2.js',
//            '/media/libs/jquery.scrollto.js',
//            '/media/libs/selectbox/jquery.selectbox-0.2.js',
//            '/media/libs/slider/jquery-slider.js',
//            '/media/libs/inputmask/jquery.inputmask.js',
//            '/media/libs/inputmask/jquery.inputmask.extensions.js',
//            '/media/libs/inputmask/jquery.inputmask.date.extensions.js',
//            '/media/libs/inputmask/jquery.inputmask.numeric.extensions.js',
//            '/media/libs/inputmask/jquery.inputmask.custom.extensions.js',
//            '/media/libs/arcticmodal/jquery.arcticmodal.js',
//            '/media/libs/all.js',
//            '/media/js/base.js'
        );
//         $this->template->styles[] = '/media/libs/mCustomScrollbar/jquery.mCustomScrollbar.css';
//        
//        $this->template->scripts[] = '/media/libs/mCustomScrollbar/jquery.mCustomScrollbar.js';
        
//        if (!$this->auth->logged_in()) {
//            $this->template->scripts[] = '/media/js/smeta/auth.js';
//        }
    }

}
