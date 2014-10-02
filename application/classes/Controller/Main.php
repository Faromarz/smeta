<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller_Core
{

    public function action_index()
    {
        $types_rate = ORM::factory('Types_Rate')->find_all();
        $types_repair = ORM::factory('Types_Repair')->find_all();
        $types_apartment = ORM::factory('Types_Apartment')->find_all();

        $this->set('types_rate',$types_rate);
        $this->set('types_repair',$types_repair);
        $this->set('types_apartment',$types_apartment);

        // комнаты
        $rooms = $this->getRooms();
        $this->set('_rooms', $rooms);
   
        // двери дополнительные
        $door = ORM::factory('Roomparamsdef')
                ->select(array('roomparamsdef.id', 'type'))
                ->join('rooms_doors')->on('roomparamsdef.id', '=', 'rooms_doors.door_id')
                ->where('rooms_doors.room_id', '=', 1)
                ->find()->as_array();
        $door['enable'] = false;
        $door['show'] = false;
        $door['count'] = 1;
        $door['id'] = null;
        $doors = array(
            0 => $door,
            1 => $door,
            2 => $door
        );
        $this->set('doors', $doors);
        
        // окна дополнительные
        $window = ORM::factory('Roomparamsdef')
                ->select(array('roomparamsdef.id', 'type'))
                ->join('rooms_windows')->on('roomparamsdef.id', '=', 'rooms_windows.window_id')
                ->where('rooms_windows.room_id', '=', 1)
                ->find()->as_array();
        $window['enable'] = false;
        $window['show'] = false;
        $window['count'] = 1;
        $window['id'] = null;
        $window['count_type'] = 2;
        $windows = array(
            0 => $window,
            1 => $window,
            2 => $window
        );
        $this->set('windows', $windows);

        // параметры комнат
        $params = DB::select('*')
                ->from('room_params_def')
                ->order_by('id')
                ->execute()
                ->as_array();
        $this->set('_params', $params);

        // количество партнерев
        $countPartners = ORM::factory('Partner')->count_all();
        $this->set('_countPartners', $countPartners);
    }
    public static function getRooms()
    {
        $rooms = DB::select('*')
                ->from('rooms')
                ->order_by('id')
                ->execute()
                ->as_array();
        foreach ($rooms as $key => $room) {
            // дверь
            $doors = ORM::factory('Roomparamsdef')
                    ->select(array('roomparamsdef.id', 'type'))
                    ->join('rooms_doors')->on('roomparamsdef.id', '=', 'rooms_doors.door_id')
                    ->where('rooms_doors.room_id', '=', $room['id'])
                    ->find()->as_array();
            $doors['enable'] = false;
            $doors['show'] = $room['show'];
            $doors['count'] = 1;
            $doors['id'] = null;
            $rooms[$key]['door'] = $doors;
            // окна
            $windows = ORM::factory('Roomparamsdef')
                    ->select(array('roomparamsdef.id', 'type'))
                    ->join('rooms_windows')->on('roomparamsdef.id', '=', 'rooms_windows.window_id')
                    ->where('rooms_windows.room_id', '=', $room['id'])
                    ->find();
            
            if($windows->loaded()){
                $windows = $windows->as_array();
                $windows['enable'] = false;
                $windows['show'] = $room['show'];
                $windows['count'] = 1;
                $windows['count_type'] = 2;
                $windows['id'] = null;
                $rooms[$key]['window'] = $windows;
            } else{
                $rooms[$key]['window'] = NULL;
            }
        }
        return $rooms;
    }
    
}
