<?php

class Controller_Admin_Articles extends Controller_Admin_Index
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
		$object = ORM::factory('Article')->where('block', '=', 0);
		
		$pagination = $object->get_pagination();
		
		$this->template->v_body->v_page = View::factory('admin/blocks/articles/index');
		$this->template->v_body->v_page->objects	 = $object->get_objects();
//		$this->template->v_body->v_page->objects	 = $object->get_objects($pagination);
		$this->template->v_body->v_page->pagination = $pagination;
	}
	
	/**
	 * Новая работа в портфолио
	 */
	public function action_create()
	{
		$this->template->v_body->v_page =  View::factory('admin/blocks/articles/edit');
		$object = ORM::factory('Article')->where('block', '=', 0);
		$errors = array();
		
		if ($_POST)
		{
			try
			{
				// Создаём запись
				$object = $object->create_article($_POST);
				
				HTTP::redirect("/admin/articles/");
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
		$object = ORM::factory('Article', $this->request->param('param'));
		$this->template->v_body->v_page =  View::factory('admin/blocks/articles/edit');
		$errors = array();
		
		// Если рабр\оти нет, тогда 404 ошибка
		if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
	
		if ( $_POST )
		{
			try
			{
				// Обновление даних
				$object->update_article( $_POST );
                                if(isset($_FILES['img']['tmp_name'])){
                                    $file = $_FILES['img']['tmp_name'];
                                    $name = $_FILES['img']['name'];
                                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                    $object->img = $this->_upload_img($file, $ext, $object->pk());
                                    $object->save();
                                }
                                

				HTTP::redirect("/admin/articles/");
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title 	= 'Редактирование';
		
		$this->template->v_body->v_page 	= View::factory('admin/blocks/articles/edit');
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
		$object = ORM::factory('Article', $this->request->param('param'));
		
		if ( $object->loaded() ) {
			
			$object->delete();
			HTTP::redirect('/admin/articles');

		} else {
			throw new Kohana_HTTP_Exception_404("Страница не найдена");
		}
	}
	public function action_delimg()
	{
		$object = ORM::factory('Article', $this->request->param('param'));
		
		if ( $object->loaded() ) {
			
                        if (is_file('resources/images/category/about_'.$object->img)){
                            if (unlink('resources/images/category/about_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/about_140_'.$object->img)){
                            if (unlink('resources/images/category/about_140_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/about_290_'.$object->img)){
                            if (unlink('resources/images/category/about_290_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/about_100_100_'.$object->img)){
                            if (unlink('resources/images/category/about_100_100_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/about_40_40_'.$object->img)){
                            if (unlink('resources/images/category/about_40_40_'.$object->img)){}
                        }
			$object->img = NULL;
                        $object->save();
			HTTP::redirect('/admin/articles/edit/'.$this->request->param('param'));

		} else {
			throw new Kohana_HTTP_Exception_404("Страница не найдена");
		}
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->v_body->v_page->class = ' full-content pages';
		parent::after();
	}
        public function _upload_img($file,$ext,$filename) {
            if ($ext == NULL) {   $ext = 'jpg';        }
            if ($filename == NULL) {  
                 $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';
                $filename = '';
                
                for ($i = 0; $i < 10; $i++) {
                    $key = rand(0, strlen($symbols)-1);
                    $filename .= $symbols[$key];
                }
            }

            $directory = 'resources/images/category/';
             // генерируем название
               
            $image = Image::factory($file);
//            $image->save("$directory/$filename.$ext");// сохряняем оригинал
            $ratio = $image->width / $image->height;// коефициент картинки
     
         $image->save("$directory/about_$filename.$ext");
         
            $width = '290';        
            $height = '1000'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/about_290_$filename.$ext");
            $width = '140';        
            $height = '1000'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/about_140_$filename.$ext");
            $width = '100';        
            $height = '100'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/about_100_100_$filename.$ext");
            $width = '40';        
            $height = '40'; 
            if($image->height > $height || $image->width > $width){
                // изменяем размер изобржаения и загружаем
                $original_ratio = $width / $height;// нужный коефициент картинки
                if($ratio > $original_ratio){
                    $image->resize($width, $height, Image::WIDTH);
                }else{
                    $image->resize($width, $height, Image::HEIGHT);
                }
            }
            $image->save("$directory/about_40_40_$filename.$ext");
            
            return $filename.'.'.$ext;
        }
}
