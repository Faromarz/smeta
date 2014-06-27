<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Geo extends Controller_Admin_Index {

	public function action_index () {

                $res_c = ORM::factory('Geo')->where('country_id', 'is', DB::expr('NULL'))->order_by('name')->find_all();
                $res_r = ORM::factory('Geo')->where('country_id', 'is not', DB::expr('NULL'))->where('region_id','is', DB::expr('NULL'))->order_by('name')->find_all();
                
                $this->template->v_body->v_page = View::factory('admin/blocks/geo/index');
		$this->template->v_body->v_page->res_c = $res_c;
		$this->template->v_body->v_page->res_r = $res_r;
	}
        
        public function action_update() {
            $region_obj = new Model_Geo();
            $region_obj->update_region();
            
            $res_c = ORM::factory('Geo')->where('country_id', 'is', DB::expr('NULL'))->find_all();
            $res_r = ORM::factory('Geo')->where('country_id', 'is not', DB::expr('NULL'))->where('region_id','is', DB::expr('NULL'))->find_all();
                

            $this->template->v_body->v_page = View::factory('admin/blocks/geo/index');
            $this->template->v_body->v_page->res_c = $res_c;
            $this->template->v_body->v_page->res_r = $res_r;
        }
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page->class = ' full-content';
		parent::after();
	}
}