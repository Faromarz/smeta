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

        // камнаты
        $rooms = DB::select('*')
                ->from('rooms')
                ->order_by('id')
                ->execute()
                ->as_array();
        foreach ($rooms as $key => $room) {
            // дверь
            $doors = ORM::factory('Roomparamsdef')
                    ->join('rooms_doors')->on('roomparamsdef.id', '=', 'rooms_doors.door_id')
                    ->where('rooms_doors.room_id', '=', $room['id'])
                    ->find()->as_array();
            $doors['enable'] = false;
            $doors['show'] = $room['show'];
            $doors['count'] = 1;
            $door['id'] = null;
            $rooms[$key]['door'] = $doors;
        }
        $this->set('_rooms', $rooms);
   
        // дверь
        $door = ORM::factory('Roomparamsdef')
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
}
