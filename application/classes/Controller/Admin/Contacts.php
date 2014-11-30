<?php

class Controller_Admin_Contacts extends Controller_Admin_Index
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
        $object = ORM::factory('Contacts', 1);
        $this->set('item', $object);
    }
    public function action_save()
    {
        $this->default_template = 'json';
        $array = array();
        if ($this->request->post()) {
            $name = (string) Arr::get($this->request->post(), 'name', false);
            $id = (int) Arr::get($this->request->post(), 'pk', false);
            $value = Arr::get($this->request->post(), 'value', false);

            if ($name && $id) {
                $object = ORM::factory('Contacts', $id);
                if ($object->loaded()) {
                    if (in_array($name, array('phone_remont', 'phone_partner', 'email', 'name', 'address_legal', 'address_for_correspondence', 'address', 'ogrn', 'inn', 'cpp'))) {
                        $object->$name = trim($value);
                        try {
                            $object->save();
                            $array = array('save' => 'ok');
                        } catch (ORM_Validation_Exception $e) {
                            $array = array('error' => $e);
                        }
                    } else {
                        $array = array('error' => 'atribut ' . $name . ' not found');
                    }
                } else {
                    $array = array('error' => 'contact not found');
                }
            } else {
                $array = array('error' => 'data');
            }
        } else {
            $array = array('error' => 'data empty');
        }
        $this->set('_result', json_encode($array));
    }

    public function after()
    {
        parent::after();
    }
}
