<?php

class Controller_Admin_Partner extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */
    public function before() {
        parent::before();

        $this->template->v_body->v_left_menu->links = array(
            '/admin/partner/create'	=> 'Добавить категорию',
            '/admin/partner/index'	=> 'Список категорий',
            '/admin/partners/create'	=> 'Добавить партнера',
        );
        $this->template->title   = 'Партнеры';
    }


    public function action_index()
    {
        $object = ORM::factory('Partner');

        $pagination = $object->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/partner/index');
        $this->template->v_body->v_page->objects	= $object->get_objects($pagination);
        $this->template->v_body->v_page->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }
   

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
       
        $region_obj = new Model_Geo();
                
//        $region_obj->define_region();
        $select_country = $region_obj->generate_select_c();
        $select_regions = $region_obj->generate_select_r();
        
        $Partner_obj = new Model_Partner();
        $select_partner = $Partner_obj->generate_select_cat();
                
                
        $this->template->v_body->v_page =  View::factory('admin/blocks/partner/edit')
                ->bind("select_partner", $select_partner)
                ->bind("select_country", $select_country)
                ->bind("select_regions", $select_regions);
        $object = ORM::factory('Partner');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_group($_POST);

                HTTP::redirect("/admin/partner/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page->errors = $errors;
        $this->template->v_body->v_page->object = $object;
  
 
                
    }

    /**
     * Редактирование основних параметров работи в портфолио
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_edit()
    {
        $object = ORM::factory('Partner')->where('partner.id', '=', $this->request->param('param'))->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/partner/edit');
        $errors = array();

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_article( $_POST );
                $work = ORM::factory('Partner', $object->id);
                $work->update_article( $_POST );

                HTTP::redirect("/admin/partner/");
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
            }
        }

        $this->template->v_body->v_page 	= View::factory('admin/blocks/partner/edit');
        $this->template->v_body->v_page->object = $object;
        $this->template->v_body->v_page->errors = $errors;
    }

    /**
     * Удаление работу
     *
     * @throws Kohana_HTTP_Exception_404
     */
    public function action_delete()
    {
        $object = ORM::factory('Partner', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/partner');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content';
		parent::after();
	}
}
