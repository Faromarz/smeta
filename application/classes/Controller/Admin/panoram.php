<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Panoram CRUD controller
 * @author Andrew Fedyk
 */
class Controller_Admin_Panoram extends Template_Admin {

	/**
	 * @var  View  page template
	 */
	public $template = 'admin/index';

	public function before() 
	{
		if ( $this->request->action() == 'update_plan' ) 
		{
			$this->template = 'admin/json';
		} 

		parent::before();

		$this->template->left_menu->links = array(
			'/admin/flats/new'	=> 'Новая квартира',
		);
	}

	/**
	 * Controll page
	 */
	public function action_edit () 
	{

		$object = ORM::factory('flat', $this->request->param('param'));

		if ( !$object->loaded() ) throw new Exception("Error Processing Request", 1);

		$this->template->content = View::factory('/admin/blocks/flats/panoram');
		$this->template->content->object = $object;
		$this->template->content->points = $object->get_points();;
	}

	/**
	 * Attach image plan to flat
	 * 
	 */
	public function action_attach_plan() 
	{
		$object = ORM::factory('flat', $this->request->param('param'));

		if ( !$object->loaded() ) throw new Exception("Error Processing Request", 1);

		try 
		{
			$file = $object->upload_plan($_FILES);

			$this->template->content = array(
				'status' => TRUE,
				'file'	 => $file,
			);
		}
		catch (ORM_Validation_Exception $e)
		{
			$this->template->content = array(
				'status' => FALSE,
				'errors' => $e->errors,
			);
		}
	}


	public function action_new () 
	{

		$object = ORM::factory('flat');

		$this->template->content = View::factory('admin/blocks/flats/edit');
		$this->template->content->object 	= $object;
		$this->template->content->regions 	= ORM::factory('flat_region')->get_options();
		$this->template->content->types 	= ORM::factory('flat_type')->get_options();
		$this->template->content->counts 	= ORM::factory('flat_Count')->get_options();
		$this->template->content->materials = ORM::factory('flat_material')->get_options();
		$this->template->content->projects 	= ORM::factory('flat_project')->get_options();
		$this->template->content->errors	= array();

		if ( $_POST ) {
			try {
				$object = $object->create_flat( $_POST );

				HTTP::redirect('/admin/flats/edit/' . $object->id);

			} catch ( Kohana_ORM_Validation_Exception $e ) {
				$this->template->content->errors = $e->errors('');
			}
		}
	}


	public function action_panoram() 
	{
		$object = ORM::factory('flat', $this->request->param('param'));

		if ( !$object->loaded() ) throw new Exception("Error Processing Request", 1);

		$this->template->content = View::factory('/admin/blocks/flats/panoram');
	}


	public function action_delete () 
	{ 
		return $this->delete();
	}


	public function action_update_plan() 
	{
		$object = ORM::factory('flat', $this->request->param('param'));
		$result = array('status' => 0, 'message' => '', 'errors' => '');

		if ( !$object->loaded() ) throw new Exception("Error Processing Request", 1);

		try 
		{
			$result['status'] = 1;

			$result['errors'] = $object->upload_plan($_FILES);
		}
		catch (ORM_Validation_Exception $e) 
		{
			$result['status'] = 0;

			$result['errors'] = implode(', ', $e->errors());
		}

		$this->template->content = $result;
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}

}