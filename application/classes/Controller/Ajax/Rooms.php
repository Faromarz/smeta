<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax_Rooms extends Controller
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

    public function action_get_rooms()
    {
        $post = $this->request->post();
        $smetaId = 0;
        if($post){
            $smetaId = (int) Arr::get($post, 'smetaId', false);
        }
        if ($smetaId === 0){
            $rooms = Controller_Main::getRooms(true);
        } else {
            $rooms = Controller_Budget::getRooms($smetaId, true);
        }
        die(json_encode($rooms));
    }
    public function action_get_okna()
    {
        $okna = DB::select('*')
                ->from('okna')
                ->order_by('id')
                ->execute()
                ->as_array();
        die(json_encode($okna));
    }
    public function action_load_rooms()
    {
        $result = array();
        $rooms = ORM::factory('Room')->find_all();
        foreach ($rooms as $room){
            $params = array(
                'id'=> (int)$room->id,
                'title'=>$room->name,
                'type' => (int)$room->type,
                'length' => $room->length,
                'width' => $room->width,
                'square' => ($room->length*$room->width),
                'show' => (bool)$room->show
            );
            if ($room->balcony !== NULL) {
                $params['balcony'] = $room->balcony;
            }
            $result[] = $params;
        }
        die(json_encode($result));
    }

    public function action_load_rooms_smeta()
    {
        $result = array();
        $id = (int) Arr::get($_POST, 'id', 0);
        $rooms_smeta = ORM::factory('Smeta_Room')->where('smeta_id','=',$id)->find_all();
        foreach ($rooms_smeta as $room){
            $materials=array();
            $smeta_materials = ORM::factory('Smeta_Material')->where('smeta_id','=',$id)->where('room_id','=',$room->room_id)->find_all();
            foreach ($smeta_materials as $smeta_material){
                $cat = $smeta_material->materials->category->category_parent;
                $under_cat = $smeta_material->materials->category;
                $materials[] = array(
                    'calc'=> $cat->loaded()?$cat->calculation:$under_cat->calculation,
                    'cat_id'=> $cat->loaded()?$cat->id:$under_cat->id,
                    'mat_id' => $smeta_material->material_id,
                    'show' => 1,
                    'under_id' => $cat->loaded()?$under_cat->id:0);
            }
            $result[] = array('id'=>$room->room_id, 'name'=>$room->rooms->name, 'type' => $room->rooms->type, 'length' => $room->length, 'width' => $room->width, 'square' => ($room->length*$room->width), 'show' => $room->show, 'balcony' => 0, 'materials'=>$materials);
        }
        die(json_encode($result));
    }

}