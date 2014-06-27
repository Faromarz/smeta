<?php

class Controller_Admin_Helps extends Controller_Admin_Index
{
    /**
     * @var  View  page template
     */

    public function before() {
        parent::before();

//        $this->template->left_menu->links = array(
//            '/admin/timpl/create'	=> 'Добавить работу',
//        );
    }


    public function action_index()
    {
        if(isset($_POST['save'])){
             try
            {
                // Обновление даних
                $object = ORM::factory('Help', (int)$_POST['id']);
                $object->update_type( $_POST );
                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = Arr::flatten($e->errors(""));
                if(isset($_POST['ajax'])){
                    die ($errors);
                }
            }
            
        }elseif(isset ($_POST['del'])){
            $work = ORM::factory('Help',(int)$_POST['id'])->delete();
        }
        $this->template->styles[] = '/resources/css/admin/timpl.css';
        $object = ORM::factory('Help');

        $pagination = $object->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/help/index');
        $this->template->v_body->v_page->objects	 = $object->order_by('id')->find_all();
        $this->template->v_body->v_page->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/help/edit');
        $object = ORM::factory('Help');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_type($_POST);

                HTTP::redirect("/admin/helps/");
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
        $object = ORM::factory('Help')->where('id', '=', $this->request->param('param'))
               ->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/help/edit');
        $errors = array();
        $id = $object->id;
        $count = ORM::factory('Help')->where('id', '<=', $id)->where('type_id', '=', 31)->count_all();
        $page = ceil ($count/10);
        $next = ORM::factory('Help')->where('id', '=', $id+1)->where('type_id', '=', 31)->find();
        if($next->loaded())$id = $next->id;

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_type( $_POST );
              

                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    if(isset($_POST['save'])){
                        HTTP::redirect('/admin/helps/?page='.$page);
                    }else{
                        HTTP::redirect('/admin/helps/edit/'.$id);
                    }
                }
            }
            catch (ORM_Validation_Exception $e)
            {
                if(isset($_POST['ajax'])){
                    die (Arr::flatten($e->errors("")));
                }else{
                    $errors = Arr::flatten($e->errors(""));
                }
            }
        }

        $this->template->title 	= 'Редактирование';

        $this->template->v_body->v_page 	= View::factory('admin/blocks/help/edit');
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
        $object = ORM::factory('Help', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/helps');

        } else {
            throw new Kohana_HTTP_Exception_404("Страница не найдена");
        }
    }
    public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page->class = ' full-content';
		parent::after();
	}
}
