<?php

class Controller_Admin_News extends Template_Admin
{
	/**
	 * @var  View  page template
	 */
	public $template = 'admin/index';

	public function before() {
		parent::before();
                $this->template->scripts = array(
                    '/resources/libs/synctranslit/jquery.synctranslit.js',
                    '/resources/js/admin/news.js'
                    );
	}


	public function action_index()
	{
		$object = ORM::factory('news');
		$pagination = $object->get_pagination();
		
		$this->template->content = View::factory('admin/blocks/news/index');
		$this->template->title   = 'iRen - administration system';
		$this->template->content->objects	 = $object->get_objects();
	}
	
	public function action_create()
	{
            $this->template->scripts[] = '/resources/libs/underscore.js';
            $this->template->scripts[] = '/resources/libs/eventable.js';
            $this->template->scripts[] = '/resources/libs/sir-trevor-js-master/sir-trevor.js';
            
            $this->template->styles = array('/resources/libs/sir-trevor-js-master/sir-trevor.css');
            $this->template->styles[] = '/resources/libs/sir-trevor-js-master/sir-trevor-icons.css';
		$cat = ORM::factory('category')->fulltree();
		$this->template->content =  View::factory('admin/blocks/news1/edit')
                        ->bind('cat', $cat);
		$object = ORM::factory('news');
		$errors = array();
                
		
		if ($_POST){
               
			try
			{
				// Создаём запись
				$object = $object->create_article($_POST);
                                
                            if($_FILES['img']['tmp_name']){
                                    $file = $_FILES['img']['tmp_name'];
                                    $name = $_FILES['img']['name'];
                                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                    $object->img = $this->_upload_img($file, $ext, $object->pk());
                                    $object->save();
                            }
				
				HTTP::redirect("/admin/category/index");
			}
			catch (ORM_Validation_Exception $e) 
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->content->title = 'Добавить статтю';
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
             $this->template->scripts[] = '/resources/libs/underscore.js';
            $this->template->scripts[] = '/resources/libs/eventable.js';
             $this->template->scripts[] = '/resources/libs/sir-trevor-js-master/sir-trevor.js';
            
            $this->template->styles = array('/resources/libs/sir-trevor-js-master/sir-trevor.css');
            $this->template->styles[] = '/resources/libs/sir-trevor-js-master/sir-trevor-icons.css';
            
		$object = ORM::factory('news', $this->request->param('param'));
		$cat = ORM::factory('category')->fulltree();
		$this->template->content =  View::factory('admin/blocks/news1/edit');
		$errors = array();
		
		// Если работи нет, тогда 404 ошибка
		if ( !$object->loaded() ) throw new Kohana_HTTP_Exception_404("Страница не найдена");
	
		if ( $_POST )
		{
			try
			{
				// Обновление даних
				$object->update_article( $_POST );
                                if($_FILES['img']['tmp_name']){
                                    $file = $_FILES['img']['tmp_name'];
                                    $name = $_FILES['img']['name'];
                                    $type = strtolower(substr($name, 1 + strrpos($name, ".")));
                                    $object->img = $this->_upload_img($file, $ext, $object->pk());
                                    $object->save();
                                }

				HTTP::redirect("/admin/news/");
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = Arr::flatten($e->errors(""));
			}
		}
		
		$this->template->title 	= 'Редактирование';
		
		$this->template->content 	= View::factory('admin/blocks/news1/edit');
		$this->template->content->object = $object;
		$this->template->content->cat = $cat;
		$this->template->content->errors = $errors;
	}

	/**
	 * Удаление работу
	 * 
	 * @throws Kohana_HTTP_Exception_404 
	 */
	public function action_delete()
	{
            if(isset($_GET['del_img'])){
                $object = ORM::factory('news', (int)$_GET['del_img']);
                if (is_file('resources/images/category/'.$object->img)){
                    if (unlink('resources/images/category/'.$object->img)){}
                }
                if (is_file('resources/images/category/100_100_'.$object->img)){
                    if (unlink('resources/images/category/100_100_'.$object->img)){}
                }
                if (is_file('resources/images/category/40_40_'.$object->img)){
                    if (unlink('resources/images/category/40_40_'.$object->img)){}
                }
                $object->img = NULL;
                $object->save();
                HTTP::redirect($this->request->referrer());
            }
		$object = ORM::factory('news', $this->request->param('param'));
		
		if ( $object->loaded() ) {
			if (is_file('resources/images/category/'.$object->img)){
                            if (unlink('resources/images/category/'.$object->img)){}
                        }
                        if (is_file('resources/images/category/290_'.$object->img)){
                            if (unlink('resources/images/category/290_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/100_100_'.$object->img)){
                            if (unlink('resources/images/category/100_100_'.$object->img)){}
                        }
                        if (is_file('resources/images/category/40_40_'.$object->img)){
                            if (unlink('resources/images/category/40_40_'.$object->img)){}
                        }
			$object->delete();
			HTTP::redirect('/admin/category/index');

		} else {
			throw new Kohana_HTTP_Exception_404("Страница не найдена");
		}
	}
        public function after() {
//		if(empty($this->template->left_menu->links))
//                    $this->template->content->class = ' full-content pages';
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

            $directory = 'resources/images/news/';
             // генерируем название
               
            $image = Image::factory($file);
//            $image->save("$directory/$filename.$ext");// сохряняем оригинал
            $ratio = $image->width / $image->height;// коефициент картинки
            
            $watermark= Image::factory("resources/images/log.png"); 
        $ratio = $image->width / $image->height;
        $ratio_2 = $watermark->width / $watermark->height;
         if($ratio < $ratio_2){
            $watermark->resize($image->width, $image->height, Image::WIDTH);
        }else{
            $watermark->resize($image->width, $image->height, Image::HEIGHT);
        }      
        $image->watermark($watermark, NULL, NULL, 20);
         $image->save("$directory/$filename.$ext");
         
            $width = '568';        
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
            $image->save("$directory/568_$filename.$ext");
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
            $image->save("$directory/290_$filename.$ext");
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
            $image->save("$directory/100_100_$filename.$ext");
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
            $image->save("$directory/40_40_$filename.$ext");
            
            return $filename.'.'.$ext;
        }
}
