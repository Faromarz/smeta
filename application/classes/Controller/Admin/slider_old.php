<?php

class Controller_Admin_Slider extends Template_Admin
{
	/**
	 * @var  View  page template
	 */
	public $template = 'admin/index';

	public function before() {
		parent::before();
		
//		$this->template->left_menu->links = array(
//			'/admin/sliders/create' => 'Добавить статью',
//		);
	}


	public function action_index()
	{
		$object = ORM::factory('slider');
		
		$pagination = $object->get_pagination();
		
		$this->template->content = View::factory('admin/blocks/slider/index');
		$this->template->title   = 'iRen - administration system';
		$this->template->content->objects	 = $object->get_objects();
//		$this->template->content->objects	 = $object->get_objects($pagination);
//		$this->template->content->pagination = $pagination;
	}
	
	/**
	 * Новая работа в портфолио
	 */
	public function action_create()
	{
		$this->template->content =  View::factory('admin/blocks/slider/edit');
		$object = ORM::factory('slider');
		$errors = array();
		
		if ($_POST && $_FILES['img'])
		{
			try
			{
                           
                            $video = NULL;
                           
                                
                                $file = $_FILES['img']['tmp_name'];
                                $name = $_FILES['img']['name'];
                                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                $filename = $this->_upload_img($file, $type);
                           
                            if(!empty($_POST['video'])){
                                $video = $_POST['video'];
                            }
				// Создаём запись
                                $post = $_POST;
                                $post['img'] = $filename;
                                $post['video'] = $video;
				$object = $object->create_slider($post);
				
				HTTP::redirect("/admin/slider/");
			}
			catch (ORM_Validation_Exception $e) 
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->content->title = 'Добавить слайдер';
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
		$object = ORM::factory('slider', $this->request->param('param'));
		$this->template->content =  View::factory('admin/blocks/slider/edit');
		$errors = array();
		
		// Если рабр\оти нет, тогда 404 ошибка
		if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
	
		if ( $_POST)
		{
			try
			{
                            $post = $_POST;
                            if($_FILES['img']){
                                $file = $_FILES['img']['tmp_name'];
                                $name = $_FILES['img']['name'];
                                $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                $filename = $this->_upload_img($file, $type);
				// Создаём запись
                                $post['img'] = $filename;
                            }
                            if(!empty($_POST['video'])){
                                $post['video'] = $_POST['video'];
                            }
				// Обновление даних
				$object->update_slider( $post );

				HTTP::redirect("/admin/slider/");
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title 	= 'Редактирование';
		
		$this->template->content 	= View::factory('admin/blocks/slider/edit');
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
		$object = ORM::factory('slider', $this->request->param('param'));
		
		if ( $object->loaded() ) {
                        
			if (is_file('resources/libs/slider/images/'.$object->img)){
                            if (unlink('resources/libs/slider/images/'.$object->img)){}
                        }
			if (is_file('resources/libs/slider/images/505_505_'.$object->img)){
                            if (unlink('resources/libs/slider/images/505_505_'.$object->img)){}
                        }
                        
			if (is_file('resources/libs/slider/images/96_53_'.$object->img)){
                            if (unlink('resources/libs/slider/images/96_53_'.$object->img)){}
                        }
                        if(!isset($_GET['img'])){                            
                            $object->delete();
                            HTTP::redirect('/admin/slider');
                        }else{
                            $object->img = NULL;
                            $object->save();
                            HTTP::redirect('/admin/slider/edit/'.$object->id);                            
                        }

		} else {
			throw new Kohana_HTTP_Exception_404("Материал не загружен");
		}
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content pages';
		parent::after();
	}
         public function _upload_img($file,$ext) {

        $directory = 'resources/libs/slider/images/';

        // генерируем название
        $symbols = '0123456789qwertyuiopasdfghjklzxcvbnm';

        $filename = '';
        for ($i = 0; $i < 10; $i++) {
            $filename .= rand(1, strlen($symbols));
        }
        // изменяем размер изобржаения и загружаем
        copy($file, $directory . $filename . '.' . $ext);
        
        $image = Image::factory($file);
        $ratio = $image->width / $image->height;// коефициент картинки
        
        $width = '584';        
        $height = '505';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/505_505_$filename.$ext");
        $width = '96';        
        $height = '53';  
        if($image->height > $height || $image->width > $width){
                  
            // изменяем размер изобржаения и загружаем
            $original_ratio = $width / $height;// нужный коефициент картинки
            if($ratio > $original_ratio){
                $image->resize($width, $height, Image::WIDTH);
            }else{
                $image->resize($width, $height, Image::HEIGHT);
            }
        }
        $image->save("$directory/96_53_$filename.$ext");
       
        return "$filename.$ext";
    }
}
