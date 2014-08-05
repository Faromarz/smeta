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

    public function action_load_rooms()
    {
        $result = array();
        $rooms = ORM::factory('Room')->find_all();
        foreach ($rooms as $room){
                $result[] = array('id'=>$room->id, 'name'=>$room->name, 'type' => $room->type, 'length' => $room->length, 'width' => $room->width, 'square' => ($room->length*$room->width), 'show' => 1);
        }
        die(json_encode($result));
    }

}