<?php

class Controller_Admin_Groups extends Template_Admin
{
    /**
     * @var  View  page template
     */
    public $template = 'admin/index';

    public function before() {
        parent::before();
        
        $this->template->title   = 'Группы';
    }


    public function action_index()
    {
        $object = ORM::factory('type');
        

        $this->template->content                = View::factory('admin/blocks/groups/index');
        $this->template->content->objects       = $object->get_objects();
    }
   

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {  
                
        $this->template->content =  View::factory('admin/blocks/groups/edit');
        $object = ORM::factory('type');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_type($_POST);
                HTTP::redirect($_SERVER['HTTP_REFERER']);
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->content->title = 'Добавить группу';
        $this->template->content->errors = $errors;
        $this->template->content->object = $object;
  
 
                
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit()
    {
        $object = ORM::factory('type', $this->request->param('param'));
        $this->template->content =  View::factory('admin/blocks/groups/edit');
        $errors = array();

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_type( $_POST );

                HTTP::redirect($_SERVER['HTTP_REFERER']);
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->title 	= 'Редактирование';

        $this->template->content 	= View::factory('admin/blocks/partner/edit');
        $this->template->content->object = $object;
        $this->template->content->errors = $errors;
    }

    /**
     * Удаление работу
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('type', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect($_SERVER['HTTP_REFERER']);
//            HTTP::redirect('/admin/group');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function after() {
		if(empty($this->template->left_menu->links))
                    $this->template->content->class = ' full-content';
		parent::after();
	}
}
