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
        $rooms = json_decode($_POST['rooms']);
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
        $order = 1;
        foreach($rooms as $room){var_dump($room); echo '<br>';
         /*   if($room['show']==1){
                if(($room['type']=='1' && $count_rooms<=(int)Arr::get($_POST, 'count_rooms', 0)) || $room['type']!='1'){
                    $smeta_room = ORM::factory('Smeta_Room');
                    $smeta_room->smeta_id = $smeta->id;
                    $smeta_room->room_type_id = (int) $room['type'];
                    $smeta_room->order = $order++;
                    $smeta_room->length = $room['length'];
                    $smeta_room->width = $room['width'];
                    $smeta_room->balcony = $room['balcony'];
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
                        $smeta_work->save();
                    }
                }
            }*/
        }

    }
}