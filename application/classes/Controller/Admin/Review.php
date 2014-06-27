<?php

class Controller_Admin_Review extends Controller_Admin_Index
{
	/**
	 * @var  View  page template
	 */

	public function before() {
		parent::before();
		
//		$this->template->left_menu->links = array(
//			'/admin/articles/create' => 'Добавить статью',
//		);
	}


	public function action_index()
	{
              $this->template->v_body->v_page = View::factory('admin/blocks/review/index');
                $this->template->v_body->v_page->class = ' full-content pages';
		$object = ORM::factory('Review');
		
		$pagination = $object->get_pagination();
		
		$this->template->title   = 'iRen - administration system';
		$this->template->v_body->v_page->objects	 = $object->get_objects();
		$this->template->v_body->v_page->pagination	 = $pagination;
	}
	
	/**
	 * Новая работа в портфолио
	 */
	public function action_create()
	{
                $this->template->v_body->v_page = View::factory('admin/blocks/review/edit');
                $this->template->v_body->v_page->class = ' full-content pages';
		$object = ORM::factory('Review');
		$errors = array();
		
		if ($_POST)
		{
			try
			{
				// Создаём запись
				$object = $object->create_article($_POST);
				
				Http::redirect("/admin/review/");
			}
			catch (ORM_Validation_Exception $e) 
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title = 'Добавить отзыв';
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
		$object = ORM::factory('Review', $this->request->param('param'));
		$this->template->v_body->v_page =  View::factory('admin/blocks/review/edit');
		$errors = array();
		
		// Если рабр\оти нет, тогда 404 ошибка
		if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
	
		if ( $_POST )
		{
			try
			{
                                // Обновление даних
                                $object->update_article( $_POST );

                                HTTP::redirect("/admin/review/");
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title 	= 'Редактирование';
		
		$this->template->v_body->v_page 	= View::factory('admin/blocks/review/edit');
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
		$object = ORM::factory('Review', $this->request->param('param'));
		
		if ( $object->loaded() ) {
			
			$object->delete();
			HTTP::redirect('/admin/review');

		} else {
			throw new Kohana_HTTP_Exception_404("Страница не найдена");
		}
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content pages';
		parent::after();
	}
}
