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
                die(json_encode(array('error' => 'Попробуйте еще раз!')));
            }
        }
    }

    public function action_signup()
    {
        if($this->request->post()){
            $user = ORM::factory('User');
            $username    = Security::xss_clean(Arr::get($_POST, 'username', ''));
            $email = Security::xss_clean(Arr::get($_POST, 'email', ''));
            $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            try{
                $user->username = $username;
                $user->email = $email;
                $user->password = $password;
                $user->save();
                $user->add('roles', ORM::factory('Role', array('name' => 'login')));
                $user->add('roles', ORM::factory('Role', array('name' => 'client')));
                $config = Kohana::$config->load('email');
                Email::connect($config);
                Email::send($email, 'ya.test-test777@yandex.ru', "Регистрация", "Вы успешно зарегистрировались на сайте http://mastersmeta.ru/! Ваш логин - ".$username.", пароль - ".$password, false);
                die(json_encode(array('success' => 'Вы успешно зарегистрированы!')));
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('');
                $this->set('errors', $errors);
            }
        }
    }


    public function action_remind(){
        if($this->request->post()){
            $email =  Security::xss_clean(Arr::get($_POST, 'email', ''));
            $user = ORM::factory('User')->where('email','=',$email)->find();
            $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            $user->password = $password;
            $user->save();
            $config = Kohana::$config->load('email');
            Email::connect($config);
            Email::send($email, 'ya.test-test777@yandex.ru', "Напоминание пароля", "Ваш пароль - ".$password.", от личного кабинета на сайте http://mastersmeta.ru/.", false);
            die(json_encode(array('success' => 'Напоминание пароля успешно отослано на почту!')));
        }
    }

    public function action_allow_login()
    {
        $login = $this->request->param('id');
        $post = Validation::factory(array('username'=>$login));
        $post
            ->rule('username', 'not_empty')
            ->rule('username', 'min_length', array(':value', '3'))
            ->rule('username', 'max_length', array(':value', '24'))
            ->rule('username', 'regex', array(':value', '/^[0-9a-z_.-]++$/iD'));
        if ($post->check()){
            if (Model_User::username_available($login)){
                die(json_encode((int) ! ORM::factory('User', array('username' => $login))->loaded()));
            }else{
                die(json_encode(0));
            }
        }else{
            die(json_encode(0));
        }
    }

    public function action_allow_email(){
        $email = (string)Arr::get($_POST,'email','');
        $post = Validation::factory(array('email'=>$email));
        $post->rule('email', 'not_empty')
            ->rule('email', 'Valid::email')
            ->rule('email', 'Model_User::email_available', array(':value'));
        if ($post->check()){
            die(json_encode(array('data' => '1')));
        }else{
            die(json_encode(array('data' => '0')));
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