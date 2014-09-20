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
        $rooms = ORM::factory('Room')->order_by('id', 'ASC')->find_all();
        $_rooms = array();
        foreach ($rooms as $key => $room) {
            $_rooms[$key] = $room->as_array();
        }
        $this->set('_rooms', $_rooms);

        // параметры комнат
        $params = ORM::factory('Roomparamsdef')->order_by('id', 'ASC')->find_all();
        $_params = array();
        foreach ($params as $key => $param) {
            $_params[$key] = $param->as_array();
        }
        $this->set('_params', $_params);

        // количество партнерев
        $countPartners = ORM::factory('Partner')->count_all();
        $this->set('_countPartners', $countPartners);
    }
}
