<?php

class Controller_Admin_Rooms extends Controller_Admin_Index
{

    /**
     * @var  View  page template
     */
    public function before()
    {
        parent::before();
    }

    public function action_index()
    {
        $objects = ORM::factory('Room')->find_all();
        $this->set('_rooms', $objects);
    }

    /**
     * Новая категория
     */
    public function action_create()
    {
        $errors = array();
        if($this->request->post()){
            $post = $this->request->post();
            $room = ORM::factory('Room');
            $room->name = $post['name'];
            $room->type = $post['type'];
            $room->create();
            HTTP::redirect('/admin/rooms');
        }

//        if ($_POST) {
//            try {
////                // Создаём запись
////                $object = $object->create_article($_POST);
////
////                HTTP::redirect("/admin/category/");
//            } catch (ORM_Validation_Exception $e) {
//                $errors = Arr::flatten($e->errors(""));
//            }
//        }
        $objects = ORM::factory('Room')->find_all();
        $this->set('_room', $objects);
        $this->set('_errors', $errors);
    }

    public function action_save()
    {
        $array = array();
        if ($this->request->post()) {
            $name = (string) Arr::get($_POST, 'name', false);
            $id = (int) Arr::get($_POST, 'pk', false);
            $value = trim(Arr::get($_POST, 'value', false));

            if ($name && $id && ($name == 'name' && $value != '' || in_array($name, array('img_title', 'img_alt')))) {
                $object = ORM::factory('Room', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('type', 'name'))) {
                        $object->$name = $value;
                        $object->save();
                        $array = array('save' => 'ok');
                    } else {
                        $array = array('error' => 'atribut ' . $name . ' not found');
                    }
                } else {
                    $array = array('error' => 'room not found');
                }
            } else {
                $array = array('error' => 'data');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }

    /**
     * Редактирование основних параметров работи в портфолио
     * 
     * @throws Kohana_HTTP_Exception_404
     */
//    public function action_edit()
//    {
//        $object = ORM::factory('category', $this->request->param('param'));
//        $this->template->v_body->v_page = View::factory('admin/blocks/category/edit');
//        $errors = array();
//
//        // Если рабр\оти нет, тогда 404 ошибка
//        if (!$object->loaded())
//            throw new Kohana_HTTP_Exception_404("Страница не найдена");
//
//        if ($_POST) {
//            try {
//                // Обновление даних
//                $object->update_article($_POST);
//
//                HTTP::redirect("/admin/category/");
//            } catch (ORM_Validation_Exception $e) {
//                $errors = Arr::flatten($e->errors(""));
//            }
//        }
//
//        $this->template->title = 'Редактирование';
//
//        $this->template->v_body->v_page = View::factory('admin/blocks/category/edit');
//        $this->template->v_body->v_page->object = $object;
//        $this->template->v_body->v_page->errors = $errors;
//    }

    /**
     * 
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('Room', $this->request->param('id'));

        if ($object->loaded()) {
            $object->delete();
            HTTP::redirect('/admin/rooms');
        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }

    public function after()
    {
        parent::after();
    }
}
