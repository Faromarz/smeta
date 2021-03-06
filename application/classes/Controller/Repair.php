<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Repair extends Controller_Main
{

    public function action_index()
    {
        $_id = $this->request->param('id');
        $this->set('_id', $_id);
        $_cat = $this->request->param('cat');
        $this->set('_cat', $_cat);
        $_alias = $this->request->param('alias');
        $this->set('_alias', $_alias);
        
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
        
        
        $object = ORM::factory('Article_Categories')->roots();
        $this->set('categories', $object);
        
        $id = $_cat ? $_cat : $_id;
        if ($id) {
            $categoty = ORM::factory('Article_Categories', $id);
            $news = $categoty->articles->find_all();
        } elseif(!empty ($_alias)) {
            $news = ORM::factory('Article')->where('alias', '=', $_alias)->find();
            $cat = $news->category;
            if ($cat->lvl) {
                $this->set('_id', $cat->parent_id);
                $this->set('_cat', $cat->id);
            } else {
                $this->set('_id', $cat->id);
            }
        } else{
            $news = ORM::factory('Article')->find_all();
        }
        $this->set('_news', $news);
    }
}
