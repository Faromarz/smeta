<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Smeta extends Controller_Core
{
    public function before()
    {
        parent::before();

        if ( ! $this->request->is_ajax()){
            throw new HTTP_Exception_500('Неверный запрос');
        }
        $this->default_template = 'json';
    }

    public function action_index()
    {
        throw new HTTP_Exception_404;
    }

    public function action_add(){
        $post = $this->request->post();
        $result = array();
        $doors = json_decode($post['doors'], true);
        $windows = json_decode($post['windows'], true);
        $rooms = json_decode($post['rooms'], true);
        
        $smeta = ORM::factory('Smeta');
        $smeta->name = uniqid();
        $smeta->geo_id = 0;
        $smeta->size = Arr::get($post, 'size', '');
        $smeta->height =  Arr::get($post, 'height', '');
        $smeta->price_materials =  Arr::get($post, 'price_materials', 0);
        $smeta->price_work_dem =  Arr::get($post, 'price_work_dem', 0);
        $smeta->price_work_mon =  Arr::get($post, 'price_work_mon', 0);
        $smeta->time_work_dem =  Arr::get($post, 'time_work_dem', 0);
        $smeta->time_work_mon =  Arr::get($post, 'time_work_mon', 0);
        $smeta->room_name =  Arr::get($post, 'room_name', '');
        $smeta->count_rooms =  Arr::get($post, 'count_rooms', 0);
        $smeta->partner_id = 0;
        $smeta->repair_id =  Arr::get($post, 'repair_id', 1);
        $smeta->rate_id =  Arr::get($post, 'rate_id', 1);
        $smeta->apartment_id =  Arr::get($post, 'apartment_id', 1);
        $smeta->create_date = date('Y-m-d H:i:s');
        $smeta->materials_enable = Arr::get($post, 'materials_enable', true);
        $smeta->save();
        foreach($rooms as $room){
            $smeta_room = ORM::factory('Smeta_Room');
            $smeta_room->smeta_id = $smeta->id;
            $smeta_room->room_id = (int) $room['id'];
            $smeta_room->length = $room['length'];
            $smeta_room->width = $room['width'];
            $smeta_room->balcony = isset($room['balcony']) ? $room['balcony']:NULL;
            $smeta_room->enable = $room['enable'];
            $smeta_room->show = $room['show'];
            $smeta_room->materials_enable = $room['materials_enable'];
            $smeta_room->save();
            
            //======= двери
            $door = $room['door'];
            $smeta_door = ORM::factory('Smeta_Door');
            $smeta_door->smeta_rooms_id = $smeta_room->pk();
            $smeta_door->smeta_id = $smeta->id;
            $smeta_door->room_params_def = $door['type'];
            $smeta_door->enable = $door['enable'];
            $smeta_door->height = $door['height'];
            $smeta_door->width = $door['width'];
            $smeta_door->show = $door['show'];
            $smeta_door->count = $door['count'];
            $smeta_door->create();
            
            // =========== окна
            if (isset($room['window'])) {
                $window = $room['window'];
                $smeta_window = ORM::factory('Smeta_Window');
                $smeta_window->smeta_rooms_id = $smeta_room->pk();
                $smeta_window->smeta_id = $smeta->id;
                $smeta_window->count_type = $window['count_type'];
                $smeta_window->enable = $window['enable'];
                $smeta_window->height = $window['height'];
                $smeta_window->width = $window['width'];
                $smeta_window->show = $window['show'];
                $smeta_window->count = $window['count'];
                $smeta_window->create();
            }
            // =========== работы
            foreach($room['works'] as $work){
                $smeta_work = ORM::factory('Smeta_Work');
                $smeta_work->smeta_id = $smeta->id;
                $smeta_work->room_id =  (int) $room['id'];
                $smeta_work->work_id = $work['work_id'];
                $smeta_work->price =  $work['price'];
                $smeta_work->count = $work['count'];
                $smeta_work->save();
            }
            // ============== категории
            $categories = $room['categories'];
            foreach ($categories as $cat){
                $smeta_cat = ORM::factory('Smeta_Category');
                $smeta_cat->smeta_rooms_id = $smeta_room->pk();
                $smeta_cat->material_categories_id =  $cat['id'];
                $smeta_cat->enable = $cat['enable'];
                if (isset($cat['childrenId'])) {
                    $smeta_cat->children_id = $cat['childrenId'];
                }
                $smeta_cat->material_id = $cat['material_id'];
                $smeta_cat->create();
            }
        }
        foreach($doors as $door){
            $smeta_door = ORM::factory('Smeta_Door');
            $smeta_door->smeta_rooms_id = null;
            $smeta_door->smeta_id = $smeta->id;
            $smeta_door->room_params_def = $door['type'];
            $smeta_door->enable = $door['enable'];
            $smeta_door->height = $door['height'];
            $smeta_door->width = $door['width'];
            $smeta_door->show = $door['show'];
            $smeta_door->count = $door['count'];
            $smeta_door->create();
        }
        foreach($windows as $window){
            $smeta_window = ORM::factory('Smeta_Window');
            $smeta_window->smeta_rooms_id = null;
            $smeta_window->smeta_id = $smeta->id;
            $smeta_window->room_params_def = $window['type'];
            $smeta_window->count_type = $window['count_type'];
            $smeta_window->enable = $window['enable'];
            $smeta_window->height = $window['height'];
            $smeta_window->width = $window['width'];
            $smeta_window->show = $window['show'];
            $smeta_window->count = $window['count'];
            $smeta_window->create();
        }
        $result[] = array('smeta_name'=>$smeta->name);
        $this->set('_result', json_encode($result));
    }

    public function action_enable_room(){
        $post = $this->request->post();
        $smeta_id = Arr::get($post, 'smeta_id', '');
        $room_id = Arr::get($post, 'room_id', '');
        $smeta_room = ORM::factory('Smeta_Room')->where('smeta_id','=',$smeta_id)->and_where('room_id','=',$room_id)->find();
        $smeta_room->enable = $smeta_room->enable? 0 : 1;
        $smeta_room->save();
    }

    public function action_enable_door(){
        $post = $this->request->post();
        $door_id = Arr::get($post, 'door_id', '');
        $smeta_door = ORM::factory('Smeta_Door',$door_id);
        $smeta_door->enable = $smeta_door->enable? 0 : 1;
        $smeta_door->save();
    }

}