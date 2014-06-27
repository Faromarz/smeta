<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Projects extends Template_Admin {

	/**
	 * @var  View  page template
	 */
	public $template = 'admin/index';

	public function before() {
		parent::before();
		
		$this->template->left_menu->links = array(
			'/admin/projects/new'	=> 'Новый проект',
		);
	}


	public function action_index () {
		$object = ORM::factory('flat_project');

		$pagination = $object->get_pagination ();

		$objects = $object->get_objects($pagination);

		$this->template->content = View::factory('admin/blocks/projects/index');
		$this->template->content->objects = $objects;
		$this->template->content->pagination = $pagination;
	}


	public function action_edit () {
		$object = ORM::factory('flat_project', $this->request->param('param'));

		if ( !$object->loaded() ) 
			throw new Exception("Error Processing Request", 1);

		$this->template->content = View::factory('admin/blocks/projects/edit');
		$this->template->content->object 	= $object;
		$this->template->content->errors	= array();

		if ( $_POST ) {
			try {
				$object->update_project( $_POST );

				HTTP::redirect('/admin/projects/');
			}
			catch ( Kohana_ORM_Validation_Exception $e ) {
				$this->template->content->errors = $e->errors('');
			}
		}
	}


	public function action_new () {
		$object = ORM::factory('flat_project');

		$this->template->content = View::factory('admin/blocks/projects/edit');
		$this->template->content->object 	= $object;
		$this->template->content->errors	= array();

		if ( $_POST ) {
			try {
				$object = $object->create_project( $_POST );

				HTTP::redirect('/admin/projects');

			} catch ( Kohana_ORM_Validation_Exception $e ) {
				$this->template->content->errors = $e->errors('');
			}
		}
	}


	public function action_delete () { 
		$object = ORM::factory('flat_project', $this->request->param('param'));

		if ( !$object->loaded() ) 
			throw new Exception("Error Processing Request", 1);

		try {
			$object = $object->delete_project();

			HTTP::redirect('/admin/projects');

		} catch ( Kohana_ORM_Validation_Exception $e ) {
			$this->template->content->errors = $e->errors('');
		}

	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
}