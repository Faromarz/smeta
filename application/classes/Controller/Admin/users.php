<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Template_Admin
{
	public $template = 'admin/index';

	public function before()
	{
		parent::before();

		$this->template->left_menu->links = array(
			"/admin/users/new" => 'Добавить пользователя',
		);
	}
	
	public function action_index()
	{
		$users = ORM::factory('user')->find_all();
		
		$this->template->title   = 'Пользователи';
		$this->template->content = View::factory('admin/blocks/users/index');
		$this->template->content->objects	= $users;
	}
	
	/**
	 */
	public function action_new()
	{
		$object = ORM::factory('user');
		$this->template->content = View::factory('admin/blocks/users/edit');
		$this->template->content->object = $object;
		$this->template->content->errors = array();
		$this->template->content->title = 'Новый пользователь';
		
		if ( $_POST )
		{
			try
			{
				$object->create_user($_POST,NULL)->add('roles', 1);
                                if(is_array($_POST['role'])){
                                    foreach ($_POST['role'] as $val){
                                        $object->add('roles', $val);
                                        if($val == 3 && !ORM::factory('partners')->where('user_id', '=', $object->pk())->find()->loaded()){
                                            $par = ORM::factory('partners');
                                            $par->user_id = $object->pk();
                                            $par->save();
                                        }
                                    }
                                }
				
				HTTP::redirect("/admin/users");
			}
			catch (ORM_Validation_Exception $e)
			{
				// Валидация не прошла
				$this->template->content->errors = Arr::flatten($e->errors("")) ;
			}
		}

	}
	
	/**
	 * Редактирование 
	 */
	public function action_edit()
	{
		$object = ORM::factory('user', $this->request->param('param'));

		if ( !$object->loaded()) throw new Exception("Error Processing Request", 1);
		
		$this->template->content = View::factory('admin/blocks/users/edit');
		$this->template->content->object = $object;
		$this->template->content->errors = array();
		$this->template->content->title = 'Новый пользователь';
		
		if ( $_POST )
		{
			try
			{
				$object->update_user($_POST);
				$object->remove('roles', 'admin');
				$object->remove('roles', 2);
				$object->remove('roles', 3);
				$object->remove('roles', 'partner');
//                                if($object->roles->where('user_id', '=', $object->pk())->where('role_id', '=', 2)->find()->loaded())$object->roles->where('role_id', '=', 2)->find()->delete();
//                                if($object->roles->where('user_id', '=', $object->pk())->where('role_id', '=', 3)->find()->loaded())$object->roles->where('role_id', '=', 3)->find()->delete();
                                if(is_array($_POST['role'])){
                                    foreach ($_POST['role'] as $val){
                                        $object->add('roles', $val);
                                        if($val == 3 && !ORM::factory('partners')->where('user_id', '=', $object->pk())->find()->loaded()){
                                            $par = ORM::factory('partners');
                                            $par->user_id = $object->pk();
                                            $par->save();
                                        }
                                    }
                                }
				
				HTTP::redirect("/admin/users");
			}
			catch (ORM_Validation_Exception $e)
			{
				// Валидация не прошла
				$this->template->content->errors = Arr::flatten($e->errors("")) ;
			}
		}

	}
	
	/**
	 * Удалить 
	 */
	public function action_delete()
	{
		$user = ORM::factory('user', $this->request->param('param'));
		
		if ( $user->loaded() )
		{
			try
			{
				$user->delete();
				
				HTTP::redirect("/admin/users");
			}
			catch (Kohana_Database_Exception $e)
			{
				throw new Kohana_Exception("Невозможно удалить!");
			}
		}

		HTTP::redirect("/admin/users");
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
}
