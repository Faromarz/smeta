<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Loggin
{

    public function before()
    {
        parent::before();
        
        $this->bodyClass = 'page-header-fixed';
        
        $this->template->styles = array(
            '/media/libs/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css',
            '/media/libs/metronic/assets/global/plugins/simple-line-icons/simple-line-icons.min.css',
            '/media/libs/metronic/assets/global/plugins/bootstrap/css/bootstrap.min.css',
            '/media/libs/metronic/assets/global/plugins/uniform/css/uniform.default.css',
            '/media/libs/metronic/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            '/media/libs/metronic/assets/admin/pages/css/profile.css',
            '/media/libs/metronic/assets/global/css/components.css',
            '/media/libs/metronic/assets/global/css/plugins.css',
            '/media/libs/metronic/assets/admin/layout/css/layout.css',
            '/media/libs/metronic/assets/admin/layout/css/themes/default.css',
            '/media/libs/metronic/assets/admin/layout/css/custom.css',
        );
         $this->template->scripts = array(
           '/media/libs/metronic/assets/global/plugins/jquery-1.11.0.min.js',
           '/media/libs/metronic/assets/global/plugins/jquery-migrate-1.2.1.min.js',
           '/media/libs/metronic/assets/global/plugins/bootstrap/js/bootstrap.min.js',
           '/media/libs/metronic/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
           '/media/libs/metronic/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
           '/media/libs/metronic/assets/global/plugins/jquery.blockui.min.js',
           '/media/libs/metronic/assets/global/plugins/jquery.cokie.min.js',
           '/media/libs/metronic/assets/global/plugins/uniform/jquery.uniform.min.js',
           '/media/libs/metronic/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
           '/media/libs/metronic/assets/global/scripts/metronic.js',
           '/media/libs/metronic/assets/admin/layout/scripts/layout.js'
         );

//        $this->template->styles[] = '/media/css/admin.css';
//
        $this->template->v_body = View::factory('admin/v_body');
        $this->template->v_body->v_head = View::factory('admin/block/v_head');
        $this->template->v_body->v_footer = View::factory('admin/block/v_footer');
        $this->template->v_body->v_left_menu = View::factory('admin/block/v_left_menu');
        $this->template->v_body->v_page = View::factory('admin/page/v_index');
//        $this->template->v_body->v_left_menu = View::factory('admin/widgets/left_menu')->set('links', array());
//        $this->template->v_body->v_left_menu->links = array();
    }

    public function after()
    {
        //echo View::factory('profiler/stats');
        parent::after();
    }
}
