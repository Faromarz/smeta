<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Smeta extends Controller
{
    protected $user = false;

    public function before()
    {
        parent::before();
        if (method_exists(Auth::instance(), 'auto_login')) {
            Auth::instance()->auto_login();
        }
        $this->user = Auth::instance()->get_user();
        if ( ! $this->request->is_ajax())
        {
            throw new HTTP_Exception_500('Неверный запрос');
        }
    }

    public function action_index()
    {
        throw new HTTP_Exception_404;
    }

    public function action_add(){
        $result = array();
        $rooms = json_decode($_POST['rooms'], true);
        $smeta = ORM::factory('Smeta');
        $smeta->name = uniqid();
        $smeta->geo_id = 0;
        $smeta->size = Arr::get($_POST, 'size', '');
        $smeta->height =  Arr::get($_POST, 'height', '');
        $smeta->price_materials =  Arr::get($_POST, 'price_materials', '');
        $smeta->price_work_dem =  Arr::get($_POST, 'price_work_dem', '');
        $smeta->price_work_mon =  Arr::get($_POST, 'price_work_mon', '');
        $smeta->time_work_dem =  Arr::get($_POST, 'time_work_dem', '');
        $smeta->time_work_mon =  Arr::get($_POST, 'time_work_mon', '');
        $smeta->room_name =  Arr::get($_POST, 'room_name', '');
        $smeta->partner_id = 0;
        $smeta->repair_id = $_POST['types'][0];
        $smeta->rate_id = $_POST['types'][1];
        $smeta->apartment_id = $_POST['types'][2];
        $smeta->create_date = date('Y-m-d H:i:s');
        $smeta->save();
        $count_rooms=1;
        foreach($rooms as $room){
            if($room['show']==1){
                if(($room['type']=='1' && $count_rooms<=(int)Arr::get($_POST, 'count_rooms', 0)) || $room['type']!='1'){
                    $smeta_room = ORM::factory('Smeta_Room');
                    $smeta_room->smeta_id = $smeta->id;
                    $smeta_room->room_id = (int) $room['id'];
                    $smeta_room->length = $room['length'];
                    $smeta_room->width = $room['width'];
                    $smeta_room->balcony = $room['balcony'];
                    $smeta_room->show = 1;
                    $smeta_room->save();
                    if($room['type']=='1') $count_rooms++;
                    foreach($room['materials'] as $material){
                        if($material['show']==1){
                            $smeta_material = ORM::factory('Smeta_Material');
                            $smeta_material->smeta_id = $smeta->id;
                            $smeta_material->room_id = $room['id'];
                            $smeta_material->material_id = $material['mat_id'];
                            $smeta_material->save();
                        }
                    }
                    foreach($room['works'] as $work){
                        $smeta_work = ORM::factory('Smeta_Work');
                        $smeta_work->smeta_id = $smeta->id;
                        $smeta_work->room_id =  $room['id'];
                        $smeta_work->work_id = $work['work_id'];
                        $smeta_work->price =  $work['price'];
                        $smeta_work->count = $work['count'];
                        $smeta_work->save();
                    }
                }
            } else{
                $smeta_room = ORM::factory('Smeta_Room');
                $smeta_room->smeta_id = $smeta->id;
                $smeta_room->room_id = (int) $room['id'];
                $smeta_room->length = $room['length'];
                $smeta_room->width = $room['width'];
                $smeta_room->balcony = $room['balcony'];
                $smeta_room->show = 0;
                $smeta_room->save();
            }
        }
        $result[] = array('smeta_name'=>$smeta->name);
        die(json_encode($result));
    }


    public function action_load(){
        $result = array();
        $smeta_name = Arr::get($_POST, 'smeta', '');
        $smeta = ORM::factory('Smeta')->where('name','=',$smeta_name)->find();
        $result[] = array('id'=>$smeta->id, 'geo_id'=>$smeta->geo_id, 'size'=> $smeta->size, 'height'=> $smeta->height, 'price_materials'=> $smeta->price_materials, 'price_work_dem'=> $smeta->price_work_dem
        , 'price_work_mon'=> $smeta->price_work_mon, 'time_work_dem'=> $smeta->time_work_dem, 'time_work_mon'=> $smeta->time_work_mon, 'room_name'=> $smeta->room_name
        , 'partner_id'=> $smeta->partner_id, 'repair_id'=> $smeta->repair_id, 'rate_id'=> $smeta->rate_id, 'apartment_id'=> $smeta->apartment_id);
        die(json_encode($result));
    }
}