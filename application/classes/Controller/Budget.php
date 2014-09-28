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
            $this->set('_rooms', $rooms);
            
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