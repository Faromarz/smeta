<?php

class Controller_Admin_Timpl extends Controller_Admin_Index
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
                $object = ORM::factory('product', (int)$_POST['id']);
                $object->update_article( $_POST );
                $work = ORM::factory('worktimpl', $object->id);
                $work->update_article( $_POST );
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
            $work = ORM::factory('Worktimpl',(int)$_POST['id'])->delete();
            $object = ORM::factory('Product',(int)$_POST['id'])->delete();
        }
        $this->template->styles[] = '/resources/css/admin/timpl.css';
        $object = ORM::factory('Product')->select('work_timpl.material','work_timpl.vurav','work_timpl.chtycat','work_timpl.okras','work_timpl.ystan_t','work_timpl.ystan_osv')
                ->join('work_timpl')->on('product.id', '=', 'work_timpl.product_id');

//        $pagination = $object->where('type_id' , '=', 31)->get_pagination();

        $this->template->v_body->v_page = View::factory('admin/blocks/timpl/index');
        $this->template->v_body->v_page->objects	 = $object->where('type_id' , '=', 31)->order_by('product.id')->find_all();
//        $this->template->v_body->v_page->pagination = $pagination;
        
//        echo View::factory('profiler/stats');
    }

    /**
     * Новая работа в портфолио
     */
    public function action_create()
    {
        $this->template->v_body->v_page =  View::factory('admin/blocks/timpl/edit');
        $object = ORM::factory('Product');
        $errors = array();

        if ($_POST)
        {
            try
            {
                // Создаём запись
                $object = $object->values($_POST)->create();

                HTTP::redirect("/admin/timpl/");
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
        $object = ORM::factory('Product')->where('product.id', '=', $this->request->param('param'))
                ->select('work_timpl.*')->join('work_timpl')->on('product.id', '=', 'work_timpl.product_id')->find();
        $this->template->v_body->v_page =  View::factory('admin/blocks/timpl/edit');
        $errors = array();
        $id = $object->id;
        $count = ORM::factory('Product')->where('id', '<=', $id)->where('type_id', '=', 31)->count_all();
        $page = ceil ($count/10);
        $next = ORM::factory('Product')->where('id', '=', $id+1)->where('type_id', '=', 31)->find();
        if($next->loaded())$id = $next->id;

        // Если рабр\оти нет, тогда 404 ошибка
        if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");

        if ( $_POST )
        {
            try
            {
                // Обновление даних
                $object->update_article( $_POST );
                $work = ORM::factory('Worktimpl', $object->id);
                $work->update_article( $_POST );

                if(isset($_POST['ajax'])){
                    die ('сохранил');
                }else{
                    if(isset($_POST['save'])){
                        HTTP::redirect('/admin/timpl/?page='.$page);
                    }else{
                        HTTP::redirect('/admin/timpl/edit/'.$id);
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

        $this->template->v_body->v_page 	= View::factory('admin/blocks/timpl/edit');
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
        $object = ORM::factory('Product', $this->request->param('param'));

        if ( $object->loaded() ) {

            $object->delete();
            HTTP::redirect('/admin/timpl');

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
