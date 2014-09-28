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
            $smeta_room->save();
        }
        $result[] = array('smeta_name'=>$smeta->name);
        $this->set('_result', json_encode($result));
    }

    public function action_load(){
        $post = $this->request->post();
        $smeta_name = Arr::get($post, 'smeta', '');
        $smeta = ORM::factory('Smeta')->where('name','=',$smeta_name)->find()->as_array();
        $this->set('_result', json_encode($smeta));
    }
}