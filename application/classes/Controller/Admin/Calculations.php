<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Main calculator class
 *
 * @author 	Andrew Fedyk
 * @version 1.0
 */
class Controller_Admin_Calculations extends Controller_Admin_Index {

	/**
	 * @var  View  page template
	 */
	public function before() {
		parent::before();
		
	}


	public function action_index () 
	{
//		$calculations = ORM::factory('Calculation')->order_by('create_date', 'DESC');
//
//		$pagination = $calculations->get_pagination (array(
//			'view'	=> 'pagination/basic'
//		));
//
//		$calculations = $calculations->get_objects($pagination);
//
//		$this->template->v_body->v_page = View::factory('admin/blocks/calculations/index')
//                                                ->bind('objects', $calculations)
//                                                ->bind('pagination', $pagination);
//                
//                $this->template->v_body->v_page->class = ' full-content pages';
	}


//	public function action_edit () 
//	{
//		$object = ORM::factory('calculation', $this->request->param('param'));
//
//		if ( !$object->loaded() )
//			throw new Exception("Error Processing Request", 1);
//
//		$this->template->content = View::factory('admin/blocks/calculations/edit');
//		$this->template->content->content = View::factory('site/blocks/payment/pdf.success')
//			->set("object", $object);
//
//		$this->template->content->errors	= array();
//	}

	public function action_delete () 
	{
		$object = ORM::factory('Calculation', $this->request->param('param'));

		if ( !$object->loaded() )
			throw new Exception("Error Processing Request", 1);
		else
			$object->delete();

		HTTP::redirect("/admin/calculations");
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
}