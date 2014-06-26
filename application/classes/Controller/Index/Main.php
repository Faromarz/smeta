<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index_Main extends Controller_Base {

    public function before() {
        parent::before();

        $this->template->v_body = View::factory('index/v_body');
//        $this->template->v_body->v_libs = View::factory('index/block/v_libs');
//        $this->template->v_body->v_head = View::factory('index/block/v_head');
//        $this->template->v_body->v_footer = View::factory('index/block/v_footer');
//        $this->template->v_body->v_footer = View::factory('index/block/v_all_blocks');
//        $this->template->v_body->v_footer = View::factory('index/block/v_auth');
    }

    public function action_index() {
//        $this->template->styles[] = '/media/libs/slider/slider.css';
//        $this->template->styles[] = '/media/libs/mCustomScrollbar/jquery.mCustomScrollbar_portal.css';
//         
//        $this->template->scripts[] = '/media/js/portal.js';
//
//        $this->template->scripts[] = '/media/js/scrolling_portal.js';
//        $this->template->scripts[] = '/media/js/smeta/setuproomlist.js';
//        $this->template->scripts[] = '/media/js/smeta/room.js';
//        $this->template->scripts[] = '/media/js/smeta/calc.js';
//        $this->template->scripts[] = '/media/js/smeta/calcroomparent.js';
//        $this->template->scripts[] = '/media/js/smeta/calcroomsize.js';
//        $this->template->scripts[] = '/media/js/smeta/calcremont_cc.js';
//        $this->template->scripts[] = '/media/js/smeta/calcremont_nv.js';
//        $this->template->scripts[] = '/media/js/smeta/calcroomheight.js';
//        $this->template->scripts[] = '/media/js/smeta/calcremont_ebp.js';
//        $this->template->scripts[] = '/media/js/smeta/load.js';
////        $this->template->scripts[] = '/media/js/smeta/calcremontmaterials.js';
//        $this->template->scripts[] = '/media/js/smeta/calcroomgeo.js';
//        $this->template->scripts[] = '/media/js/smeta/roomswindows.js';
//        $this->template->scripts[] = '/media/js/smeta/roomsdoor.js';
//        $this->template->scripts[] = '/media/js/smeta/roomscategories.js';
//        $this->template->scripts[] = '/media/js/smeta/roomscategoriesmaterials.js';
//        $this->template->scripts[] = '/media/js/smeta/roomswork.js';
//        $this->template->scripts[] = '/media/js/smeta/smeta.js';

//        $repait_options = ORM::factory('Repair')->find_all();
//        $photos = array();
//        $sql = 'SELECT
//                    smeta_partners_img.*,
//                    smeta_partners.name as name_p
//                    FROM  smeta_partners_img
//                    INNER JOIN smeta_partners on smeta_partners_img.user_id = smeta_partners.user_id
//                        where smeta_partners_img.repair_id = 1
//                        ORDER BY rand()
//                        ';
//        $photos[1] = DB::query(Database::SELECT, $sql)->as_object()->execute()->as_array();
//        $sql = 'SELECT
//                    smeta_partners_img.*,
//                    smeta_partners.name as name_p
//                    FROM  smeta_partners_img
//                    INNER JOIN smeta_partners on smeta_partners_img.user_id = smeta_partners.user_id
//                        where smeta_partners_img.repair_id = 2
//                        ORDER BY rand()
//                        ';
//        $photos[2] = DB::query(Database::SELECT, $sql)->as_object()->execute()->as_array();
//        $sql = 'SELECT
//                    smeta_partners_img.*,
//                    smeta_partners.name as name_p
//                    FROM  smeta_partners_img
//                    INNER JOIN smeta_partners on smeta_partners_img.user_id = smeta_partners.user_id
//                        where smeta_partners_img.repair_id = 3
//                        ORDER BY rand()
//                        ';
//        $photos[3] = DB::query(Database::SELECT, $sql)->as_object()->execute()->as_array();
//        
//        $smets = ORM::factory('Smeta')
//                          ->select('create_date', 'size', 'price_materials', 'room_name',
//                                            array(DB::expr('`price_work_dem`+`price_work_mon`'), 'price_work'),
//                                            array('ebp.name', 'name_ebp'),
//                                            array('cc.name', 'name_cc'),
//                                            array('nv.name', 'name_nv'),
//                                            array('geo.name', 'name_geo')
//                                            )
//                          ->join(array('smeta_repair', 'ebp'))->on('smeta.repair_ebp', '=','ebp.id')
//                          ->join(array('smeta_repair', 'cc'))->on('smeta.repair_cc', '=','cc.id')
//                          ->join(array('smeta_repair', 'nv'))->on('smeta.repair_nv', '=','nv.id')
//                          ->join('geo')->on('smeta.geo_id', '=','geo.id')
//                          ->order_by('create_date', 'DESC')
//                          ->limit(6)
//                          ->find_all();
//        
//        $okna = ORM::factory('okna')->order_by('price', 'ASC')->find_all();
        
        $this->template->v_body->v_page = View::factory('index/page/v_main')
//                          ->bind('okna', $okna)
//                          ->bind('repait_options', $repait_options)
//                          ->bind('country_id', $this->geo)
//                          ->bind('photos', $photos)
//                          ->bind('smets', $smets)
        ;
    }

}
