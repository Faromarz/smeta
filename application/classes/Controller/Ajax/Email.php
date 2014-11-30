<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Email extends Controller
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

    public function action_send()
    {
        if ($this->request->post()){
            $object = ORM::factory('Contacts', 1);
            
            $post = $this->request->post();
            $name = (string)Security::xss_clean(Arr::get($post,'nameTo',''));
            $emailTo = (string)Security::xss_clean(Arr::get($post,'emailTo',''));
            $text = (string)Security::xss_clean(Arr::get($post,'textTo',''));
            $config = Kohana::$config->load('email');
            Email::connect($config);
            Email::send(
                    $emailTo,
                    $object->email,
                    "Сообщение со страницы контакты mastersmeta.ru от ".$name ,
                    $text,
                    false
                );
            die(json_encode(array('success' => 'Сообщение отправленно!')));
        }
    }
}