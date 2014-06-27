<?php

class Controller_Admin_Footer extends Controller_Admin_Index
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
                $object = ORM::factory('Footer', (int)$_POST['id']);
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
            $work = ORM::factory('Footer',(int)$_POST['id'])->delete();
        }
        $this->template->styles[] = '/resources/css/admin/timpl.css';
        $object = ORM::factory('Footer');

//        $pagination = $object->where('type_id' , '=', 31)->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/footer/index');
        $this->template->v_body->v_page->objects	 = $object->order_by('id')->find_all();
//        $this->template->v_body->v_page->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/footer/edit');
        $object = ORM::factory('Footer');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->create_type($_POST);

                HTTP::redirect("/admin/footer/");
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
        $object = ORM::factory('Footer')->where('id', '=', $this->request->param('param'))
               ->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/footer/edit');
        $errors = array();
        $id = $object->id;
        $count = ORM::factory('Footer')->where('id', '<=', $id)->where('type_id', '=', 31)->count_all();
        $page = ceil ($count/10);
        $next = ORM::factory('Footer')->where('id', '=', $id+1)->where('type_id', '=', 31)->find();
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
                        HTTP::redirect('/admin/footer/?page='.$page);
                    }else{
                        HTTP::redirect('/admin/footer/edit/'.$id);
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
        $object = ORM::factory('Footer', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/footer');

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
