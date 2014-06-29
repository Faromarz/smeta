<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Core{

    public function action_signin()
    {
        if($this->request->post()){
            $username    = (string)Arr::get($_POST, 'username', '');
            $password = (string)Arr::get($_POST, 'password', '');
            $token = Arr::get($_POST, 'token', false);
            if ($token === Security::token() && Auth::instance()->login($username, $password, true))
            {
                die(json_encode(array('success' => 'Вы успешно авторизованы!')));
            }
            else
            {
                die(json_encode(array('error' => 'Неверные данные!')));
            }
        }
    }

    public function action_logout()
    {
        if (Auth::instance()->logged_in())
        {
            Auth::instance()->logout();
        }
        $this->redirect('/');
    }

}