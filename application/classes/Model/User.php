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
    /**
	 * Rules for the user model. Because the password is _always_ a hash
	 * when it's set,you need to run an additional not_empty rule in your controller
	 * to make sure you didn't hash an empty string. The password rules
	 * should be enforced outside the model or with a model helper method.
	 *
	 * @return array Rules
	 */
	public function rules()
	{
		return array(
			'username' => array(
				array('not_empty'),
				array('max_length', array(':value', 32)),
				array(array($this, 'unique'), array('username', ':value')),
			),
			'password' => array(
				array('not_empty'),
			),
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array('email', ':value')),
			),
			'phone' => array(
				array('phone')
			)
		);
	}
    /**
	 * Labels for fields in this model
	 *
	 * @return array Labels
	 */
	public function labels()
	{
		return array(
			'username'         => 'Логин',
			'email'            => 'Email',
			'password'         => 'Пароль',
		);
	}
}