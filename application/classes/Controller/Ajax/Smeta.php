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
        $smeta_id = 0;

        if((int) Arr::get($post, 'smetaid', 0)>0){
            $smeta_id = (int) Arr::get($post, 'smetaid', 0);
            $smeta = ORM::factory('Smeta', $smeta_id);
            $smeta_rooms = ORM::factory('Smeta_Room')->where('smeta_id','=',$smeta_id)->find_all();
            foreach($smeta_rooms as $smeta_room){
                $smeta_categories = ORM::factory('Smeta_Category')->where('smeta_rooms_id','=',$smeta_room->id)->find_all();
                foreach($smeta_categories as $smeta_category) {
                    $smeta_category->delete();
                }
                $smeta_room->delete();
            }
            $smeta_doors = ORM::factory('Smeta_Door')->where('smeta_id','=',$smeta_id)->find_all();
            foreach($smeta_doors as $smeta_door){
                $smeta_door->delete();
            }
            $smeta_windows = ORM::factory('Smeta_Window')->where('smeta_id','=',$smeta_id)->find_all();
            foreach($smeta_windows as $smeta_window){
                $smeta_window->delete();
            }
            $smeta_works = ORM::factory('Smeta_Work')->where('smeta_id','=',$smeta_id)->find_all();
            foreach($smeta_works as $smeta_work){
                $smeta_work->delete();
            }
        }else{
            $smeta = ORM::factory('Smeta');
            $smeta->name = uniqid();
            $smeta->create_date = date('Y-m-d H:i:s');
        }

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
            $smeta_room->door_enable = $room['door_enable'];
            $smeta_room->materials_enable = $room['materials_enable'];
            $smeta_room->save();
            
            //======= двери
//            $door = $room['door'];
//            $smeta_door = ORM::factory('Smeta_Door');
//            $smeta_door->is_room =$door['is_room'];
//            $smeta_door->smeta_id = $smeta->id;
//            $smeta_door->room_params_def = $door['type'];
//            $smeta_door->enable = $door['enable'];
//            $smeta_door->height = $door['height'];
//            $smeta_door->width = $door['width'];
//            $smeta_door->show = $door['show'];
//            $smeta_door->count = $door['count'];
//            $smeta_door->create();
            
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
                $smeta_work->enable = $work['enable'];
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
        foreach($doors as $key => $door){
            $smeta_door = ORM::factory('Smeta_Door');
            $smeta_door->is_room = $key === 0 ? 1 : 0 ;
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
        if($smeta_id==0){
            $result[] = array('smeta_name'=>$smeta->name);
        } else {
            $result[] = array('smeta_name'=>'');
        }
        $this->set('_result', json_encode($result));
    }
}