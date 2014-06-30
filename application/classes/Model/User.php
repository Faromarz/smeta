<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_User extends Model_Auth_User
{
    public static function username_available($username)
    {
        $data = ORM::factory('User')->where('username', '=', strtolower($username))->count_all();
        return $data ? FALSE : TRUE;
    }

    public static function email_available($email)
    {
        $data = ORM::factory('User')->where('email', '=', mb_strtolower($email))->count_all();
        return $data ? FALSE : TRUE;
    }
}