<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Text extends Template_Admin {
        public function before() {
		parent::before();
		
		$this->template->left_menu->links = array(
                    '/admin/text/heade' => 'Главная верх',
                    '/admin/text/footer' => 'Главная низ',
                    '/admin/text/contact' => 'Контактная информация'
                );
	}
        
	public function action_index () {
            $this->action_header();
	}
        
        public function action_header() {
            $this->template->content = View::factory('admin/blocks/text/index');
            $this->template->content->title_text = 'Главная верх';
            
            $model_obj = new Model_Text();            
            if ( $_POST ) {
                try {
                    $model_obj->update_header( $_POST );
                }
                catch ( Kohana_ORM_Validation_Exception $e ) {
                    $this->template->content->errors = $e->errors('');
                }
            }
            $this->template->content->text = $model_obj->get_header();
        }
        
        public function action_footer() {
            $this->template->content = View::factory('admin/blocks/text/index');
            $this->template->content->title_text = 'Главная низ';
            
            $model_obj = new Model_Text();            
            if ( $_POST ) {
                try {
                    $model_obj->update_footer( $_POST );
                }
                catch ( Kohana_ORM_Validation_Exception $e ) {
                    $this->template->content->errors = $e->errors('');
                }
            }
            $this->template->content->text = $model_obj->get_footer();
        }
        
        public function action_contact() {
            $this->template->content = View::factory('admin/blocks/text/contact');
            
            $model_obj = new Model_Text();            
            if ( $_POST ) {
                try {
                    $model_obj->update_contact( $_POST );
                }
                catch ( Kohana_ORM_Validation_Exception $e ) {
                    $this->template->content->errors = $e->errors('');
                }
            }
            $this->template->content->adr = $model_obj->get_contact_adr();
            $this->template->content->phone = $model_obj->get_contact_phone();
            $this->template->content->email = $model_obj->get_contact_email();
        }
        public function after() {
		if(empty($this->template->left_menu->links))
                    $this->template->content->class = ' full-content';
		parent::after();
	}
}