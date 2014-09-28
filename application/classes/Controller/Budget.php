<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Budget extends Controller_Core {

    public function action_index() {
        $name = $this->request->param('name');
        if (empty($name)) {
            throw new HTTP_Exception_404;
        }  else {
            $smeta = ORM::factory('Smeta')
                    ->where('smeta.name', '=', $name)
                    ->find();
            $rooms = DB::select('room.id')
                    ->select('smeta_room.width')
                    ->select('smeta_room.length')
                    ->select('smeta_room.enable')
                    ->select('smeta_room.balcony')
                    ->select('smeta_room.show')
                    ->select('room.alias')
                    ->select('room.type')
                    ->select('room.name')
                    ->select(array('smeta_room.id', 'smetaRoomId'))
                    ->from(array('smeta_rooms', 'smeta_room'))
                    ->join(array('rooms', 'room'), 'inner')
                        ->on('smeta_room.room_id', '=', 'room.id')
                    ->where('smeta_id', '=', $smeta->id)
                ->order_by('room.id')
                ->execute()
                ->as_array();
            if (!$smeta->loaded()) {
                throw new HTTP_Exception_404;
            }
            $this->set('smeta', $smeta->as_array());
            foreach ($rooms as $key => $room) {
                // дверь
                $door = ORM::factory('Smeta_Door')
                        ->select(array('room_params_def.id', 'type'))
                        ->select(array('smeta_door.id', 'id'))
                        ->select(array('smeta_door.height', 'height'))
                        ->select(array('smeta_door.width', 'width'))
                        ->join('room_params_def')->on('room_params_def.id', '=', 'smeta_door.room_params_def')
                        ->where('smeta_door.smeta_rooms_id', '=', (int)$room['smetaRoomId'])
                        ->find()->as_array();
                $rooms[$key]['door'] = $door;
            }
            $this->set('_rooms', $rooms);

            // дверь
             $doors = DB::select('*')
                    ->select(array('room_params_def.id', 'type'))
                    ->select(array('smeta_doors.id', 'id'))
                    ->select(array('smeta_doors.height', 'height'))
                    ->select(array('smeta_doors.width', 'width'))
                    ->from('smeta_doors')
                    ->join('room_params_def')->on('room_params_def.id', '=', 'smeta_doors.room_params_def')
                    ->where('smeta_doors.smeta_rooms_id', '=', 0)
                    ->where('smeta_doors.smeta_id', '=', $smeta->id)
                    ->execute()
                    ->as_array();

            $this->set('doors', $doors);
            
            // параметры комнат
            $params = DB::select('*')
                    ->from('room_params_def')
                    ->order_by('id')
                    ->execute()
                    ->as_array();
            $params[0]['height'] = $smeta->height;
            $this->set('_params', $params);
        
        }
    }
}