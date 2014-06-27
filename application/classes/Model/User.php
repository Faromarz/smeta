<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends Model_Auth_User
{
    public function action_signin()
    {
        if (Auth::instance()->logged_in())
        {
            $this->redirect('/');
        }
        if($this->request->post()){
            $username    = (string)Arr::get($_POST, 'username', '');
            $password = (string)Arr::get($_POST, 'password', '');
            $token = Arr::get($_POST, 'token', false);
            if ($token === Security::token() && Auth::instance()->login($username, $password, true))
            {
                $this->redirect('/');
            }
            else
            {
                $this->set('_message','Неверные данные');
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