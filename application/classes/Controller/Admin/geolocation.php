<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Geolocation extends Template_Admin {

	public function action_index () {
 
                $region_obj = new Model_Geoloc();
                $res_c = $region_obj->get_country();
                $res_r = $region_obj->get_region();
                
                $this->template->content = View::factory('admin/blocks/geoloc/index');
		$this->template->content->res_c = $res_c;
		$this->template->content->res_r = $res_r;
	}
        
        public function action_update() {
            $region_obj = new Model_Geoloc();
            $region_obj->update_region();
            
            $res_c = $region_obj->get_country();
            $res_r = $region_obj->get_region();

            $this->template->content = View::factory('admin/blocks/geoloc/index');
            $this->template->content->res_c = $res_c;
            $this->template->content->res_r = $res_r;
        }
        public function after() {
		if(empty($this->template->left_menu->links))
                    $this->template->content->class = ' full-content';
		parent::after();
	}
}