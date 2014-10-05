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
            
            // ================ дверь
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
            
            // ================ окна
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
            // ================ категории
            $categories = ORM::factory('Material_Categories')->getCategoriesForRoomId($room['id']);
            $rooms[$key]['categories'] = $categories;
        }
        return $rooms;
    }
    
//    public static function getMaterialsForCat($catId)
//    {
//        $result = array();
//        $limit = 21;
//        $category = ORM::factory('Material_Categories', (int) $catId);
//        if ($category->count_materials()>0){
//            $materials = ORM::factory('Material')->where('category_id','=',$category->id)->order_by('price','ASC')->find_all();
//            $for_result = array();
//            foreach ($materials as $material){
//                $for_result[] = array(
//                    'category_id'=>$material->category_id,
//                    'id'=>$material->id,
//                    'name'=>$material->name,
//                    'price'=>$material->price,
//                    'img'=>$material->img,
//                    'country'=>$material->country->name,
//                    'count_text'=>$material->count_text,
//                    'size'=>$material->size,
//                    'selected'=> 0
//                );
//            }
//            if (count($for_result) <= $limit) {
//                $i=0;
//                foreach ($for_result as $key => $value)
//                {
//                    $for_result[$key]['selected'] = $i==0?1:0;
//                    $i++;
//                }
//                $result = array_merge($result,$for_result);
//            } else {
//                $for_result = array_chunk($for_result, (int) (count($for_result) / $limit));
//                array_walk($for_result, create_function('&$p', '$p = $p[array_rand($p, 1)];'));
//                $for_result = array_slice($for_result, 0, $limit);
//                $i=0;
//                foreach ($for_result as $key => $value)
//                {
//                    $for_result[$key]['selected'] = $i==10?1:0;
//                    $i++;
//                }
//                $result = array_merge($result,$for_result);
//            }
//        }
//        return $result;
//    }
    
}
