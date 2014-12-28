<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Partners extends Controller_Core
{
    public function action_index()
    {
        if($this->request->post()){
            $user = ORM::factory('User');
            $email = Security::xss_clean(Arr::get($_POST, 'email', ''));
            $phone = Security::xss_clean(Arr::get($_POST, 'phone', ''));
            $site = Security::xss_clean(Arr::get($_POST, 'site', ''));
            $company_name = Security::xss_clean(Arr::get($_POST, 'company_name', ''));
            $director_name = Security::xss_clean(Arr::get($_POST, 'director_name', ''));
            $password = substr(md5(uniqid(mt_rand(), true)), 0, 8);
            try{
                $user->username = $email;
                $user->email = $email;
                $user->phone = $phone;
                $user->password = $password;
                $user->save();
                $user->add('roles', ORM::factory('Role', array('name' => 'login')));
                $user->add('roles', ORM::factory('Role', array('name' => 'partner')));
                $partner = ORM::factory('Partner');
                $partner->user_id = $user->id;
                $partner->telephon = $phone;
                $partner->site = $site;
                $partner->name = $company_name;
                $partner->director_name = $director_name;
                $partner->spec_id = 1;
                $partner->save();
                $config = Kohana::$config->load('email');
                Email::connect($config);
                Email::send($email, 'ya.test-test777@yandex.ru', "Регистрация", "Вы успешно зарегистрировались на сайте http://mastersmeta.ru/ в статусе партнера! Ваш логин - ".$email.", пароль - ".$password, false);
                $this->set('auth','success');
            }
            catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('');
                $this->set('errors', $errors);
            }
        }
        $partnerCount = ORM::factory('Partner')->count_all();
        $this->set('partnerCount', $partnerCount);
        $partners = ORM::factory('Partner')->where('group', '=', 1)->find_all();
        $this->set('partners', $partners);
        $contacts = ORM::factory('Contacts', 1);
        $this->set('contacts', $contacts);
        $categories = ORM::factory('Partner_Spec')->find_all();
        $this->set('categories', $categories);
    }
}